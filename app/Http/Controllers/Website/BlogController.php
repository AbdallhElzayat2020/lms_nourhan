<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    /**
     * Display the blog listing page.
     */
    public function index(Request $request)
    {
        $query = Blog::with('category')->active()->published();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('short_description', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by category slug
        $selectedCategory = null;
        if ($request->has('category') && $request->category) {
            $selectedCategory = Category::where('slug', $request->category)->first();
            if ($selectedCategory) {
                $query->where('category_id', $selectedCategory->id);
            }
        }

        $blogs = $query->latest('published_at')
            ->paginate(6)
            ->appends($request->query());

        // Cache categories (5 minutes)
        $categories = Cache::remember('blog_categories', 300, function () {
            return Category::active()->orderBy('name')->get();
        });

        // Cache recent blogs for sidebar (3 minutes)
        $recentBlogs = Cache::remember('blog_recent_sidebar', 180, function () {
            return Blog::active()
                ->published()
                ->latest('published_at')
                ->take(3)
                ->get();
        });

        // Set SEO page name for this view
        view()->share('seoPageName', 'blog');

        // Add noindex meta tag if search is active
        if ($request->has('search') && $request->search) {
            view()->share('noindex', true);
        }

        return view('frontend.pages.blog', compact('blogs', 'recentBlogs', 'categories', 'selectedCategory'));
    }

    /**
     * Display a single blog post details page.
     */
    public function show($slug)
    {
        $blog = Blog::with('category')
            ->where('slug', $slug)
            ->active()
            ->published()
            ->firstOrFail();

        // Get recent blogs for sidebar
        $recentBlogs = Blog::where('id', '!=', $blog->id)
            ->active()
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        // Set dynamic SEO model for this blog post
        view()->share('dynamicSeoModel', $blog);

        return view('frontend.pages.blog-details', compact('blog', 'recentBlogs'));
    }
}
