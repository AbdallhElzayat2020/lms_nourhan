<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counters = Counter::orderBy('sort_order', 'asc')->get();

        return view('dashboard.counters.index', compact('counters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.counters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        Counter::create($validated);

        // Clear related cache
        Cache::forget('home_counters');

        return redirect()->route('admin.counters.index')
            ->with('success', 'Counter created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Counter $counter)
    {
        return view('dashboard.counters.edit', compact('counter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Counter $counter)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $counter->update($validated);

        return redirect()->route('admin.counters.index')
            ->with('success', 'Counter updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Counter $counter)
    {
        $counter->delete();

        // Clear related cache
        Cache::forget('home_counters');

        return redirect()->route('admin.counters.index')
            ->with('success', 'Counter deleted successfully');
    }
}

