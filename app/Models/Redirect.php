<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $fillable = [
        'old_url',
        'new_url',
        'status_code',
        'status',
        'hit_count',
        'last_hit_at',
        'description',
    ];

    protected $casts = [
        'status_code' => 'string',
        'status' => 'string',
        'hit_count' => 'integer',
        'last_hit_at' => 'datetime',
    ];

    /**
     * Scope a query to only include active redirects.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Increment hit count
     */
    public function incrementHit()
    {
        $this->increment('hit_count');
        $this->update(['last_hit_at' => now()]);
    }

    /**
     * Get redirect by old URL
     */
    public static function findByOldUrl($url)
    {
        return self::active()->where('old_url', $url)->first();
    }
}
