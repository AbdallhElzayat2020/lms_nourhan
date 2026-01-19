<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /**
     * Display the book page.
     */
    public function index()
    {
        // Set SEO page name for this view
        view()->share('seoPageName', 'book');

        return view('frontend.pages.book');
    }
}
