<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Get cart items for header display
     */
    public function getCartItems()
    {
        try {
            $sessionId = session()->getId();
            Log::info('Getting cart items for session: ' . $sessionId);

            $cartItems = Cart::getCartItems();
            $cartCount = Cart::getCartCount();
            $cartTotal = Cart::getCartTotal();

            Log::info('Cart items count: ' . $cartCount);

            $formattedItems = $cartItems->map(function ($item) {
                return [
                    'id' => $item->product_id,
                    'name' => $item->product->name,
                    'price' => floatval($item->price),
                    'quantity' => $item->quantity,
                    'image' => $item->product->image ? asset('storage/' . $item->product->image) : asset('assets/imgs/default-product.jpg'),
                    'category' => $item->product->category->name ?? 'Product'
                ];
            });

            return response()->json([
                'success' => true,
                'items' => $formattedItems,
                'count' => $cartCount,
                'total' => $cartTotal,
                'session_id' => $sessionId
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching cart items: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error fetching cart items',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add product to cart
     */
    public function addToCart(Request $request)
    {
        try {
            $sessionId = session()->getId();
            Log::info('Adding to cart - Session ID: ' . $sessionId);
            Log::info('Request data: ', $request->all());

            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'integer|min:1|max:10'
            ]);

            $productId = $request->product_id;
            $quantity = $request->quantity ?? 1;

            // Check if product exists and is active
            $product = Product::findOrFail($productId);
            Log::info('Product found: ' . $product->name . ' (Status: ' . $product->status . ')');

            if ($product->status !== 'active') {
                return response()->json([
                    'success' => false,
                    'message' => 'Product is not available'
                ], 400);
            }

            // Check stock
            if ($product->quantity < $quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient stock available'
                ], 400);
            }

            // Add to cart
            $result = Cart::addToCart($productId, $quantity);
            Log::info('Add to cart result: ' . ($result ? 'Success' : 'Failed'));

            $cartCount = Cart::getCartCount();
            $cartTotal = Cart::getCartTotal();

            Log::info('Cart count after adding: ' . $cartCount);

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully',
                'cart_count' => $cartCount,
                'cart_total' => $cartTotal,
                'session_id' => $sessionId
            ]);
        } catch (\Exception $e) {
            Log::error('Error adding product to cart: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Error adding product to cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update cart item quantity
     */
    public function updateQuantity(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:0|max:10'
            ]);

            $productId = $request->product_id;
            $quantity = $request->quantity;

            Cart::updateQuantity($productId, $quantity);

            $cartCount = Cart::getCartCount();
            $cartTotal = Cart::getCartTotal();

            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully',
                'cart_count' => $cartCount,
                'cart_total' => $cartTotal
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating cart: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error updating cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            $productId = $request->product_id;
            Cart::removeFromCart($productId);

            $cartCount = Cart::getCartCount();
            $cartTotal = Cart::getCartTotal();

            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart',
                'cart_count' => $cartCount,
                'cart_total' => $cartTotal
            ]);
        } catch (\Exception $e) {
            Log::error('Error removing from cart: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error removing product from cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Clear entire cart
     */
    public function clearCart()
    {
        try {
            Cart::clearCart();

            return response()->json([
                'success' => true,
                'message' => 'Cart cleared successfully',
                'cart_count' => 0,
                'cart_total' => 0
            ]);
        } catch (\Exception $e) {
            Log::error('Error clearing cart: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error clearing cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Debug route to check cart table
     */
    public function debug()
    {
        $sessionId = session()->getId();
        $cartItems = Cart::all();
        $sessionItems = Cart::where('session_id', $sessionId)->get();

        return response()->json([
            'session_id' => $sessionId,
            'all_cart_items' => $cartItems,
            'session_cart_items' => $sessionItems,
            'cart_count' => Cart::getCartCount(),
            'cart_total' => Cart::getCartTotal()
        ]);
    }
    public function cart()
    {
        return view('cart');
    }
}
