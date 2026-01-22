@extends('dashboard.layouts.master')

@section('title', 'Blogs')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Blogs</h5>
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i>
                Add New Blog
            </a>
        </div>
        <div class="card-body">
            <!-- Filter Section -->
            <div class="mb-4">
                <form method="GET" action="{{ route('admin.blogs.index') }}" class="d-flex gap-2 align-items-end">
                    <div class="flex-grow-1">
                        <label for="category" class="form-label">Filter by Category</label>
                        <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if(request('category'))
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-label-secondary">
                            <i class="ti ti-x me-1"></i>
                            Clear Filter
                        </a>
                    @endif
                </form>
            </div>

            @if($selectedCategory)
                <div class="alert alert-info alert-dismissible" role="alert">
                    <i class="ti ti-info-circle me-1"></i>
                    Showing blogs for category: <strong>{{ $selectedCategory->name }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Published At</th>
                            <th>Status</th>
                            <th>Homepage</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $index => $blog)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($blog->cover_image)
                                        <img src="{{ asset('uploads/blogs/' . $blog->cover_image) }}" alt="{{ $blog->title }}"
                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($blog->title, 50) }}</td>
                                <td>
                                    @if($blog->blogCategory)
                                        <span class="badge bg-label-info">{{ $blog->blogCategory->name }}</span>
                                    @else
                                        <span class="text-muted">No Category</span>
                                    @endif
                                </td>
                                <td>{{ $blog->author ?? 'N/A' }}</td>
                                <td>
                                    @if($blog->published_at)
                                        {{ \Carbon\Carbon::parse($blog->published_at)->setTimezone('Africa/Cairo')->format('Y-m-d h:i A') }}
                                    @else
                                        <span class="text-muted">Not Published</span>
                                    @endif
                                </td>
                                <td>
                                    @if($blog->status == 'active')
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                        <span class="badge bg-label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($blog->show_on_homepage)
                                        <span class="badge bg-label-primary">Yes</span>
                                    @else
                                        <span class="badge bg-label-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.blogs.show', $blog->id) }}" class="btn btn-sm btn-label-info">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                            class="btn btn-sm btn-label-primary">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                            @csrf
                                            @method('DELETE')
                                            @if(request('page'))
                                                <input type="hidden" name="page" value="{{ request('page') }}">
                                            @endif
                                            @if(request('category'))
                                                <input type="hidden" name="category" value="{{ request('category') }}">
                                            @endif
                                            <button type="submit" class="btn btn-sm btn-label-danger">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No blogs found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
@endsection
