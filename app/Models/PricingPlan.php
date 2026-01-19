<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $fillable = [
        'name',
        'price',
        'price_period',
        'description',
        'features',
        'is_featured',
        'status',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'schema_block',
        'canonical_url',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'status' => 'string',
        'sort_order' => 'integer',
        'features' => 'array', // Store features as JSON array
    ];

    /**
     * Scope a query to only include active pricing plans.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include featured pricing plans.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
