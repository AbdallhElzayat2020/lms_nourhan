@extends('dashboard.layouts.master')

@section('title', 'View Redirect')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Redirect Details</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.redirects.edit', $redirect) }}" class="btn btn-primary btn-sm">
                    <i class="ti ti-edit me-1"></i>
                    Edit
                </a>
                <a href="{{ route('admin.redirects.index') }}" class="btn btn-label-secondary btn-sm">
                    <i class="ti ti-arrow-left me-1"></i>
                    Back to List
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Old URL</h6>
                            <div class="p-3 bg-light rounded">
                                <code class="text-primary fs-6">{{ $redirect->old_url }}</code>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">New URL</h6>
                            <div class="p-3 bg-light rounded">
                                <code class="text-success fs-6">{{ $redirect->new_url }}</code>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Redirect Type</h6>
                            <span class="badge bg-{{ $redirect->status_code == '301' ? 'warning' : 'info' }} fs-6 px-3 py-2">
                                {{ $redirect->status_code }} - {{ $redirect->status_code == '301' ? 'Permanent' : 'Temporary' }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Status</h6>
                            <span class="badge bg-{{ $redirect->status == 'active' ? 'success' : 'secondary' }} fs-6 px-3 py-2">
                                {{ ucfirst($redirect->status) }}
                            </span>
                        </div>
                    </div>

                    @if($redirect->description)
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">Description</h6>
                            <div class="p-3 bg-light rounded">
                                <p class="mb-0">{{ $redirect->description }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Created</h6>
                            <p class="mb-0">{{ $redirect->created_at->format('M d, Y H:i A') }}</p>
                            <small class="text-muted">{{ $redirect->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Last Updated</h6>
                            <p class="mb-0">{{ $redirect->updated_at->format('M d, Y H:i A') }}</p>
                            <small class="text-muted">{{ $redirect->updated_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-primary text-white mb-3">
                        <div class="card-body text-center">
                            <h2 class="text-white mb-1">{{ $redirect->hit_count }}</h2>
                            <p class="mb-0">Total Hits</p>
                        </div>
                    </div>

                    <div class="card bg-info text-white mb-3">
                        <div class="card-body text-center">
                            <h6 class="text-white mb-1">
                                @if($redirect->last_hit_at)
                                    {{ $redirect->last_hit_at->format('M d, Y') }}
                                    <br>
                                    <small>{{ $redirect->last_hit_at->format('H:i A') }}</small>
                                @else
                                    Never
                                @endif
                            </h6>
                            <p class="mb-0">Last Hit</p>
                        </div>
                    </div>

                    <div class="card border">
                        <div class="card-body">
                            <h6 class="card-title">Test Redirect</h6>
                            <p class="text-muted small mb-3">Click to test this redirect (opens in new tab)</p>
                            <a href="{{ url($redirect->old_url) }}" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                                <i class="ti ti-external-link me-1"></i>
                                Test Redirect
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<style>
    .fs-6 {
        font-size: 1rem !important;
    }

    code {
        word-break: break-all;
    }

    .card .card-body h6.text-muted {
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
@endpush
