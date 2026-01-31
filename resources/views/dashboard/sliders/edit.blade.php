@extends('dashboard.layouts.master')

@section('title', 'Edit Slider')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Slider</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sliders.update', $slider->id) }}{{ request()->query() ? '?' . http_build_query(request()->query()) : '' }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                            value="{{ old('title', $slider->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" rows="4">{{ old('description', $slider->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slider Main Text -->
                <div class="mb-3">
                    <label for="text_line_1" class="form-label">Main Text</label>
                    <input type="text" class="form-control @error('text_line_1') is-invalid @enderror"
                        id="text_line_1" name="text_line_1" value="{{ old('text_line_1', $slider->text_line_1) }}"
                        placeholder="Where Knowledge Meets Innovation and Dreams Become Reality.">
                    @error('text_line_1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Main animated text for the slider</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Image</label>
                        @if($slider->image)
                            <div class="mb-2">
                                <img src="{{ asset('uploads/sliders/' . $slider->image) }}" alt="{{ $slider->title }}"
                                    style="width: 200px; height: 120px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                            </div>
                        @endif
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                            accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Leave empty to keep current image. Accepted formats: JPEG, PNG, JPG, GIF,
                            WEBP. Max size: 5MB</small>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
                            required>
                            <option value="active" {{ old('status', $slider->status) == 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="inactive" {{ old('status', $slider->status) == 'inactive' ? 'selected' : '' }}>
                                Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order"
                            name="sort_order" value="{{ old('sort_order', $slider->sort_order) }}" min="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="button_text" class="form-label">Button 1 Text</label>
                        <input type="text" class="form-control @error('button_text') is-invalid @enderror" id="button_text"
                            name="button_text" value="{{ old('button_text', $slider->button_text) }}"
                            placeholder="Explore">
                        @error('button_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Text for the first button</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="link" class="form-label">Button 1 Link</label>
                        <input type="url" class="form-control @error('link') is-invalid @enderror" id="link" name="link"
                            value="{{ old('link', $slider->link) }}" placeholder="https://example.com">
                        @error('link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">URL for the first button</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="button_text_2" class="form-label">Button 2 Text</label>
                        <input type="text" class="form-control @error('button_text_2') is-invalid @enderror" id="button_text_2"
                            name="button_text_2" value="{{ old('button_text_2', $slider->button_text_2) }}"
                            placeholder="Our Courses">
                        @error('button_text_2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Text for the second button</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="link_2" class="form-label">Button 2 Link</label>
                        <input type="url" class="form-control @error('link_2') is-invalid @enderror" id="link_2" name="link_2"
                            value="{{ old('link_2', $slider->link_2) }}" placeholder="https://example.com/courses">
                        @error('link_2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">URL for the second button</small>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.sliders.index', request()->query()) }}" class="btn btn-label-secondary">
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
