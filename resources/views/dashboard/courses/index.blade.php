@extends('dashboard.layouts.master')

@section('title', 'Courses')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Courses</h5>
            <a href="{{ route('admin.courses.create') }}{{ request()->query() ? '?' . http_build_query(request()->query()) : '' }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i>
                Add New Course
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
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
                            <th>Banner</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Type</th>
                            <th>Lessons</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $index => $course)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($course->banner_image)
                                        <img src="{{ asset('uploads/courses/' . $course->banner_image) }}" alt="{{ $course->title }}"
                                            style="width: 100px; height: 60px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td><strong>{{ $course->title }}</strong></td>
                                <td>
                                    @if($course->category)
                                        <span class="badge bg-label-info">{{ $course->category->name }}</span>
                                    @else
                                        <span class="text-muted">No Category</span>
                                    @endif
                                </td>
                                <td>
                                    @if($course->course_type == 'private')
                                        <span class="badge bg-label-warning">Private</span>
                                    @elseif($course->course_type == 'live')
                                        <span class="badge bg-label-primary">Live</span>
                                    @else
                                        <span class="badge bg-label-success">Both</span>
                                    @endif
                                </td>
                                <td>{{ $course->lessons_count }}</td>
                                <td>{{ $course->duration_hours }}h</td>
                                <td>
                                    @if($course->status == 'active')
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                        <span class="badge bg-label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.courses.show', $course->id) }}{{ request()->query() ? '?' . http_build_query(request()->query()) : '' }}"
                                            class="btn btn-sm btn-label-info">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.courses.edit', $course->id) }}{{ request()->query() ? '?' . http_build_query(request()->query()) : '' }}"
                                            class="btn btn-sm btn-label-primary">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this course?');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="index_query" value="{{ http_build_query(request()->query()) }}">
                                            <button type="submit" class="btn btn-sm btn-label-danger">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No courses found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
@endsection
