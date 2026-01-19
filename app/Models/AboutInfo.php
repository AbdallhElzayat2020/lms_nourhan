<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutInfo extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'icon_class',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'string',
        'sort_order' => 'integer',
    ];

    /**
     * Scope a query to only include active items.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}

