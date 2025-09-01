<?php
// app/Models/Cart.php
// Create model: php artisan make:model Cart

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_id',
        'product_id',
        'quantity',
        'price'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer'
    ];

    /**
     * Get the product that belongs to the cart
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user that owns the cart
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get cart items for current session/user
     */
    public static function getCartItems()
    {
        $sessionId = session()->getId();
        $userId = auth()->id();

        $query = self::with(['product', 'product.category']);

        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $sessionId);
        }

        return $query->get();
    }

    /**
     * Get cart total
     */
    public static function getCartTotal()
    {
        $items = self::getCartItems();
        return $items->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    }

    /**
     * Get cart items count
     */
    public static function getCartCount()
    {
        $items = self::getCartItems();
        return $items->sum('quantity');
    }

    /**
     * Add item to cart
     */
    public static function addToCart($productId, $quantity = 1)
    {
        $sessionId = session()->getId();
        $userId = auth()->id();

        // Get product details
        $product = Product::findOrFail($productId);

        // Check if item already exists in cart
        $cartItem = self::where('product_id', $productId)
            ->where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->first();

        if ($cartItem) {
            // Update quantity if item exists
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Create new cart item
            self::create([
                'session_id' => $userId ? null : $sessionId,
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price
            ]);
        }

        return true;
    }

    /**
     * Update cart item quantity
     */
    public static function updateQuantity($productId, $quantity)
    {
        $sessionId = session()->getId();
        $userId = auth()->id();

        $cartItem = self::where('product_id', $productId)
            ->where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->first();

        if ($cartItem) {
            if ($quantity <= 0) {
                $cartItem->delete();
            } else {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
            return true;
        }

        return false;
    }

    /**
     * Remove item from cart
     */
    public static function removeFromCart($productId)
    {
        $sessionId = session()->getId();
        $userId = auth()->id();

        return self::where('product_id', $productId)
            ->where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->delete();
    }

    /**
     * Clear entire cart
     */
    public static function clearCart()
    {
        $sessionId = session()->getId();
        $userId = auth()->id();

        return self::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->delete();
    }

    /**
     * Transfer cart from session to user when user logs in
     */
    public static function transferSessionCartToUser($userId)
    {
        $sessionId = session()->getId();

        $sessionItems = self::where('session_id', $sessionId)->get();

        foreach ($sessionItems as $item) {
            // Check if user already has this product in cart
            $existingItem = self::where('user_id', $userId)
                ->where('product_id', $item->product_id)
                ->first();

            if ($existingItem) {
                // Merge quantities
                $existingItem->quantity += $item->quantity;
                $existingItem->save();
                $item->delete();
            } else {
                // Transfer to user
                $item->update([
                    'user_id' => $userId,
                    'session_id' => null
                ]);
            }
        }
    }
}
