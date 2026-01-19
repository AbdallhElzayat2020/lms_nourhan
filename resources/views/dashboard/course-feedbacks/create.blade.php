@extends('dashboard.layouts.master')

@section('title', 'Create Course Feedback')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Create New Course Feedback</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.course-feedbacks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                            value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                            accept="image/*" required>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF, WEBP. Max size: 5MB</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="video_url" class="form-label">Video URL</label>
                        <input type="url" class="form-control @error('video_url') is-invalid @enderror" id="video_url" name="video_url"
                            value="{{ old('video_url') }}" placeholder="https://youtu.be/...">
                        @error('video_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">YouTube or Vimeo video URL (optional)</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Brief description about the feedback</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order"
                            name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Lower numbers appear first</small>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('admin.course-feedbacks.index') }}" class="btn btn-label-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
