<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'short_description',
        'description',
        'video_url',
        'status',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'schema_block',
        'canonical_url',
    ];

    protected $casts = [
        'status' => 'string',
        'sort_order' => 'integer',
    ];

    /**
     * Scope a query to only include active teachers.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get the slug or generate one from name (without saving).
     */
    public function getSlugOrGenerateAttribute()
    {
        if ($this->slug) {
            return $this->slug;
        }

        // Generate slug from name if not exists (without saving)
        return \Illuminate\Support\Str::slug($this->name);
    }

    /**
     * Ensure the teacher has a slug, generate and save if missing.
     */
    public function ensureSlug()
    {
        if ($this->slug) {
            return $this->slug;
        }

        // Generate slug from name
        $slug = \Illuminate\Support\Str::slug($this->name);
        $count = 1;
        $originalSlug = $slug;

        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Save the generated slug if model exists
        if ($this->exists) {
            $this->updateQuietly(['slug' => $slug]);
            $this->refresh();
        }

        return $slug;
    }

    /**
     * Get the certificates for the teacher.
     */
    public function certificates()
    {
        return $this->hasMany(TeacherCertificate::class);
    }

    /**
     * Get active certificates ordered by sort_order.
     */
    public function activeCertificates()
    {
        return $this->hasMany(TeacherCertificate::class)->active()->ordered();
    }
}
