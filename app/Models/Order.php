<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'session_id',
        'payment_intent_id',
        'payment_method',
        'payment_status',
        'order_status',
        'customer_email',
        'customer_phone',
        'subtotal',
        'shipping_cost',
        'tax_amount',
        'total_amount',
        'currency',
        'notes',
        'admin_notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    // Relationships
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class)->where('type', 'shipping');
    }

    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class)->where('type', 'billing');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function latestPayment()
    {
        return $this->hasOne(Payment::class)->latest();
    }

    // Automatically generate order number
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = self::generateOrderNumber();
            }
        });
    }

    public static function generateOrderNumber()
    {
        $year = date('Y');
        $lastOrder = self::whereYear('created_at', $year)
                        ->orderBy('id', 'desc')
                        ->first();

        $nextNumber = $lastOrder ? (intval(substr($lastOrder->order_number, -3)) + 1) : 1;

        return 'ORD-' . $year . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

    // Helper methods
    public function getTotalItemsAttribute()
    {
        return $this->items->sum('quantity');
    }

    public function getFullNameAttribute()
    {
        $shipping = $this->shippingAddress;
        return $shipping ? $shipping->first_name . ' ' . $shipping->last_name : '';
    }
    public function getTotalAttribute()
{
    return $this->total_amount;
}
}
