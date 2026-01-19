<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseItem;
use Illuminate\Http\Request;

class WhyChooseItemController extends Controller
{
    public function index()
    {
        $items = WhyChooseItem::orderBy('sort_order')->paginate(15);
        return view('dashboard.why-choose-items.index', compact('items'));
    }

    public function create()
    {
        return view('dashboard.why-choose-items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'icon_class' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        WhyChooseItem::create($validated);

        return redirect()->route('admin.why-choose-items.index')
            ->with('success', 'Why Choose item created successfully.');
    }

    public function edit(WhyChooseItem $whyChooseItem)
    {
        return view('dashboard.why-choose-items.edit', ['item' => $whyChooseItem]);
    }

    public function update(Request $request, WhyChooseItem $whyChooseItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'icon_class' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $whyChooseItem->update($validated);

        return redirect()->route('admin.why-choose-items.index')
            ->with('success', 'Why Choose item updated successfully.');
    }

    public function destroy(WhyChooseItem $whyChooseItem)
    {
        $whyChooseItem->delete();

        return redirect()->route('admin.why-choose-items.index')
            ->with('success', 'Why Choose item deleted successfully.');
    }
}

