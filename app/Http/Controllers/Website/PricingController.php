<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;

class PricingController extends Controller
{
    /**
     * Display the pricing page.
     */
    public function index()
    {
        $pricingPlans = PricingPlan::active()->orderBy('sort_order')->get();
        // Set SEO page name for this view
        view()->share('seoPageName', 'pricing');
        
        return view('frontend.pages.pricing', compact('pricingPlans'));
    }
}
