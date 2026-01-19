<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'country',
        'gender',
        'source',
        'description',
        'image',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'string',
        'gender' => 'string',
        'sort_order' => 'integer',
    ];

    /**
     * Scope a query to only include active testimonials.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include inactive testimonials.
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
}
