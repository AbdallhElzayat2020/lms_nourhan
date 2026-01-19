@extends('dashboard.layouts.master')

@section('title', 'Teachers')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Teachers</h5>
            <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i>
                Add New Teacher
            </a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Short Description</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teachers as $teacher)
                            <tr>
                                <td>{{ $teacher->id }}</td>
                                <td>
                                    @if ($teacher->image)
                                        <img src="{{ asset('uploads/teachers/' . $teacher->image) }}"
                                            alt="{{ $teacher->name }}"
                                            style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td><strong>{{ $teacher->name }}</strong></td>
                                <td>
                                    <code>{{ $teacher->slug ?? 'N/A' }}</code>
                                </td>
                                <td>
                                    @if ($teacher->short_description)
                                        {{ \Illuminate\Support\Str::limit($teacher->short_description, 60) }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($teacher->status == 'active')
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                        <span class="badge bg-label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $teacher->sort_order }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.teachers.show', $teacher->id) }}"
                                            class="btn btn-sm btn-label-info">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
                                            class="btn btn-sm btn-label-primary">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this teacher?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-label-danger">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No teachers found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $teachers->links() }}
            </div>
        </div>
    </div>
@endsection
