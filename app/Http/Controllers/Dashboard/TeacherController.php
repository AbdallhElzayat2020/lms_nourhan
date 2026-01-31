<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::latest()->paginate(15);
        return view('dashboard.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:teachers,slug',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'video_url' => 'nullable|string|max:2000',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'schema_block' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
            // Ensure uniqueness
            $count = 1;
            $originalSlug = $validated['slug'];
            while (Teacher::where('slug', $validated['slug'])->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $validated['image'] = $image->storeAs('', $imageName, 'teachers');
        }

        $teacher = Teacher::create($validated);

        // Handle certificates
        $this->handleCertificates($request, $teacher);

        // Clear related cache
        Cache::forget('home_teachers');

        return redirect()->route('admin.teachers.index', request()->query())
            ->with('success', 'Teacher created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('dashboard.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $teacher->load('certificates');
        return view('dashboard.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:teachers,slug,' . $teacher->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'video_url' => 'nullable|string|max:2000',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'schema_block' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
            // Ensure uniqueness
            $count = 1;
            $originalSlug = $validated['slug'];
            while (Teacher::where('slug', $validated['slug'])->where('id', '!=', $teacher->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        if ($request->hasFile('image')) {
            if ($teacher->image) {
                Storage::disk('teachers')->delete(basename($teacher->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $validated['image'] = $image->storeAs('', $imageName, 'teachers');
        }

        $teacher->update($validated);

        // Handle certificates
        $this->handleCertificates($request, $teacher);

        // Clear related cache
        Cache::forget('home_teachers');

        return redirect()->route('admin.teachers.index', request()->query())
            ->with('success', 'Teacher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Teacher $teacher)
    {
        if ($teacher->image) {
            Storage::disk('teachers')->delete(basename($teacher->image));
        }

        $teacher->delete();

        // Clear related cache
        Cache::forget('home_teachers');

        $queryParams = [];
        if ($request->filled('index_query')) {
            parse_str($request->input('index_query'), $queryParams);
        }
        if (empty($queryParams) && $request->header('referer')) {
            $q = parse_url($request->header('referer'), PHP_URL_QUERY);
            if ($q) {
                parse_str($q, $queryParams);
            }
        }

        return redirect()->route('admin.teachers.index', $queryParams)
            ->with('success', 'Teacher deleted successfully');
    }

    /**
     * Handle certificate uploads and management.
     */
    private function handleCertificates(Request $request, Teacher $teacher)
    {
        // Handle certificate uploads
        if ($request->hasFile('certificate_images')) {
            foreach ($request->file('certificate_images') as $index => $file) {
                if ($file && $file->isValid()) {
                    // Store the certificate image
                    $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $imagePath = $file->storeAs('', $imageName, 'teacher_certificates');

                    // Get certificate data
                    $title = $request->input('certificate_titles.' . $index, 'Certificate');
                    $issuer = $request->input('certificate_issuers.' . $index);
                    $description = $request->input('certificate_descriptions.' . $index);
                    $imageAlt = $request->input('certificate_alts.' . $index);

                    // Create certificate record
                    $teacher->certificates()->create([
                        'title' => $title,
                        'issuer' => $issuer,
                        'image' => $imagePath,
                        'image_alt' => $imageAlt,
                        'description' => $description,
                        'sort_order' => $index,
                        'status' => 'active',
                    ]);
                }
            }
        }

        // Handle certificate updates (for existing certificates)
        if ($request->has('existing_certificate_ids')) {
            foreach ($request->input('existing_certificate_ids', []) as $index => $certificateId) {
                $certificate = $teacher->certificates()->find($certificateId);
                if ($certificate) {
                    $certificate->update([
                        'title' => $request->input('existing_certificate_titles.' . $index, $certificate->title),
                        'issuer' => $request->input('existing_certificate_issuers.' . $index, $certificate->issuer),
                        'description' => $request->input('existing_certificate_descriptions.' . $index, $certificate->description),
                        'image_alt' => $request->input('existing_certificate_alts.' . $index, $certificate->image_alt),
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        // Handle certificate deletions
        if ($request->has('delete_certificate_ids')) {
            $deleteIds = array_filter($request->input('delete_certificate_ids', []));
            foreach ($deleteIds as $certificateId) {
                $certificate = $teacher->certificates()->find($certificateId);
                if ($certificate) {
                    // Delete the image file
                    if ($certificate->image) {
                        Storage::disk('teacher_certificates')->delete($certificate->image);
                    }
                    // Delete the record
                    $certificate->delete();
                }
            }
        }
    }
}
