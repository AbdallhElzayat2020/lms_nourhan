<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'cover_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'schema_block',
        'canonical_url',
        'author',
        'blog_category_id',
        'status',
        'show_on_homepage',
        'published_at',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'string',
        'show_on_homepage' => 'boolean',
        'published_at' => 'datetime',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = static::generateUniqueSlug($blog->title);
            }

            // Set default author if not provided
            if (empty($blog->author)) {
                $blog->author = 'Sister Nourhan';
            }
        });

        static::updating(function ($blog) {
            // Handle slug - only auto-generate if empty
            if ($blog->isDirty('slug') || $blog->isDirty('title')) {
                if (empty($blog->slug)) {
                    // If slug is empty, generate from title
                    $blog->slug = static::generateUniqueSlug($blog->title, $blog->id);
                } else {
                    // If slug is provided, just clean it and ensure uniqueness
                    $blog->slug = static::generateUniqueSlug($blog->slug, $blog->id);
                }
            }

            // Set default author if empty during update
            if ($blog->isDirty('author') && empty($blog->author)) {
                $blog->author = 'Sister Nourhan';
            }
        });
    }

    /**
     * Scope a query to only include active blogs.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include blogs shown on homepage.
     */
    public function scopeHomepage($query)
    {
        return $query->where('show_on_homepage', true);
    }

    /**
     * Scope a query to only include published blogs.
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Get the blog category that owns the blog.
     */
    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    /**
     * Get the category that owns the blog (for backward compatibility).
     */
    public function category()
    {
        return $this->blogCategory();
    }

    /**
     * Generate a unique slug for the blog.
     */
    public static function generateUniqueSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->when($id, function ($query, $id) {
            return $query->where('id', '!=', $id);
        })->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
