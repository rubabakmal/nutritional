<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class StripePaymentController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Show checkout page with cart data
     */
    public function checkout()
    {
        try {
            $sessionId = session()->getId();

            // Get cart items from database
            $cartItems = Cart::getCartItems();
            $cartCount = Cart::getCartCount();
            $cartTotal = Cart::getCartTotal();

            // Check if cart is empty
            if ($cartCount == 0) {
                return redirect()->route('cart')->with('error', 'Your cart is empty');
            }

            // Format cart items for the view
            $formattedItems = $cartItems->map(function ($item) {
                return [
                    'id' => $item->product_id,
                    'name' => $item->product->name,
                    'price' => floatval($item->price),
                    'quantity' => $item->quantity,
                    'total' => floatval($item->price) * $item->quantity,
                    'image' => $item->product->image ? asset('storage/' . $item->product->image) : asset('assets/imgs/default-product.jpg'),
                    'category' => $item->product->category->name ?? 'Product',
                    'size' => $item->product->size ?? '400g',
                    'sku' => $item->product->sku ?? null,
                    'description' => $item->product->description ?? null,
                ];
            });

            $subtotal = $cartTotal;
            $shipping = $subtotal >= 500 ? 0 : 25;
            // $tax = $subtotal * 0.05; // 5% tax
            $tax = 0; // 5% tax
            $finalTotal = $subtotal + $shipping + $tax;

            return view('checkout', compact(
                'formattedItems',
                'cartCount',
                'subtotal',
                'shipping',
                'tax',
                'finalTotal'
            ));

        } catch (\Exception $e) {
            Log::error('Error loading checkout page: ' . $e->getMessage());
            return redirect()->route('cart')->with('error', 'Error loading checkout page');
        }
    }

    /**
     * Create payment intent for Stripe
     */
    public function createPaymentIntent(Request $request)
    {
        try {
            $cartTotal = Cart::getCartTotal();
            $shipping = $cartTotal >= 500 ? 0 : 25;
            // $tax = $cartTotal * 0.05; // 5% tax
            $tax = 0; // 5% tax
            $finalTotal = $cartTotal + $shipping + $tax;

            // Create payment intent
            $paymentIntent = PaymentIntent::create([
                'amount' => round($finalTotal * 100), // Amount in cents
                'currency' => 'aed',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'metadata' => [
                    'session_id' => session()->getId(),
                    'cart_total' => $cartTotal,
                    'shipping' => $shipping,
                    'tax' => $tax,
                    'final_total' => $finalTotal,
                ],
            ]);

            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent_id' => $paymentIntent->id,
            ]);

        } catch (\Exception $e) {
            Log::error('Error creating payment intent: ' . $e->getMessage());
            return response()->json([
                'error' => 'Unable to create payment intent'
            ], 500);
        }
    }

    /**
     * Process successful payment
     */
    public function paymentSuccess(Request $request)
    {
        try {
            $paymentIntentId = $request->input('payment_intent');

            if (!$paymentIntentId) {
                return redirect()->route('cart')->with('error', 'Invalid payment');
            }

            // Retrieve and verify payment intent from Stripe
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

            if ($paymentIntent->status !== 'succeeded') {
                return redirect()->route('cart')->with('error', 'Payment was not successful');
            }

            // Check if order already exists (prevent duplicate orders)
            $existingOrder = Order::where('payment_intent_id', $paymentIntentId)->first();
            if ($existingOrder) {
                return view('order-success', [
                    'order' => $existingOrder->load('items', 'shippingAddress'),
                    'paymentIntent' => $paymentIntent
                ]);
            }

            // Get cart items
            $cartItems = Cart::getCartItems();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart')->with('error', 'Cart is empty');
            }

            // Use database transaction for data consistency
            DB::beginTransaction();

            try {
                // Create the order
                $order = Order::create([
                    'session_id' => session()->getId(),
                    'payment_intent_id' => $paymentIntentId,
                    'payment_method' => 'stripe',
                    'payment_status' => 'paid',
                    'order_status' => 'confirmed',
                    'customer_email' => $request->input('email'),
                    'customer_phone' => $request->input('phone'),
                    'subtotal' => $paymentIntent->metadata->cart_total ?? 0,
                    'shipping_cost' => $paymentIntent->metadata->shipping ?? 0,
                    'tax_amount' => $paymentIntent->metadata->tax ?? 0,
                    'total_amount' => $paymentIntent->metadata->final_total ?? 0,
                    'currency' => strtoupper($paymentIntent->currency),
                ]);

                // Create shipping address
                OrderAddress::create([
                    'order_id' => $order->id,
                    'type' => 'shipping',
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'address_line_1' => $request->input('address'),
                    'address_line_2' => $request->input('apartment'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'country' => $request->input('country'),
                    'phone' => $request->input('phone'),
                ]);

                // Create billing address (same as shipping for now)
                OrderAddress::create([
                    'order_id' => $order->id,
                    'type' => 'billing',
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'address_line_1' => $request->input('address'),
                    'address_line_2' => $request->input('apartment'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'country' => $request->input('country'),
                    'phone' => $request->input('phone'),
                ]);

                // Create order items
                foreach ($cartItems as $cartItem) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'product_name' => $cartItem->product->name,
                        'product_sku' => $cartItem->product->sku,
                        'product_description' => $cartItem->product->description,
                        'product_image' => $cartItem->product->image,
                        'quantity' => $cartItem->quantity,
                        'unit_price' => $cartItem->price,
                        // total_price is calculated automatically in the model
                    ]);
                }

                // Create payment record
                Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => 'stripe',
                    'payment_intent_id' => $paymentIntentId,
                    'amount' => $paymentIntent->amount / 100,
                    'currency' => strtoupper($paymentIntent->currency),
                    'status' => 'completed',
                    'gateway_response' => [
                        'payment_method' => $paymentIntent->payment_method,
                        'receipt_url' => $paymentIntent->charges->data[0]->receipt_url ?? null,
                    ],
                    'paid_at' => now(),
                ]);

                // Clear cart after successful order
                Cart::clearCart();

                DB::commit();

                return view('order-success', [
                    'order' => $order->load('items', 'shippingAddress'),
                    'paymentIntent' => $paymentIntent
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (\Exception $e) {
            Log::error('Error processing payment success: ' . $e->getMessage());
            return redirect()->route('cart')->with('error', 'Error processing your order');
        }
    }

    /**
     * Handle Cash on Delivery orders
     */
    public function processCOD(Request $request)
    {
        try {
            // Validate form data
            $request->validate([
                'email' => 'required|email',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'address' => 'required|string|max:500',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
            ]);

            // Get cart items
            $cartItems = Cart::getCartItems();
            $cartTotal = Cart::getCartTotal();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart is empty'
                ], 400);
            }

            // Calculate totals
            $shipping = $cartTotal >= 500 ? 0 : 25;
            // $tax = $cartTotal * 0.05;
            $tax = 0;
            $finalTotal = $cartTotal + $shipping + $tax;

            DB::beginTransaction();

            try {
                // Create COD order
                $order = Order::create([
                    'session_id' => session()->getId(),
                    'payment_method' => 'cod',
                    'payment_status' => 'pending',
                    'order_status' => 'pending',
                    'customer_email' => $request->input('email'),
                    'customer_phone' => $request->input('phone'),
                    'subtotal' => $cartTotal,
                    'shipping_cost' => $shipping,
                    'tax_amount' => $tax,
                    'total_amount' => $finalTotal,
                    'currency' => 'AED',
                ]);

                // Create addresses
                OrderAddress::create([
                    'order_id' => $order->id,
                    'type' => 'shipping',
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'address_line_1' => $request->input('address'),
                    'address_line_2' => $request->input('apartment'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'country' => $request->input('country'),
                    'phone' => $request->input('phone'),
                ]);

                // Create order items
                foreach ($cartItems as $cartItem) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'product_name' => $cartItem->product->name,
                        'product_sku' => $cartItem->product->sku,
                        'product_description' => $cartItem->product->description,
                        'product_image' => $cartItem->product->image,
                        'quantity' => $cartItem->quantity,
                        'unit_price' => $cartItem->price,
                    ]);
                }

                // Create payment record for COD
                Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => 'cod',
                    'amount' => $finalTotal,
                    'currency' => 'AED',
                    'status' => 'pending',
                ]);

                // Clear cart
                Cart::clearCart();

                DB::commit();

                return response()->json([
                    'success' => true,
                    'order_id' => $order->id,
                    'redirect_url' => route('cod.success', ['order' => $order->id])
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (\Exception $e) {
            Log::error('Error processing COD order: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error processing your order'
            ], 500);
        }
    }

    /**
     * COD Success page
     */
    public function codSuccess(Order $order)
    {
        $order->load('items', 'shippingAddress');
        return view('cod-success', compact('order'));
    }

    /**
     * Handle failed payment
     */
    public function paymentCancel()
    {
        return redirect()->route('cart')->with('error', 'Payment was cancelled');
    }
}
