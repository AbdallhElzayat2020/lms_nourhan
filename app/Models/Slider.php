<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'text_line_1',
        'image',
        'status',
        'sort_order',
        'link',
        'button_text',
        'button_text_2',
        'link_2',
    ];

    protected $casts = [
        'status' => 'string',
        'sort_order' => 'integer',
    ];

    /**
     * Scope a query to only include active sliders.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include inactive sliders.
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
}
