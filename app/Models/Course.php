<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'subtitle',
        'slug',
        'category_id',
        'banner_image',
        'short_description',
        'description',
        'lessons_count',
        'course_type',
        'duration_hours',
        'language',
        'about_program_text',
        'about_program_image',
        'how_course_works_text',
        'how_course_works_image',
        'what_you_achieve_text',
        'what_you_achieve_image',
        'status',
        'show_on_homepage',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'schema_block',
        'canonical_url',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'string',
        'sort_order' => 'integer',
        'lessons_count' => 'integer',
        'duration_hours' => 'integer',
        'course_type' => 'string',
        'show_on_homepage' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title);
            }
        });

        static::updating(function ($course) {
            if ($course->isDirty('title') && empty($course->slug)) {
                $course->slug = Str::slug($course->title);
            }
        });
    }

    /**
     * Get the category that owns the course.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the FAQs for the course.
     */
    public function faqs()
    {
        return $this->belongsToMany(Faq::class, 'course_faq')
            ->withPivot('sort_order')
            ->withTimestamps()
            ->orderBy('course_faq.sort_order');
    }

    /**
     * Scope a query to only include active courses.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include courses that should be shown on homepage.
     */
    public function scopeHomepage($query)
    {
        return $query->where('show_on_homepage', true);
    }
}
