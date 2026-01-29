<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\AboutSection;
use App\Models\Blog;
use App\Models\Counter;
use App\Models\AboutInfo;

class AboutController extends Controller
{
    /**
     * Display the about page.
     */
    public function index()
    {
        $testimonials = Testimonial::active()->orderBy('sort_order')->latest()->take(10)->get();
        $aboutSection = AboutSection::active()->first();
        $recentBlogs = Blog::active()->published()->latest()->take(3)->get();
        $counters = Counter::active()->orderBy('sort_order')->get();
        $aboutInfos = AboutInfo::active()->orderBy('sort_order')->get();

        // Set SEO page name for this view
        view()->share('seoPageName', 'about');

        return view('frontend.pages.about', compact('testimonials', 'aboutSection', 'recentBlogs', 'counters', 'aboutInfos'));
    }
}
