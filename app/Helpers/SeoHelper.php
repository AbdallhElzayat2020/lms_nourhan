<?php

namespace App\Helpers;

use App\Models\SeoPage;

class SeoHelper
{
    /**
     * Get SEO data for a specific page.
     */
    public static function getPageSeo($pageName, $fallbackTitle = null, $fallbackDescription = null)
    {
        // Simple per-request cache to avoid duplicate queries for the same page
        static $cache = [];

        if (isset($cache[$pageName])) {
            return $cache[$pageName];
        }

        $seoPage = SeoPage::getPageSeo($pageName);

        if (!$seoPage) {
            return $cache[$pageName] = [
                'meta_title' => $fallbackTitle ?: config('app.name'),
                'meta_description' => $fallbackDescription ?: 'Default description for ' . config('app.name'),
                'meta_keywords' => null,
                'canonical_url' => null,
                'schema_markup' => null,
            ];
        }

        return $cache[$pageName] = [
            'meta_title' => $seoPage->final_meta_title,
            'meta_description' => $seoPage->meta_description,
            'meta_keywords' => $seoPage->meta_keywords,
            'canonical_url' => $seoPage->canonical_url,
            'schema_markup' => $seoPage->schema_markup,
            'keywords_array' => $seoPage->keywords_array,
        ];
    }

    /**
     * Generate meta tags HTML for a page.
     */
    public static function generateMetaTags($pageName, $fallbackTitle = null, $fallbackDescription = null)
    {
        $seo = self::getPageSeo($pageName, $fallbackTitle, $fallbackDescription);

        $html = '';

        // Title (use meta_title as the page title)
        if ($seo['meta_title']) {
            $html .= '<title>' . e($seo['meta_title']) . '</title>' . PHP_EOL;
        }

        // Meta Description
        if ($seo['meta_description']) {
            $html .= '<meta name="description" content="' . e($seo['meta_description']) . '">' . PHP_EOL;
        }

        // Meta Keywords
        if ($seo['meta_keywords']) {
            $html .= '<meta name="keywords" content="' . e($seo['meta_keywords']) . '">' . PHP_EOL;
        }

        // Canonical URL
        if ($seo['canonical_url']) {
            $html .= '<link rel="canonical" href="' . e($seo['canonical_url']) . '">' . PHP_EOL;
        }

        return $html;
    }

    /**
     * Get page title for use in frontend.
     */
    public static function getPageTitle($pageName, $fallbackTitle = null)
    {
        $seo = self::getPageSeo($pageName, $fallbackTitle);
        return $seo['meta_title'] ?: $fallbackTitle ?: config('app.name');
    }

    /**
     * Generate schema markup script tag.
     */
    public static function generateSchemaMarkup($pageName)
    {
        $seo = self::getPageSeo($pageName);

        if (!$seo['schema_markup']) {
            return '';
        }

        // Validate JSON
        $decoded = json_decode($seo['schema_markup'], true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return '';
        }

        return '<script type="application/ld+json">' . PHP_EOL .
               $seo['schema_markup'] . PHP_EOL .
               '</script>' . PHP_EOL;
    }

    /**
     * Get SEO data for dynamic content (like blog post, course, teacher, etc.).
     */
    public static function getDynamicSeo($model, $fallbackTitle = null, $fallbackDescription = null)
    {
        if (!$model) {
            return [
                'meta_title' => $fallbackTitle ?: config('app.name'),
                'meta_description' => $fallbackDescription ?: 'Default description for ' . config('app.name'),
                'meta_keywords' => null,
                'schema_markup' => null,
            ];
        }

        return [
            'meta_title' => $model->meta_title ?: $fallbackTitle ?: $model->title ?? $model->name ?? config('app.name'),
            'meta_description' => $model->meta_description ?: $fallbackDescription ?: ($model->short_description ?? 'Default description'),
            'meta_keywords' => $model->meta_keywords,
            'schema_markup' => $model->schema_block,
            'canonical_url' => $model->canonical_url ?: self::generateCanonicalUrl($model),
        ];
    }

    /**
     * Generate meta tags HTML for dynamic content.
     */
    public static function generateDynamicMetaTags($model, $fallbackTitle = null, $fallbackDescription = null)
    {
        $seo = self::getDynamicSeo($model, $fallbackTitle, $fallbackDescription);

        $html = '';

        // Title (use meta_title as the page title)
        if ($seo['meta_title']) {
            $html .= '<title>' . e($seo['meta_title']) . '</title>' . PHP_EOL;
        }

        // Meta Description
        if ($seo['meta_description']) {
            $html .= '<meta name="description" content="' . e($seo['meta_description']) . '">' . PHP_EOL;
        }

        // Meta Keywords
        if ($seo['meta_keywords']) {
            $html .= '<meta name="keywords" content="' . e($seo['meta_keywords']) . '">' . PHP_EOL;
        }

        // Canonical URL
        if ($seo['canonical_url']) {
            $html .= '<link rel="canonical" href="' . e($seo['canonical_url']) . '">' . PHP_EOL;
        }

        return $html;
    }

    /**
     * Generate schema markup script tag for dynamic content.
     */
    public static function generateDynamicSchemaMarkup($model)
    {
        if (!$model || !$model->schema_block) {
            return '';
        }

        // Validate JSON
        $decoded = json_decode($model->schema_block, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return '';
        }

        return '<script type="application/ld+json">' . PHP_EOL .
               $model->schema_block . PHP_EOL .
               '</script>' . PHP_EOL;
    }

    /**
     * Get page title for dynamic content.
     */
    public static function getDynamicPageTitle($model, $fallbackTitle = null)
    {
        if (!$model) {
            return $fallbackTitle ?: config('app.name');
        }

        return $model->meta_title ?: $fallbackTitle ?: $model->title ?? $model->name ?? config('app.name');
    }

    /**
     * Generate canonical URL for dynamic content.
     */
    public static function generateCanonicalUrl($model)
    {
        if (!$model) {
            return null;
        }

        $modelClass = get_class($model);
        $slug = $model->slug ?? $model->id;

        switch ($modelClass) {
            case 'App\Models\Teacher':
                return route('frontend.teacher.details', $slug);

            case 'App\Models\Course':
                return route('frontend.course.details', $slug);

            case 'App\Models\Blog':
                return route('frontend.blog.details', $slug);

            case 'App\Models\Event':
                return route('frontend.event.details', $slug);

            case 'App\Models\Category':
                return route('frontend.category.details', $slug);

            case 'App\Models\BlogCategory':
                // Assuming you might add blog category pages later
                return url('/blog?category=' . $slug);

            default:
                return null;
        }
    }

    /**
     * Get all available SEO pages for sitemap generation.
     */
    public static function getAllActiveSeoPages()
    {
        return SeoPage::active()->get();
    }
}
