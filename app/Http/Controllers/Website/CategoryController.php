<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;

class CategoryController extends Controller
{
    /**
     * Display a single category details page with its courses.
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Get courses for this category
        $courses = Course::with('category')
            ->where('category_id', $category->id)
            ->active()
            ->orderBy('sort_order')
            ->latest()
            ->paginate(9);

        // Set dynamic SEO model for this category
        view()->share('dynamicSeoModel', $category);

        return view('frontend.pages.category-details', compact('category', 'courses'));
    }
}
