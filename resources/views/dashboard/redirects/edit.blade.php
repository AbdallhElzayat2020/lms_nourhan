@extends('dashboard.layouts.master')

@section('title', 'Edit Redirect')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit URL Redirect</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.redirects.update', $redirect) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="old_url" class="form-label">Old URL <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('old_url') is-invalid @enderror"
                            id="old_url" name="old_url" value="{{ old('old_url', $redirect->old_url) }}"
                            placeholder="/old-page or https://example.com/old-page" required>
                        @error('old_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">The URL that users are trying to access</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="new_url" class="form-label">New URL <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('new_url') is-invalid @enderror"
                            id="new_url" name="new_url" value="{{ old('new_url', $redirect->new_url) }}"
                            placeholder="/new-page or https://example.com/new-page" required>
                        @error('new_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">The URL where users should be redirected</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status_code" class="form-label">Redirect Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('status_code') is-invalid @enderror"
                            id="status_code" name="status_code" required>
                            <option value="">Select Redirect Type</option>
                            <option value="301" {{ old('status_code', $redirect->status_code) == '301' ? 'selected' : '' }}>
                                301 - Permanent Redirect
                            </option>
                            <option value="302" {{ old('status_code', $redirect->status_code) == '302' ? 'selected' : '' }}>
                                302 - Temporary Redirect
                            </option>
                        </select>
                        @error('status_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            <strong>301:</strong> Permanent (SEO-friendly)<br>
                            <strong>302:</strong> Temporary
                        </small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror"
                            id="status" name="status" required>
                            <option value="active" {{ old('status', $redirect->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $redirect->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Only active redirects will be processed</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                        id="description" name="description" rows="3"
                        placeholder="Optional description for this redirect...">{{ old('description', $redirect->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Optional: Add a note about why this redirect was created</small>
                </div>

                <!-- Statistics -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h4 class="text-primary mb-1">{{ $redirect->hit_count }}</h4>
                                <small class="text-muted">Total Hits</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h6 class="text-info mb-1">
                                    @if($redirect->last_hit_at)
                                        {{ $redirect->last_hit_at->format('M d, Y H:i') }}
                                    @else
                                        Never
                                    @endif
                                </h6>
                                <small class="text-muted">Last Hit</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.redirects.index') }}" class="btn btn-label-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i>
                        Update Redirect
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
