@extends('dashboard.layouts.master')

@section('title', 'Event Details')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Event Details</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-primary">
                    <i class="ti ti-edit me-1"></i>
                    Edit
                </a>
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                    <i class="ti ti-arrow-left me-1"></i>
                    Back to List
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-4">
                    @if($event->image)
                        <img src="{{ asset('uploads/events/' . $event->image) }}" alt="{{ $event->name }}"
                            class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover;">
                    @else
                        <div class="alert alert-warning">No image available</div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Event Name</label>
                    <p class="form-control-plaintext fs-5">{{ $event->name }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Slug</label>
                    <p class="form-control-plaintext">{{ $event->slug }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <p class="form-control-plaintext">
                        @if($event->status == 'active')
                            <span class="badge bg-label-success">Active</span>
                        @else
                            <span class="badge bg-label-danger">Inactive</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Short Description</label>
                    <div class="card bg-label-secondary p-3">
                        <p class="mb-0">{{ $event->short_description ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Full Description</label>
                    <div class="card bg-label-secondary p-3">
                        <p class="mb-0">{!! nl2br(e($event->description ?? 'N/A')) !!}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Start Date</label>
                    <p class="form-control-plaintext">{{ $event->start_date->format('Y-m-d') }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">End Date</label>
                    <p class="form-control-plaintext">{{ $event->end_date ? $event->end_date->format('Y-m-d') : 'N/A' }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Time</label>
                    <p class="form-control-plaintext">{{ $event->time ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Location</label>
                    <p class="form-control-plaintext">{{ $event->location ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Phone</label>
                    <p class="form-control-plaintext">{{ $event->phone ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Google Maps Link</label>
                    <p class="form-control-plaintext">
                        @if($event->google_map_link)
                            <a href="{{ $event->google_map_link }}" target="_blank" class="text-primary">
                                {{ $event->google_map_link }} <i class="ti ti-external-link"></i>
                            </a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Sort Order</label>
                    <p class="form-control-plaintext">{{ $event->sort_order }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Bookings Count</label>
                    <p class="form-control-plaintext">
                        <span class="badge bg-label-info">{{ $event->bookings->count() }} Total</span>
                        <span class="badge bg-label-warning">{{ $event->pending_bookings_count }} Pending</span>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Created At</label>
                    <p class="form-control-plaintext">{{ $event->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Updated At</label>
                    <p class="form-control-plaintext">{{ $event->updated_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>

            <div class="mt-4">
                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this event?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="ti ti-trash me-1"></i>
                        Delete Event
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
