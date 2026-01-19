<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

class SuccessSendController extends Controller
{
    /**
     * Display the success send page.
     */
    public function index()
    {
        return view('frontend.pages.success-send');
    }
}
