@extends('dashboard.layouts.master')

@section('title', 'Create Partner')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Create New Partner</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                           name="name" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label">Logo <span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo"
                           name="logo" accept="image/*" required>
                    <small class="text-muted">Upload partner logo (JPEG, PNG, JPG, GIF, WEBP, SVG - Max 2MB)</small>
                    @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Website Link</label>
                    <input type="url" class="form-control @error('link') is-invalid @enderror" id="link"
                           name="link" value="{{ old('link') }}" placeholder="https://example.com">
                    <small class="text-muted">Optional: Partner's website URL</small>
                    @error('link')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="form-label">Sort Order</label>
                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order"
                           name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                    <small class="text-muted">Lower numbers appear first (default: 0)</small>
                    @error('sort_order')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-1"></i>
                        Create Partner
                    </button>
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-label-secondary">
                        <i class="ti ti-x me-1"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
