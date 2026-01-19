<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        // Set SEO page name for this view
        view()->share('seoPageName', 'contact');

        return view('frontend.pages.contact');
    }

    /**
     * Store a new contact message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'timezone' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'notes' => 'nullable|max:5000',
        ]);

        // Map 'notes' to 'message' for database compatibility
        $contactData = $validated;
        $contactData['message'] = $validated['notes'] ?? '';

        Contact::create($contactData);

        return redirect()->route('frontend.success.send')
            ->with('success', 'Your message has been sent successfully!');
    }
}
