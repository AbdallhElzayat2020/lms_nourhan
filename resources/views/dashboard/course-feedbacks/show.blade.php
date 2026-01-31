@extends('dashboard.layouts.master')

@section('title', 'Course Feedback Details')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Course Feedback Details</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.course-feedbacks.edit', $courseFeedback->id) }}" class="btn btn-primary">
                    <i class="ti ti-edit me-1"></i>
                    Edit
                </a>
                <a href="{{ route('admin.course-feedbacks.index', request()->query()) }}" class="btn btn-secondary">
                    <i class="ti ti-arrow-left me-1"></i>
                    Back to List
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-4">
                    @if($courseFeedback->image)
                        <img src="{{ asset('uploads/course-feedbacks/' . $courseFeedback->image) }}" alt="{{ $courseFeedback->title }}"
                            class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover;">
                    @else
                        <div class="alert alert-warning">No image available</div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Title</label>
                    <p class="form-control-plaintext fs-5">{{ $courseFeedback->title }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <p class="form-control-plaintext">
                        @if($courseFeedback->status == 'active')
                            <span class="badge bg-label-success">Active</span>
                        @else
                            <span class="badge bg-label-danger">Inactive</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Sort Order</label>
                    <p class="form-control-plaintext">{{ $courseFeedback->sort_order }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <div class="card bg-label-secondary p-3">
                        <p class="mb-0">{{ $courseFeedback->description ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Video URL</label>
                    <p class="form-control-plaintext">
                        @if($courseFeedback->video_url)
                            <a href="{{ $courseFeedback->video_url }}" target="_blank" class="text-primary">
                                {{ $courseFeedback->video_url }} <i class="ti ti-external-link"></i>
                            </a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Created At</label>
                    <p class="form-control-plaintext">{{ $courseFeedback->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Updated At</label>
                    <p class="form-control-plaintext">{{ $courseFeedback->updated_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>

            <div class="mt-4">
                <form action="{{ route('admin.course-feedbacks.destroy', $courseFeedback->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="ti ti-trash me-1"></i>
                        Delete Feedback
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
