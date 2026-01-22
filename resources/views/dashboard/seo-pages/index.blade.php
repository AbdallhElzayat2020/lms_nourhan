@extends('dashboard.layouts.master')

@section('title', 'SEO Management')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0">
                <span class="text-muted fw-light">Dashboard /</span> SEO Management
            </h4>
            <a href="{{ route('admin.seo-pages.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-2"></i>
                Add New Page
            </a>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">SEO Pages</h5>
                <span class="badge bg-label-primary">{{ $seoPages->total() }} Total</span>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Page Name</th>
                            <th>Page Title</th>
                            <th>Meta Title</th>
                            <th>Meta Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($seoPages as $index => $seoPage)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge bg-label-info">{{ $seoPage->page_name }}</span>
                                </td>
                                <td>
                                    <strong>{{ $seoPage->page_title }}</strong>
                                </td>
                                <td>
                                    @if($seoPage->meta_title)
                                        <span class="text-truncate d-inline-block" style="max-width: 200px;" title="{{ $seoPage->meta_title }}">
                                            {{ $seoPage->meta_title }}
                                        </span>
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    @if($seoPage->meta_description)
                                        <span class="text-truncate d-inline-block" style="max-width: 250px;" title="{{ $seoPage->meta_description }}">
                                            {{ $seoPage->meta_description }}
                                        </span>
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    @if($seoPage->status == 'active')
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                        <span class="badge bg-label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.seo-pages.show', $seoPage) }}"
                                           class="btn btn-sm btn-outline-info"
                                           title="View Details"
                                           data-bs-toggle="tooltip">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.seo-pages.edit', $seoPage) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Edit SEO Page"
                                           data-bs-toggle="tooltip">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.seo-pages.destroy', $seoPage) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this SEO page?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Delete SEO Page"
                                                    data-bs-toggle="tooltip">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="ti ti-seo mb-2" style="font-size: 3rem; color: #ddd;"></i>
                                        <h6 class="text-muted">No SEO pages found</h6>
                                        <p class="text-muted small mb-0">Start by adding your first SEO page configuration</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($seoPages->hasPages())
                <div class="card-footer">
                    {{ $seoPages->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

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
