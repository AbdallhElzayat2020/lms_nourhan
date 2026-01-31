@extends('dashboard.layouts.master')

@section('title', 'Blog Category Details')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Blog Category Details</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.blog-categories.edit', $category->id) }}" class="btn btn-label-primary">
                    <i class="ti ti-edit me-1"></i>
                    Edit
                </a>
                <a href="{{ route('admin.blog-categories.index', request()->query()) }}" class="btn btn-label-secondary">
                    <i class="ti ti-arrow-left me-1"></i>
                    Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">ID</th>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><strong>{{ $category->name }}</strong></td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td><code>{{ $category->slug }}</code></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{!! $category->description ?? 'N/A' !!}</td>
                        </tr>
                        <tr>
                            <th>Image Alt Text</th>
                            <td>{{ $category->image_alt ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Meta Title</th>
                            <td>{{ $category->meta_title ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Meta Description</th>
                            <td>{{ $category->meta_description ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Meta Keywords</th>
                            <td>{{ $category->meta_keywords ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Schema Block</th>
                            <td>
                                @if($category->schema_block)
                                    <pre class="bg-light p-2 rounded" style="max-height: 200px; overflow-y: auto;"><code>{{ $category->schema_block }}</code></pre>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($category->status == 'active')
                                    <span class="badge bg-label-success">Active</span>
                                @else
                                    <span class="badge bg-label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Sort Order</th>
                            <td>{{ $category->sort_order }}</td>
                        </tr>
                        <tr>
                            <th>Blogs Count</th>
                            <td>
                                <span class="badge bg-label-info">{{ $category->blogs()->count() }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $category->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $category->updated_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    @if($category->image)
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ asset('uploads/blog-categories/' . $category->image) }}" alt="{{ $category->image_alt ?? $category->name }}"
                                    class="img-fluid" style="max-height: 300px; border-radius: 4px;">
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-body text-center">
                                <span class="text-muted">No Image</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
