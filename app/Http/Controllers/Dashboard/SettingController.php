<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('dashboard.settings.index', compact('settings'));
    }

    /**
     * Update the settings.
     */
    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'author_name' => 'nullable|string|max:255',
                'author_title' => 'nullable|string|max:255',
                'author_bio' => 'nullable|string',
                'author_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            ]);

            \Log::info('Settings update request', [
                'has_file' => $request->hasFile('author_image'),
                'validated' => $validated
            ]);

            // Handle author image upload
            if ($request->hasFile('author_image')) {
                \Log::info('Processing image upload');

                // Ensure uploads/settings directory exists
                $settingsPath = public_path('uploads/settings');
                if (!file_exists($settingsPath)) {
                    mkdir($settingsPath, 0755, true);
                }

                // Delete old image if exists
                $oldImage = Setting::get('author_image');
                if ($oldImage) {
                    $oldImagePath = public_path('uploads/settings/' . $oldImage);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                    \Log::info('Deleted old image: ' . $oldImage);
                }

                $image = $request->file('author_image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                \Log::info('Storing image: ' . $imageName);
                $stored = $image->storeAs('', $imageName, 'settings');
                \Log::info('Image stored result: ' . ($stored ? 'success' : 'failed'));

                if ($stored) {
                    Setting::set('author_image', $imageName, 'image', 'author', 'Author Image', 'Profile image for the author');
                    \Log::info('Setting saved: ' . $imageName);
                }
            }

            // Update other settings
            if ($request->has('author_name')) {
                Setting::set('author_name', $validated['author_name'], 'text', 'author', 'Author Name', 'Full name of the author');
            }

            if ($request->has('author_title')) {
                Setting::set('author_title', $validated['author_title'], 'text', 'author', 'Author Title', 'Professional title of the author');
            }

            if ($request->has('author_bio')) {
                Setting::set('author_bio', $validated['author_bio'], 'textarea', 'author', 'Author Bio', 'Biography of the author');
            }

            return redirect()->route('admin.settings.index')
                ->with('success', 'Settings updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating settings: ' . $e->getMessage())
                ->withInput();
        }
    }
}
