<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutSection extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'subtitle',
        'title',
        'description',
        'button_text',
        'button_link',
        'video_url',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Scope a query to only include active sections.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get the normalized YouTube embed URL for the video.
     *
     * This allows admins to paste any regular YouTube link (watch, youtu.be, shorts),
     * and it will be converted to an embeddable URL automatically when used
     * as $aboutSection->embed_video_url.
     */
    public function getEmbedVideoUrlAttribute(): ?string
    {
        if (empty($this->video_url)) {
            return null;
        }

        $url = trim($this->video_url);

        // If it's already an embed URL, return as-is
        if (str_contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        // Extract YouTube video ID from different URL formats
        $videoId = null;

        // Short URL: https://youtu.be/VIDEO_ID or https://youtu.be/VIDEO_ID?params
        if (preg_match('~https?://youtu\.be/([^?&/]+)~i', $url, $matches)) {
            $videoId = $matches[1];
        }

        // Watch URL: https://www.youtube.com/watch?v=VIDEO_ID
        if (!$videoId && preg_match('~[?&]v=([^?&/]+)~i', $url, $matches)) {
            $videoId = $matches[1];
        }

        // Shorts URL: https://www.youtube.com/shorts/VIDEO_ID
        if (!$videoId && preg_match('~youtube\.com/shorts/([^?&/]+)~i', $url, $matches)) {
            $videoId = $matches[1];
        }

        // Fallback: if nothing matched, try to grab the last path segment as ID
        if (!$videoId && preg_match('~youtube\.com/.+?/([^?&/]+)~i', $url, $matches)) {
            $videoId = $matches[1];
        }

        if (!$videoId) {
            // If we cannot detect a valid ID, return the original URL
            return $url;
        }

        return 'https://www.youtube.com/embed/' . $videoId;
    }
}
