<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\Category;
use App\Models\AboutSection;
use App\Models\Teacher;
use App\Models\Counter;
use App\Models\WhyChooseItem;
use App\Models\Course;
use App\Models\Event;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        // Cache static data that doesn't change often (5 minutes)
        $sliders = Cache::remember('home_sliders', 300, function () {
            return Slider::active()->orderBy('sort_order')->get();
        });

        $testimonials = Cache::remember('home_testimonials', 300, function () {
            return Testimonial::active()->latest()->take(10)->get();
        });

        $recentBlogs = Cache::remember('home_recent_blogs', 180, function () {
            return Blog::active()->homepage()->latest()->take(3)->get();
        });

        $categories = Cache::remember('home_categories', 300, function () {
            return Category::active()
                ->withCount(['courses' => function ($query) {
                    $query->where('status', 'active')->whereNull('deleted_at');
                }])
                ->orderBy('sort_order')
                ->take(6)
                ->get();
        });

        $aboutSection = Cache::remember('home_about_section', 600, function () {
            return AboutSection::active()->first();
        });

        $whyChooseItems = Cache::remember('home_why_choose', 600, function () {
            return WhyChooseItem::active()->orderBy('sort_order')->get();
        });

        $recentTeachers = Cache::remember('home_teachers', 300, function () {
            return Teacher::active()->orderBy('sort_order')->orderBy('id')->take(8)->get();
        });

        $counters = Cache::remember('home_counters', 600, function () {
            return Counter::active()->orderBy('sort_order')->get();
        });

        // Cache featured courses (3 minutes - changes more often)
        $featuredCourses = Cache::remember('home_featured_courses', 180, function () {
            return Course::with('category')
                ->active()
                ->homepage()
                ->latest('created_at')
                ->take(6)
                ->get();
        });

        // Cache upcoming events (5 minutes)
        $upcomingEvents = Cache::remember('home_upcoming_events', 300, function () {
            return Event::active()
                ->whereDate('start_date', '>=', now()->toDateString())
                ->orderBy('start_date', 'asc')
                ->orderBy('sort_order', 'asc')
                ->take(6)
                ->get();
        });

        // Set SEO page name for this view
        view()->share('seoPageName', 'home');

        return view('frontend.pages.home', compact(
            'sliders',
            'testimonials',
            'recentBlogs',
            'categories',
            'aboutSection',
            'recentTeachers',
            'counters',
            'whyChooseItems',
            'featuredCourses',
            'upcomingEvents'
        ));
    }
}
