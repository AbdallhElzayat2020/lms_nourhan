<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventBooking extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'email',
        'phone',
        'notes',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Get the event that owns the booking.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Scope a query to only include pending bookings.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include confirmed bookings.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope a query to only include cancelled bookings.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
}
