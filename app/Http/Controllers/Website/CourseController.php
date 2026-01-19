<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display the courses listing page.
     */
    public function index(Request $request)
    {
        $query = Course::with('category')->active();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('subtitle', 'like', '%' . $request->search . '%')
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

        // Sort functionality
        $sort = $request->get('sort', 'latest');
        if ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('sort_order')->latest();
        }

        $courses = $query->paginate(9)->appends($request->query());

        // Get all categories for filter with courses count
        $categories = Category::active()
            ->withCount(['courses' => function ($query) {
                $query->where('status', 'active')->whereNull('deleted_at');
            }])
            ->orderBy('name')
            ->get();

        // Set SEO page name for this view
        view()->share('seoPageName', 'courses');

        return view('frontend.pages.courses', compact('courses', 'categories', 'selectedCategory'));
    }

    /**
     * Display a single course details page.
     */
    public function show($slug)
    {
        $course = Course::with(['category', 'faqs'])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Get related courses (same category, excluding current course)
        $relatedCourses = Course::where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)
            ->active()
            ->latest()
            ->take(3)
            ->get();

        // Set dynamic SEO model for this course
        view()->share('dynamicSeoModel', $course);

        return view('frontend.pages.course-details', compact('course', 'relatedCourses'));
    }
}
