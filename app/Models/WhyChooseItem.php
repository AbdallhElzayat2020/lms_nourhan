<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseItem extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'icon_class',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'string',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}

