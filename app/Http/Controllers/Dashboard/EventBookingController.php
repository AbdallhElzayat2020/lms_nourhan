<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\EventBooking;
use Illuminate\Http\Request;

class EventBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = EventBooking::with('event')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('dashboard.event-bookings.index', compact('bookings'));
    }

    /**
     * Display the specified resource.
     */
    public function show(EventBooking $eventBooking)
    {
        $eventBooking->load('event');
        return view('dashboard.event-bookings.show', compact('eventBooking'));
    }

    /**
     * Update the status of the booking.
     */
    public function updateStatus(Request $request, EventBooking $eventBooking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $eventBooking->update($validated);

        return redirect()->back()
            ->with('success', 'Booking status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventBooking $eventBooking)
    {
        $eventBooking->delete();

        return redirect()->route('admin.event-bookings.index')
            ->with('success', 'Booking deleted successfully');
    }
}
