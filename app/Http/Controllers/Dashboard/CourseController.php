<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $courses = Course::with('category')
            ->latest('created_at')
            ->paginate(15)
            ->appends($request->query());
        return view('dashboard.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::active()->orderBy('name')->get();
        $faqs = Faq::active()->orderBy('sort_order')->get();
        return view('dashboard.courses.create', compact('categories', 'faqs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:courses,slug',
            'category_id' => 'nullable|exists:categories,id',
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'lessons_count' => 'nullable|integer|min:0',
            'course_type' => 'required|in:private,live,both',
            'duration_hours' => 'nullable|integer|min:0',
            'language' => 'nullable|string|max:255',
            'about_program_text' => 'nullable|string',
            'about_program_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'how_course_works_text' => 'nullable|string',
            'how_course_works_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'what_you_achieve_text' => 'nullable|string',
            'what_you_achieve_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
            'faqs' => 'nullable|array',
            'faqs.*' => 'exists:faqs,id',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle banner image
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $validated['banner_image'] = $image->storeAs('', $imageName, 'courses');
        }

        // Handle about_program_image
        if ($request->hasFile('about_program_image')) {
            $image = $request->file('about_program_image');
            $imageName = time() . '_about_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $validated['about_program_image'] = $image->storeAs('', $imageName, 'courses');
        }

        // Handle how_course_works_image
        if ($request->hasFile('how_course_works_image')) {
            $image = $request->file('how_course_works_image');
            $imageName = time() . '_how_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $validated['how_course_works_image'] = $image->storeAs('', $imageName, 'courses');
        }

        // Handle what_you_achieve_image
        if ($request->hasFile('what_you_achieve_image')) {
            $image = $request->file('what_you_achieve_image');
            $imageName = time() . '_achieve_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $validated['what_you_achieve_image'] = $image->storeAs('', $imageName, 'courses');
        }

        // Handle show_on_homepage
        $validated['show_on_homepage'] = $request->has('show_on_homepage') ? true : false;

        // Remove faqs from validated array before creating
        $faqs = $validated['faqs'] ?? [];
        unset($validated['faqs']);

        // Convert empty strings to null for nullable fields
        if (isset($validated['lessons_count']) && $validated['lessons_count'] === '') {
            $validated['lessons_count'] = null;
        }
        if (isset($validated['duration_hours']) && $validated['duration_hours'] === '') {
            $validated['duration_hours'] = null;
        }
        if (isset($validated['language']) && $validated['language'] === '') {
            $validated['language'] = null;
        }

        $course = Course::create($validated);

        // Attach FAQs
        if (!empty($faqs)) {
            $course->faqs()->attach($faqs);
        }

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $course->load('category', 'faqs');
        return view('dashboard.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $course->load('faqs');
        $categories = Category::active()->orderBy('name')->get();
        $faqs = Faq::active()->orderBy('sort_order')->get();
        return view('dashboard.courses.edit', compact('course', 'categories', 'faqs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:courses,slug,' . $course->id,
            'category_id' => 'nullable|exists:categories,id',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'lessons_count' => 'nullable|integer|min:0',
            'course_type' => 'required|in:private,live,both',
            'duration_hours' => 'nullable|integer|min:0',
            'language' => 'nullable|string|max:255',
            'about_program_text' => 'nullable|string',
            'about_program_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'how_course_works_text' => 'nullable|string',
            'how_course_works_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'what_you_achieve_text' => 'nullable|string',
            'what_you_achieve_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'required|in:active,inactive',
            'show_on_homepage' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'schema_block' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'faqs' => 'nullable|array',
            'faqs.*' => 'exists:faqs,id',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle show_on_homepage
        $validated['show_on_homepage'] = $request->has('show_on_homepage') ? true : false;

        // Handle banner image
        if ($request->hasFile('banner_image')) {
            if ($course->banner_image) {
                Storage::disk('courses')->delete(basename($course->banner_image));
            }
            $image = $request->file('banner_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $validated['banner_image'] = $image->storeAs('', $imageName, 'courses');
        }

        // Handle about_program_image
        if ($request->hasFile('about_program_image')) {
            if ($course->about_program_image) {
                Storage::disk('courses')->delete(basename($course->about_program_image));
            }
            $image = $request->file('about_program_image');
            $imageName = time() . '_about_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $validated['about_program_image'] = $image->storeAs('', $imageName, 'courses');
        }

        // Handle how_course_works_image
        if ($request->hasFile('how_course_works_image')) {
            if ($course->how_course_works_image) {
                Storage::disk('courses')->delete(basename($course->how_course_works_image));
            }
            $image = $request->file('how_course_works_image');
            $imageName = time() . '_how_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $validated['how_course_works_image'] = $image->storeAs('', $imageName, 'courses');
        }

        // Handle what_you_achieve_image
        if ($request->hasFile('what_you_achieve_image')) {
            if ($course->what_you_achieve_image) {
                Storage::disk('courses')->delete(basename($course->what_you_achieve_image));
            }
            $image = $request->file('what_you_achieve_image');
            $imageName = time() . '_achieve_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $validated['what_you_achieve_image'] = $image->storeAs('', $imageName, 'courses');
        }

        // Remove faqs from validated array before updating
        $faqs = $validated['faqs'] ?? [];
        unset($validated['faqs']);

        // Convert empty strings to null for nullable fields
        if (isset($validated['lessons_count']) && ($validated['lessons_count'] === '' || $validated['lessons_count'] === null)) {
            $validated['lessons_count'] = null;
        }
        if (isset($validated['duration_hours']) && ($validated['duration_hours'] === '' || $validated['duration_hours'] === null)) {
            $validated['duration_hours'] = null;
        }
        if (isset($validated['language']) && ($validated['language'] === '' || $validated['language'] === null)) {
            $validated['language'] = null;
        }

        $course->update($validated);

        // Sync FAQs
        $course->faqs()->sync($faqs);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Course $course)
    {
        // Delete images
        if ($course->banner_image) {
            Storage::disk('courses')->delete(basename($course->banner_image));
        }
        if ($course->about_program_image) {
            Storage::disk('courses')->delete(basename($course->about_program_image));
        }
        if ($course->how_course_works_image) {
            Storage::disk('courses')->delete(basename($course->how_course_works_image));
        }
        if ($course->what_you_achieve_image) {
            Storage::disk('courses')->delete(basename($course->what_you_achieve_image));
        }

        $course->delete();

        // Get query parameters from POST data, referer URL, or request query
        $queryParams = [];

        // First, check POST data (from hidden inputs in form)
        if ($request->has('page')) {
            $queryParams['page'] = $request->input('page');
        }

        // If not in POST, try to get from referer URL
        if (empty($queryParams)) {
            $referer = $request->header('referer');
            if ($referer) {
                $parsedUrl = parse_url($referer);
                if (isset($parsedUrl['query'])) {
                    parse_str($parsedUrl['query'], $queryParams);
                }
            }
        }

        // Fallback to request query if still empty
        if (empty($queryParams)) {
            $queryParams = $request->query();
        }

        // If we're on a page and it might be empty after deletion, go to previous page
        if (isset($queryParams['page']) && $queryParams['page'] > 1) {
            $currentPage = (int) $queryParams['page'];
            $totalAfterDelete = Course::count();

            // If the page might be empty, go to previous page
            // Calculate items per page (15 in this case)
            $itemsPerPage = 15;
            if ($totalAfterDelete <= ($currentPage - 1) * $itemsPerPage) {
                $queryParams['page'] = max(1, $currentPage - 1);
            }
        }

        return redirect()->route('admin.courses.index', $queryParams)
            ->with('success', 'Course deleted successfully');
    }
}
