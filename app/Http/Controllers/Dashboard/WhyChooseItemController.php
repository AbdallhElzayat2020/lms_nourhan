<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WhyChooseItemController extends Controller
{
    public function index()
    {
        $items = WhyChooseItem::orderBy('sort_order', 'asc')->get();
        return view('dashboard.why-choose-items.index', compact('items'));
    }

    public function edit(WhyChooseItem $whyChooseItem)
    {
        return view('dashboard.why-choose-items.edit', ['item' => $whyChooseItem]);
    }

    public function update(Request $request, WhyChooseItem $whyChooseItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'nullable|string|max:2000',
            'icon_class' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        // Normalize YouTube URL to embeddable format
        if (!empty($validated['video_url'])) {
            $validated['video_url'] = $this->normalizeYouTubeUrl($validated['video_url']);
        }

        $whyChooseItem->update($validated);

        // Clear related cache
        Cache::forget('home_why_choose');

        return redirect()->route('admin.why-choose-items.index')
            ->with('success', 'Why Choose item updated successfully.');
    }

    /**
     * Convert any common YouTube URL format to an embeddable URL.
     */
    protected function normalizeYouTubeUrl(string $url): string
    {
        $url = trim($url);

        // If it's already an embed URL, return as-is
        if (str_contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        $videoId = null;

        // Short URL: https://youtu.be/VIDEO_ID
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

        // Fallback: use the last path segment if possible
        if (!$videoId && preg_match('~youtube\.com/.+?/([^?&/]+)~i', $url, $matches)) {
            $videoId = $matches[1];
        }

        if (!$videoId) {
            return $url;
        }

        return 'https://www.youtube.com/embed/' . $videoId;
    }
}

