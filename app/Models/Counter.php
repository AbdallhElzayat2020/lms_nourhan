<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'value',
        'suffix',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'string',
        'sort_order' => 'integer',
    ];

    /**
     * Scope a query to only include active counters.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}

