<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AboutSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aboutSection = AboutSection::first();

        // If no section exists, create a default one
        if (!$aboutSection) {
            $aboutSection = AboutSection::create([
                'subtitle' => 'About Our Platform',
                'title' => 'We are innovative educational institution to the creation of the student',
                'description' => 'Our team consists of certified IT professionals with expertise in network security, cloud computing, software development, and technical support. With decades of combined experience, we provide strategic IT guidance and technical support tailored to your business needs.',
                'button_text' => 'Browse All Courses',
                'button_link' => '#',
                'video_url' => 'https://www.youtube.com/embed/qjxDcU4m2FQ?si=9JC0uy-hV0SeDxQR',
                'status' => 'active',
            ]);
        }

        return view('dashboard.about-sections.index', compact('aboutSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutSection $aboutSection)
    {
        return view('dashboard.about-sections.edit', compact('aboutSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutSection $aboutSection)
    {
        $validated = $request->validate([
            'subtitle' => 'nullable|string|max:255',
            'title' => 'required|string|max:500',
            'description' => 'nullable|string|max:3000',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:500',
            'video_url' => 'nullable|string|max:2000',
            'status' => 'required|in:active,inactive',
        ]);

        $aboutSection->update($validated);

        // Clear related cache
        Cache::forget('home_about_section');

        return redirect()->route('admin.about-sections.index')
            ->with('success', 'About section updated successfully');
    }
}
