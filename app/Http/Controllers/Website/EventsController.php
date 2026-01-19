<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventsController extends Controller
{
    /**
     * Display the events listing page.
     */
    public function index()
    {
        $events = Event::active()
            ->orderBy('start_date', 'asc')
            ->orderBy('sort_order', 'asc')
            ->paginate(12);

        // Set SEO page name for this view
        view()->share('seoPageName', 'events');

        return view('frontend.pages.events', compact('events'));
    }

    /**
     * Display a single event details page.
     */
    public function show($slug)
    {
        $event = Event::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $relatedEvents = Event::where('id', '!=', $event->id)
            ->where('status', 'active')
            ->orderBy('start_date', 'asc')
            ->limit(3)
            ->get();

        // Set dynamic SEO model for this event
        view()->share('dynamicSeoModel', $event);

        return view('frontend.pages.event-details', compact('event', 'relatedEvents'));
    }
}
