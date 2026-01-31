<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CourseFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = CourseFeedback::orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->get();
        return view('dashboard.course-feedbacks.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.course-feedbacks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'video_url' => 'nullable|url|max:500',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $validated['image'] = $image->storeAs('', $imageName, 'course_feedbacks');
        }

        CourseFeedback::create($validated);

        return redirect()->route('admin.course-feedbacks.index', request()->query())
            ->with('success', 'Course Feedback created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseFeedback $courseFeedback)
    {
        return view('dashboard.course-feedbacks.show', compact('courseFeedback'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseFeedback $courseFeedback)
    {
        return view('dashboard.course-feedbacks.edit', compact('courseFeedback'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseFeedback $courseFeedback)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'video_url' => 'nullable|url|max:500',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            if ($courseFeedback->image) {
                Storage::disk('course_feedbacks')->delete(basename($courseFeedback->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $validated['image'] = $image->storeAs('', $imageName, 'course_feedbacks');
        }

        $courseFeedback->update($validated);

        return redirect()->route('admin.course-feedbacks.index', request()->query())
            ->with('success', 'Course Feedback updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, CourseFeedback $courseFeedback)
    {
        if ($courseFeedback->image) {
            Storage::disk('course_feedbacks')->delete(basename($courseFeedback->image));
        }

        $courseFeedback->delete();

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

        return redirect()->route('admin.course-feedbacks.index', $queryParams)
            ->with('success', 'Course Feedback deleted successfully');
    }
}
