<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get active products for the category.
     */
    public function activeProducts()
    {
        return $this->hasMany(Product::class)->where('status', 'active');
    }

    /**
     * Get products count for the category.
     */
    public function getProductsCountAttribute()
    {
        return $this->products()->count();
    }

    /**
     * Check if category can be deleted.
     */
    public function canBeDeleted()
    {
        return $this->products()->count() === 0;
    }




}
