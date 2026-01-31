<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Redirect;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $redirects = Redirect::orderBy('created_at', 'desc')->paginate(15);
        return view('dashboard.redirects.index', compact('redirects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.redirects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'old_url' => 'required|string|max:255|unique:redirects,old_url',
            'new_url' => 'required|string|max:255',
            'status_code' => 'required|in:301,302',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        // Clean URLs
        $validated['old_url'] = $this->cleanUrl($validated['old_url']);
        $validated['new_url'] = $this->cleanUrl($validated['new_url']);

        Redirect::create($validated);

        return redirect()->route('admin.redirects.index', request()->query())
            ->with('success', 'Redirect created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Redirect $redirect)
    {
        return view('dashboard.redirects.show', compact('redirect'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Redirect $redirect)
    {
        return view('dashboard.redirects.edit', compact('redirect'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Redirect $redirect)
    {
        $validated = $request->validate([
            'old_url' => 'required|string|max:255|unique:redirects,old_url,' . $redirect->id,
            'new_url' => 'required|string|max:255',
            'status_code' => 'required|in:301,302',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        // Clean URLs
        $validated['old_url'] = $this->cleanUrl($validated['old_url']);
        $validated['new_url'] = $this->cleanUrl($validated['new_url']);

        $redirect->update($validated);

        return redirect()->route('admin.redirects.index')
            ->with('success', 'Redirect updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Redirect $redirect)
    {
        $redirect->delete();

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

        return redirect()->route('admin.redirects.index', $queryParams)
            ->with('success', 'Redirect deleted successfully.');
    }

    /**
     * Clean URL by removing domain and ensuring it starts with /
     */
    private function cleanUrl($url)
    {
        // Remove protocol and domain
        $url = preg_replace('/^https?:\/\/[^\/]+/', '', $url);

        // Ensure it starts with /
        if (!str_starts_with($url, '/')) {
            $url = '/' . $url;
        }

        return $url;
    }
}
