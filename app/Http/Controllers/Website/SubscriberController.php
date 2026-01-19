<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Store a newly created subscriber from footer form.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:rfc,dns|max:255|unique:subscribers,email,NULL,id,deleted_at,NULL',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already subscribed to our newsletter.',
        ]);

        $subscriber = Subscriber::create([
            'email' => $validated['email'],
            'is_active' => true,
            'subscribed_at' => now(),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Thank you for subscribing to our newsletter.',
            ], 201);
        }

        return redirect()->route('frontend.success.send')
            ->with('success', 'Thank you for subscribing to our newsletter!');
    }
}

