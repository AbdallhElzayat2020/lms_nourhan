<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class State extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'country_id',
        'name',
        'slug',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'string',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($state) {
            if (empty($state->slug)) {
                $state->slug = Str::slug($state->name);
            }
        });

        static::updating(function ($state) {
            if ($state->isDirty('name') && empty($state->slug)) {
                $state->slug = Str::slug($state->name);
            }
        });
    }

    /**
     * Get the country that owns the state.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }


    /**
     * Scope a query to only include active states.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
