<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Show public testimonial form.
     */
    public function create()
    {
        return view('frontend.pages.testimonial-create');
    }

    /**
     * Store a new testimonial submitted from the website.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'description' => 'required|string|max:5000',
        ]);

        Testimonial::create([
            'name' => $validated['name'],
            'country' => $validated['country'] ?? null,
            'gender' => $validated['gender'],
            'source' => 'user',
            'description' => $validated['description'],
            'status' => 'inactive', // pending review
            'rating' => 5,
        ]);

        return redirect()
            ->route('frontend.success.send')
            ->with('success', 'Your feedback has been sent to the admin and is pending review. Thank you!');
    }
}

