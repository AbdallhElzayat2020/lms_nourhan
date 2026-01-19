@extends('dashboard.layouts.master')

@section('title', 'Edit About Section')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit About Section</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.about-sections.update', $aboutSection->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="subtitle" class="form-label">Subtitle</label>
                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle"
                           name="subtitle" value="{{ old('subtitle', $aboutSection->subtitle) }}"
                           placeholder="e.g. About Our Platform">
                    @error('subtitle')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                           name="title" value="{{ old('title', $aboutSection->title) }}" required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                              name="description" rows="5">{{ old('description', $aboutSection->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="button_text" class="form-label">Button Text</label>
                        <input type="text" class="form-control @error('button_text') is-invalid @enderror" id="button_text"
                               name="button_text" value="{{ old('button_text', $aboutSection->button_text) }}"
                               placeholder="e.g. Browse All Courses">
                        @error('button_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="button_link" class="form-label">Button Link</label>
                        <input type="text" class="form-control @error('button_link') is-invalid @enderror" id="button_link"
                               name="button_link" value="{{ old('button_link', $aboutSection->button_link) }}"
                               placeholder="e.g. /courses or https://example.com">
                        @error('button_link')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="video_url" class="form-label">Video URL (YouTube Embed)</label>
                    <input type="text" class="form-control @error('video_url') is-invalid @enderror" id="video_url"
                           name="video_url" value="{{ old('video_url', $aboutSection->video_url) }}"
                           placeholder="e.g. https://www.youtube.com/embed/qjxDcU4m2FQ?si=9JC0uy-hV0SeDxQR">
                    <small class="text-muted">Use YouTube embed URL format: https://www.youtube.com/embed/VIDEO_ID</small>
                    @error('video_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="active" {{ old('status', $aboutSection->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $aboutSection->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.about-sections.index') }}" class="btn btn-label-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
