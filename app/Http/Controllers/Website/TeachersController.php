<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Teacher;

class TeachersController extends Controller
{
    /**
     * Display the teachers listing page.
     */
    public function index()
    {
        $teachers = Teacher::active()->orderBy('sort_order')->orderBy('id')->paginate(12);

        // Ensure all teachers have slugs
        foreach ($teachers as $teacher) {
            if (!$teacher->slug) {
                $teacher->ensureSlug();
            }
        }

        // Set SEO page name for this view
        view()->share('seoPageName', 'teachers');

        return view('frontend.pages.teachers', compact('teachers'));
    }

    /**
     * Display a single teacher details page.
     */
    public function show($slug)
    {
        // Try to find by slug first
        $teacher = Teacher::active()->with('activeCertificates')->where('slug', $slug)->first();

        // If not found by slug, try by id (for backward compatibility)
        if (!$teacher && is_numeric($slug)) {
            $teacher = Teacher::active()->with('activeCertificates')->find($slug);
        }

        // If still not found, try to find by slug generated from name
        if (!$teacher) {
            $teacher = Teacher::active()->get()->first(function ($t) use ($slug) {
                return $t->slug_or_generate === $slug;
            });
        }

        if (!$teacher) {
            abort(404, 'Teacher not found');
        }

        // Ensure teacher has a slug (generate if missing)
        if (!$teacher->slug) {
            $teacher->ensureSlug();
        }

        $recentTeachers = Teacher::active()
            ->where('id', '!=', $teacher->id)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->take(8)
            ->get();

        // Ensure all recent teachers have slugs
        foreach ($recentTeachers as $recentTeacher) {
            if (!$recentTeacher->slug) {
                $recentTeacher->ensureSlug();
            }
        }

        // Set dynamic SEO model for this teacher
        view()->share('dynamicSeoModel', $teacher);

        return view('frontend.pages.teacher-details', compact('teacher', 'recentTeachers'));
    }
}
