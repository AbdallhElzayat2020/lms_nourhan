@extends('dashboard.layouts.master')

@section('title', 'Settings')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Website Settings</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Author Information Section -->
                <div class="section-card mb-4">
                    <div class="section-header">
                        <h6 class="section-title">Sister Nourhan Profile</h6>
                        <p class="section-description">Sister Nourhan information displayed on blog pages</p>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="author_name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('author_name') is-invalid @enderror"
                                    id="author_name" name="author_name"
                                    value="{{ old('author_name', \App\Models\Setting::get('author_name', 'Sister Nourhan')) }}">
                                @error('author_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="author_title" class="form-label">Professional Title</label>
                                <input type="text" class="form-control @error('author_title') is-invalid @enderror"
                                    id="author_title" name="author_title"
                                    value="{{ old('author_title', \App\Models\Setting::get('author_title', 'EDUCATION EXPERT & CONTENT CREATOR')) }}">
                                @error('author_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="author_bio" class="form-label">Biography</label>
                            <textarea class="form-control @error('author_bio') is-invalid @enderror"
                                id="author_bio" name="author_bio" rows="4"
                                placeholder="Write a biography about Sister Nourhan...">{{ old('author_bio', \App\Models\Setting::get('author_bio', 'Passionate educator with years of experience in teaching and content creation. Dedicated to providing quality education and inspiring students to achieve their goals.')) }}</textarea>
                            @error('author_bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="author_image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control @error('author_image') is-invalid @enderror"
                                id="author_image" name="author_image" accept="image/*">
                            @error('author_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @php
                                $currentImage = \App\Models\Setting::get('author_image');
                            @endphp

                            @if($currentImage)
                                <div class="current-image mt-2">
                                    <p class="small text-muted mb-1">Current Image:</p>
                                    <img src="{{ asset('uploads/settings/' . $currentImage) }}"
                                        alt="Author Image" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i>
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
<style>
    .section-card {
        background: #3d3d3d;
        border: 1px solid #e3e6f0;
        border-radius: 0.5rem;
        padding: 1.5rem;
    }

    .section-header {
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e3e6f0;
    }

    .section-title {
        color: #e4e6eb;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .section-description {
        color: #e4e6eb;
        font-size: 0.875rem;
        margin-bottom: 0;
    }

    .current-image img {
        border: 2px solid #e3e6f0;
        border-radius: 8px;
    }
</style>
@endpush

@push('js')
<script>
    $(document).ready(function() {
        // Image preview
        $('#author_image').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Remove existing preview
                    $('.image-preview').remove();

                      // Add new preview
                      const preview = $('<div class="image-preview mt-2"><p class="small text-muted mb-1">New Image Preview:</p><img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 150px; max-height: 150px; border: 2px solid #e3e6f0; border-radius: 8px;"></div>');
                    $('#author_image').parent().append(preview);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush
