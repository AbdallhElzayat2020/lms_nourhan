<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\Category;
use App\Models\AboutSection;
use App\Models\Teacher;
use App\Models\Partner;
use App\Models\Counter;
use App\Models\WhyChooseItem;
use App\Models\Course;
use App\Models\Event;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        $sliders = Slider::active()->orderBy('sort_order')->get();
        $testimonials = Testimonial::active()->latest()->take(10)->get();
        $recentBlogs = Blog::active()->homepage()->latest()->take(3)->get();
        $categories = Category::active()
            ->withCount(['courses' => function ($query) {
                $query->where('status', 'active')->whereNull('deleted_at');
            }])
            ->orderBy('sort_order')
            ->take(6)
            ->get();
        $aboutSection = AboutSection::active()->first();
        $whyChooseItems = WhyChooseItem::active()->orderBy('sort_order')->get();
        $recentTeachers = Teacher::active()->latest()->take(8)->get();
        $partners = Partner::active()->orderBy('sort_order')->get();
        $counters = Counter::active()->orderBy('sort_order')->get();
        $featuredCourses = Course::with('category')
            ->active()
            ->homepage()
            ->orderBy('sort_order')
            ->latest()
            ->take(6)
            ->get();
        $upcomingEvents = Event::active()
            ->whereDate('start_date', '>=', now()->toDateString())
            ->orderBy('start_date', 'asc')
            ->orderBy('sort_order', 'asc')
            ->take(6)
            ->get();

        // Ensure all teachers have slugs
        foreach ($recentTeachers as $teacher) {
            if (!$teacher->slug) {
                $teacher->ensureSlug();
            }
        }

        // Set SEO page name for this view
        view()->share('seoPageName', 'home');

        return view('frontend.pages.home', compact(
            'sliders',
            'testimonials',
            'recentBlogs',
            'categories',
            'aboutSection',
            'recentTeachers',
            'partners',
            'counters',
            'whyChooseItems',
            'featuredCourses',
            'upcomingEvents'
        ));
    }
}
