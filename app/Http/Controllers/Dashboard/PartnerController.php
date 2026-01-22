<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::orderBy('sort_order')->latest()->paginate(15);
        return view('dashboard.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'link' => 'nullable|url|max:500',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $validated['logo'] = $logo->storeAs('', $logoName, 'partners');
        }

        Partner::create($validated);

        // Clear related cache
        Cache::forget('home_partners');

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        return view('dashboard.partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        return view('dashboard.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'link' => 'nullable|url|max:500',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            if ($partner->logo) {
                Storage::disk('partners')->delete(basename($partner->logo));
            }
            $logo = $request->file('logo');
            $logoName = time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $validated['logo'] = $logo->storeAs('', $logoName, 'partners');
        }

        $partner->update($validated);

        // Clear related cache
        Cache::forget('home_partners');

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        if ($partner->logo) {
            Storage::disk('partners')->delete(basename($partner->logo));
        }

        $partner->delete();

        // Clear related cache
        Cache::forget('home_partners');

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner deleted successfully');
    }
}
