@extends('dashboard.layouts.master')

@section('title', 'Edit Why Choose Item')

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Why Choose Item</h5>
            <a href="{{ route('admin.why-choose-items.index') }}" class="btn btn-secondary">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.why-choose-items.update', $item) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $item->title) }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror"
                           value="{{ old('subtitle', $item->subtitle) }}">
                    @error('subtitle') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $item->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Video URL (YouTube)</label>
                    <input type="text" name="video_url" class="form-control @error('video_url') is-invalid @enderror"
                           value="{{ old('video_url', $item->video_url) }}"
                           placeholder="e.g. https://youtu.be/-EElWLA7BQ4 or https://www.youtube.com/watch?v=VIDEO_ID">
                    <small class="text-muted">يمكنك وضع أي رابط يوتيوب (watch, youtu.be, shorts) وسيتم تحويله تلقائياً</small>
                    @error('video_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Icon Class</label>
                    <input type="text" name="icon_class" class="form-control @error('icon_class') is-invalid @enderror"
                           value="{{ old('icon_class', $item->icon_class) }}" placeholder="e.g. fa-solid fa-star">
                    @error('icon_class') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="active" {{ old('status', $item->status) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $item->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror"
                               value="{{ old('sort_order', $item->sort_order) }}" min="0">
                        @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">
                        <i class="ti ti-device-floppy me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

