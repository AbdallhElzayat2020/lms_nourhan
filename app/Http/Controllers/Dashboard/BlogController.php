<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Blog::with('blogCategory');

        // Filter by category slug if provided
        if ($request->has('category') && $request->category != '') {
            $category = BlogCategory::where('slug', $request->category)->first();
            if ($category) {
                $query->where('blog_category_id', $category->id);
            }
        }

        $blogs = $query->latest('created_at')
            ->paginate(15)
            ->appends($request->query());

        $categories = BlogCategory::active()->latest()->get();
        $selectedCategory = $request->has('category') && $request->category != ''
            ? BlogCategory::where('slug', $request->category)->first()
            : null;

        return view('dashboard.blogs.index', compact('blogs', 'categories', 'selectedCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::active()->orderBy('name')->get();
        return view('dashboard.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255|unique:blogs,title',
                'slug' => 'nullable|string|max:255|unique:blogs,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                'short_description' => 'nullable|string',
                'description' => 'nullable|string',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string',
                'schema_block' => 'nullable|string',
                'canonical_url' => 'nullable|url|max:255',
                'cover_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'author' => 'nullable|string|max:255',
                'blog_category_id' => 'nullable|exists:blog_categories,id',
                'status' => 'required|in:active,inactive',
                'show_on_homepage' => 'nullable|boolean',
                'published_at' => 'nullable|date',
                'sort_order' => 'nullable|integer|min:0',
            ]);

            // Handle cover image upload
            if ($request->hasFile('cover_image')) {
                $image = $request->file('cover_image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $validated['cover_image'] = $image->storeAs('', $imageName, 'blogs');
            }

            // Handle slug generation
            if (empty($validated['slug'])) {
                $validated['slug'] = Blog::generateUniqueSlug($validated['title']);
            } else {
                // Ensure slug is properly formatted and unique
                $validated['slug'] = Str::slug($validated['slug']);

                // Check if slug is unique
                $existingBlog = Blog::where('slug', $validated['slug'])->first();
                if ($existingBlog) {
                    $validated['slug'] = Blog::generateUniqueSlug($validated['slug']);
                }
            }

            // Handle boolean fields
            $validated['show_on_homepage'] = $request->has('show_on_homepage') ? true : false;

            // Set default author if empty
            if (empty($validated['author'])) {
                $validated['author'] = 'Sister Nourhan';
            }

            // Create blog
            Blog::create($validated);

            // Clear related cache
            Cache::forget('home_recent_blogs');
            Cache::forget('blog_recent_sidebar');

            return redirect()->route('admin.blogs.index')
                ->with('success', 'Blog created successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating blog: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'An error occurred while creating the blog. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::with('blogCategory')->findOrFail($id);
        return view('dashboard.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::active()->orderBy('name')->get();
        return view('dashboard.blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            $validated = $request->validate([
                'title' => 'required|string|max:255|unique:blogs,title,' . $id,
                'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $id . '|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                'short_description' => 'nullable|string',
                'description' => 'nullable|string',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string',
                'schema_block' => 'nullable|string',
                'canonical_url' => 'nullable|url|max:255',
                'cover_image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'author' => 'nullable|string|max:255',
                'blog_category_id' => 'nullable|exists:blog_categories,id',
                'status' => 'required|in:active,inactive',
                'show_on_homepage' => 'nullable|boolean',
                'published_at' => 'nullable|date',
                'sort_order' => 'nullable|integer|min:0',
            ]);

            // Handle cover image upload
            if ($request->hasFile('cover_image')) {
                // Delete old image if exists
                if ($blog->cover_image) {
                    Storage::disk('blogs')->delete($blog->cover_image);
                }

                $image = $request->file('cover_image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $validated['cover_image'] = $image->storeAs('', $imageName, 'blogs');
            } else {
                // Keep existing image if no new image uploaded
                $validated['cover_image'] = $blog->cover_image;
            }

            // Handle slug - let the model handle the logic
            if (!empty($validated['slug'])) {
                // Clean the slug but don't check uniqueness here - model will handle it
                $validated['slug'] = Str::slug($validated['slug']);
            } else {
                // If slug is empty, generate from title
                $validated['slug'] = Str::slug($validated['title']);
            }

            // Handle boolean fields
            $validated['show_on_homepage'] = $request->has('show_on_homepage') ? true : false;

            // Set default author if empty
            if (empty($validated['author'])) {
                $validated['author'] = 'Sister Nourhan';
            }

            // Update blog
            $blog->update($validated);

            // Clear related cache
            Cache::forget('home_recent_blogs');
            Cache::forget('blog_recent_sidebar');

            return redirect()->route('admin.blogs.index')
                ->with('success', 'Blog updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating blog: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', config('app.debug')
                    ? ('Update failed: ' . $e->getMessage())
                    : 'An error occurred while updating the blog. Please try again.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            // Delete cover image if exists
            if ($blog->cover_image) {
                Storage::disk('blogs')->delete($blog->cover_image);
            }

            $blog->delete();

            // Get query parameters from POST data, referer URL, or request query
            $queryParams = [];

            // First, check POST data (from hidden inputs in form)
            if ($request->has('page')) {
                $queryParams['page'] = $request->input('page');
            }
            if ($request->has('category')) {
                $queryParams['category'] = $request->input('category');
            }

            // If not in POST, try to get from referer URL
            if (empty($queryParams)) {
                $referer = $request->header('referer');
                if ($referer) {
                    $parsedUrl = parse_url($referer);
                    if (isset($parsedUrl['query'])) {
                        parse_str($parsedUrl['query'], $queryParams);
                    }
                }
            }

            // Fallback to request query if still empty
            if (empty($queryParams)) {
                $queryParams = $request->query();
            }

            // If we're on a page and it might be empty after deletion, go to previous page
            if (isset($queryParams['page']) && $queryParams['page'] > 1) {
                $currentPage = (int) $queryParams['page'];
                $totalAfterDelete = Blog::count();

                // If the page might be empty, go to previous page
                // Calculate items per page (15 in this case)
                $itemsPerPage = 15;
                if ($totalAfterDelete <= ($currentPage - 1) * $itemsPerPage) {
                    $queryParams['page'] = max(1, $currentPage - 1);
                }
            }

            // Clear related cache
            Cache::forget('home_recent_blogs');
            Cache::forget('blog_recent_sidebar');

            return redirect()->route('admin.blogs.index', $queryParams)
                ->with('success', 'Blog deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting blog: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'An error occurred while deleting the blog. Please try again.');
        }
    }
}
