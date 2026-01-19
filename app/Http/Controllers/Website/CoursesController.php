<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

class CoursesController extends Controller
{
    /**
     * Display the courses listing page.
     */
    public function index()
    {
        return view('frontend.pages.courses');
    }

    /**
     * Display a single course details page.
     */
    public function show()
    {
        return view('frontend.pages.course-details');
    }
}
