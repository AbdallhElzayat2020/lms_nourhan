@extends('dashboard.layouts.master')

@section('title', 'URL Redirects')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">URL Redirects Management</h5>
            <a href="{{ route('admin.redirects.create') }}{{ request()->query() ? '?' . http_build_query(request()->query()) : '' }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i>
                Add New Redirect
            </a>
        </div>
        <div class="card-body">
            @if($redirects->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Old URL</th>
                                <th>New URL</th>
                                <th>Status Code</th>
                                <th>Status</th>
                                <th>Hits</th>
                                <th>Last Hit</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($redirects as $redirect)
                                <tr>
                                    <td>
                                        <code class="text-primary">{{ $redirect->old_url }}</code>
                                    </td>
                                    <td>
                                        <code class="text-success">{{ $redirect->new_url }}</code>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $redirect->status_code == '301' ? 'warning' : 'info' }}">
                                            {{ $redirect->status_code }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $redirect->status == 'active' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($redirect->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">{{ $redirect->hit_count }}</span>
                                    </td>
                                    <td>
                                        @if($redirect->last_hit_at)
                                            <small class="text-muted">{{ $redirect->last_hit_at->diffForHumans() }}</small>
                                        @else
                                            <small class="text-muted">Never</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.redirects.show', $redirect) }}{{ request()->query() ? '?' . http_build_query(request()->query()) : '' }}"
                                               class="btn btn-sm btn-outline-info"
                                               title="View Details"
                                               data-bs-toggle="tooltip">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.redirects.edit', $redirect) }}{{ request()->query() ? '?' . http_build_query(request()->query()) : '' }}"
                                               class="btn btn-sm btn-outline-primary"
                                               title="Edit Redirect"
                                               data-bs-toggle="tooltip">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.redirects.destroy', $redirect) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this redirect?')" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="index_query" value="{{ http_build_query(request()->query()) }}">
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Delete Redirect"
                                                        data-bs-toggle="tooltip">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $redirects->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="ti ti-link-off display-1 text-muted mb-3"></i>
                    <h5 class="text-muted">No redirects found</h5>
                    <p class="text-muted">Create your first redirect to manage URL redirections.</p>
                    <a href="{{ route('admin.redirects.create') }}{{ request()->query() ? '?' . http_build_query(request()->query()) : '' }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i>
                        Add First Redirect
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('css')
<style>
    .table code {
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
    }

    .badge {
        font-size: 0.75rem;
    }

    /* Button group styling */
    .btn-group .btn {
        border-radius: 0;
        margin-right: -1px;
    }

    .btn-group .btn:first-child {
        border-top-left-radius: 0.375rem;
        border-bottom-left-radius: 0.375rem;
    }

    .btn-group .btn:last-child {
        border-top-right-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
        margin-right: 0;
    }

    .btn-group .btn i {
        font-size: 0.875rem;
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
