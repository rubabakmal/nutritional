<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_method',
        'payment_intent_id',
        'transaction_id',
        'amount',
        'currency',
        'status',
        'gateway_response',
        'gateway_fee',
        'net_amount',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'gateway_fee' => 'decimal:2',
        'net_amount' => 'decimal:2',
        'gateway_response' => 'array',
        'paid_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Automatically calculate net amount
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($payment) {
            if ($payment->net_amount === null) {
                $payment->net_amount = $payment->amount - $payment->gateway_fee;
            }
        });
    }

    public function isSuccessful()
    {
        return $this->status === 'completed';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isFailed()
    {
        return $this->status === 'failed';
    }
}
