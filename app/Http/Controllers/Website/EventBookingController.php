<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventBooking;
use Illuminate\Http\Request;

class EventBookingController extends Controller
{
    /**
     * Show the booking form for an event.
     */
    public function create($slug)
    {
        $event = Event::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        return view('frontend.pages.event-booking', compact('event'));
    }

    /**
     * Store a newly created booking.
     */
    public function store(Request $request, $slug)
    {
        $event = Event::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'notes' => 'nullable|string|max:5000',
        ]);

        $validated['event_id'] = $event->id;
        $validated['status'] = 'pending';

        EventBooking::create($validated);

        return redirect()->route('frontend.success.send')
            ->with('success', 'Thank you! Your booking request has been submitted successfully. We will contact you soon.');
    }
}
