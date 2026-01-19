<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'short_description',
        'description',
        'start_date',
        'end_date',
        'time',
        'location',
        'google_map_link',
        'phone',
        'status',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'schema_block',
        'canonical_url',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'string',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->name);
            }
        });

        static::updating(function ($event) {
            if ($event->isDirty('name') && empty($event->slug)) {
                $event->slug = Str::slug($event->name);
            }
        });
    }

    /**
     * Scope a query to only include active events.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include inactive events.
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Get the bookings for the event.
     */
    public function bookings()
    {
        return $this->hasMany(EventBooking::class);
    }

    /**
     * Get the pending bookings count.
     */
    public function getPendingBookingsCountAttribute()
    {
        return $this->bookings()->where('status', 'pending')->count();
    }
}
