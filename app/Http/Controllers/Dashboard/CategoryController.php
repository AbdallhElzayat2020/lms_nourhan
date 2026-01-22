<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('sort_order')->paginate(15);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'nullable|string|max:255|unique:categories,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'schema_block' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $validated['image'] = $image->storeAs('', $imageName, 'categories');
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        } else {
            // Ensure slug is properly formatted
            $validated['slug'] = Str::slug($validated['slug']);
        }

        Category::create($validated);

        // Clear related cache
        Cache::forget('home_categories');
        Cache::forget('course_categories');
        Cache::forget('blog_categories');

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $id . '|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'schema_block' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('categories')->delete(basename($category->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $validated['image'] = $image->storeAs('', $imageName, 'categories');
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        } else {
            // Ensure slug is properly formatted
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        if ($category->image) {
            Storage::disk('categories')->delete(basename($category->image));
        }

        $category->delete();

        // Clear related cache
        Cache::forget('home_categories');
        Cache::forget('course_categories');
        Cache::forget('blog_categories');

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
