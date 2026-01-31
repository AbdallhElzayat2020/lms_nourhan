<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AboutInfo;
use Illuminate\Http\Request;

class AboutInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aboutInfos = AboutInfo::orderBy('sort_order')->get();

        return view('dashboard.about-infos.index', compact('aboutInfos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.about-infos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:about_infos,slug',
            'description' => 'required|string',
            'icon_class' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        AboutInfo::create($validated);

        return redirect()->route('admin.about-infos.index', request()->query())
            ->with('success', 'Item created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutInfo $aboutInfo)
    {
        return view('dashboard.about-infos.edit', compact('aboutInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutInfo $aboutInfo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:about_infos,slug,' . $aboutInfo->id,
            'description' => 'required|string',
            'icon_class' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $aboutInfo->update($validated);

        return redirect()->route('admin.about-infos.index', request()->query())
            ->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutInfo $aboutInfo)
    {
        $aboutInfo->delete();

        return redirect()->route('admin.about-infos.index')
            ->with('success', 'Item deleted successfully');
    }
}

