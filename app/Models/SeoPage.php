<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_name',
        'page_title',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'schema_markup',
        'canonical_url',
        'status',
    ];

    /**
     * Get SEO data for a specific page.
     */
    public static function getPageSeo($pageName)
    {
        return static::where('page_name', $pageName)
                    ->where('status', 'active')
                    ->first();
    }

    /**
     * Get all active SEO pages.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get formatted meta keywords as array.
     */
    public function getKeywordsArrayAttribute()
    {
        if (!$this->meta_keywords) {
            return [];
        }

        return array_map('trim', explode(',', $this->meta_keywords));
    }

    /**
     * Get the final meta title (fallback to page title if empty).
     */
    public function getFinalMetaTitleAttribute()
    {
        return $this->meta_title ?: $this->page_title;
    }

    /**
     * Get parsed schema markup as array.
     */
    public function getSchemaArrayAttribute()
    {
        if (!$this->schema_markup) {
            return null;
        }

        try {
            return json_decode($this->schema_markup, true);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Check if schema markup is valid JSON.
     */
    public function hasValidSchema()
    {
        if (!$this->schema_markup) {
            return false;
        }

        json_decode($this->schema_markup);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
