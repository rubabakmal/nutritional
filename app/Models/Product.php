<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'quantity',
        'sku',
        'image',
        'gallery',
        'status',
        'is_featured',
        'category_id'
    ];

    protected $casts = [
        'gallery' => 'array',
        'price' => 'decimal:2',
        'is_featured' => 'boolean'
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the status badge color.
     */
    public function getStatusBadgeAttribute()
    {
        return [
            'active' => 'success',
            'inactive' => 'warning',
            'out_of_stock' => 'danger'
        ][$this->status] ?? 'secondary';
    }

    /**
     * Check if product is in stock.
     */
    public function isInStock()
    {
        return $this->quantity > 0 && $this->status !== 'out_of_stock';
    }

    /**
     * Get formatted price.
     */
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }
}
