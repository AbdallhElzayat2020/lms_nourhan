<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseFeedback extends Model
{
    use SoftDeletes;

    protected $table = 'course_feedbacks';

    protected $fillable = [
        'title',
        'description',
        'image',
        'video_url',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'string',
        'sort_order' => 'integer',
    ];

    /**
     * Scope a query to only include active course feedbacks.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
