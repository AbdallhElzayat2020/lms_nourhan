<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutSection extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'subtitle',
        'title',
        'description',
        'button_text',
        'button_link',
        'video_url',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Scope a query to only include active sections.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
