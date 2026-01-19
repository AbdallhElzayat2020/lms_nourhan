<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\CourseFeedback;

class CourseFeedbackController extends Controller
{
    /**
     * Display the course feedbacks page.
     */
    public function index()
    {
        $feedbacks = CourseFeedback::active()
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Set SEO page name for this view
        view()->share('seoPageName', 'course-feedbacks');

        return view('frontend.pages.course-feedbacks', compact('feedbacks'));
    }
}
