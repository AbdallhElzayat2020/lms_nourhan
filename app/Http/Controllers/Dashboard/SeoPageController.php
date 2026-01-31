<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SeoPage;
use Illuminate\Http\Request;

class SeoPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seoPages = SeoPage::orderBy('page_title')->paginate(15);
        return view('dashboard.seo-pages.index', compact('seoPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.seo-pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_name' => 'required|string|max:255|unique:seo_pages,page_name',
            'page_title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:1000',
            'schema_markup' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:500',
            'status' => 'required|in:active,inactive',
        ]);

        SeoPage::create($validated);

        return redirect()->route('admin.seo-pages.index', request()->query())
            ->with('success', 'SEO page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SeoPage $seoPage)
    {
        return view('dashboard.seo-pages.show', compact('seoPage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SeoPage $seoPage)
    {
        return view('dashboard.seo-pages.edit', compact('seoPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SeoPage $seoPage)
    {
        $validated = $request->validate([
            'page_name' => 'required|string|max:255|unique:seo_pages,page_name,' . $seoPage->id,
            'page_title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:1000',
            'schema_markup' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:500',
            'status' => 'required|in:active,inactive',
        ]);

        $seoPage->update($validated);

        return redirect()->route('admin.seo-pages.index', request()->query())
            ->with('success', 'SEO page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, SeoPage $seoPage)
    {
        $seoPage->delete();

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

        return redirect()->route('admin.seo-pages.index', $queryParams)
            ->with('success', 'SEO page deleted successfully.');
    }
}
