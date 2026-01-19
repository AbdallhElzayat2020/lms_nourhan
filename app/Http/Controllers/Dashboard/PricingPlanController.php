<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pricingPlans = PricingPlan::orderBy('sort_order')->latest()->paginate(15);
        return view('dashboard.pricing-plans.index', compact('pricingPlans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pricing-plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'price_period' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'schema_block' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',
        ]);

        // Convert features array to JSON
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features']); // Remove empty values
        }

        $validated['is_featured'] = $request->has('is_featured') ? true : false;
        $validated['price_period'] = $validated['price_period'] ?? '/Per month';

        PricingPlan::create($validated);

        return redirect()->route('admin.pricing-plans.index')
            ->with('success', 'Pricing plan created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(PricingPlan $pricingPlan)
    {
        return view('dashboard.pricing-plans.show', compact('pricingPlan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PricingPlan $pricingPlan)
    {
        return view('dashboard.pricing-plans.edit', compact('pricingPlan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PricingPlan $pricingPlan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'price_period' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'schema_block' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',
        ]);

        // Convert features array to JSON
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features']); // Remove empty values
        }

        $validated['is_featured'] = $request->has('is_featured') ? true : false;
        $validated['price_period'] = $validated['price_period'] ?? '/Per month';

        $pricingPlan->update($validated);

        return redirect()->route('admin.pricing-plans.index')
            ->with('success', 'Pricing plan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PricingPlan $pricingPlan)
    {
        $pricingPlan->delete();

        return redirect()->route('admin.pricing-plans.index')
            ->with('success', 'Pricing plan deleted successfully');
    }
}
