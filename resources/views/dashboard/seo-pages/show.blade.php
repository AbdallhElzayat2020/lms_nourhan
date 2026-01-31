@extends('dashboard.layouts.master')

@section('title', 'SEO Page Details')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0">
                <span class="text-muted fw-light">Dashboard / SEO Management /</span> {{ $seoPage->page_title }}
            </h4>
            <div class="btn-group">
                <a href="{{ route('admin.seo-pages.edit', $seoPage) }}" class="btn btn-primary">
                    <i class="ti ti-edit me-2"></i>
                    Edit
                </a>
                <a href="{{ route('admin.seo-pages.index', request()->query()) }}" class="btn btn-label-secondary">
                    <i class="ti ti-arrow-left me-2"></i>
                    Back to List
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Basic Information -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="ti ti-info-circle me-2"></i>
                            Basic Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Page Name (Identifier)</label>
                                <div class="fw-medium">
                                    <span class="badge bg-label-info fs-6">{{ $seoPage->page_name }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Page Title</label>
                                <div class="fw-medium">{{ $seoPage->page_title }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Meta Tags -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="ti ti-tags me-2"></i>
                            SEO Meta Tags
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label text-muted">Meta Title</label>
                            <div class="fw-medium">
                                @if($seoPage->meta_title)
                                    {{ $seoPage->meta_title }}
                                    <small class="text-muted">({{ strlen($seoPage->meta_title) }} characters)</small>
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Meta Description</label>
                            <div class="fw-medium">
                                @if($seoPage->meta_description)
                                    {{ $seoPage->meta_description }}
                                    <small class="text-muted">({{ strlen($seoPage->meta_description) }} characters)</small>
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Meta Keywords</label>
                            <div class="fw-medium">
                                @if($seoPage->meta_keywords)
                                    @foreach($seoPage->keywords_array as $keyword)
                                        <span class="badge bg-label-secondary me-1">{{ $keyword }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Advanced SEO -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="ti ti-code me-2"></i>
                            Advanced SEO
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label text-muted">Canonical URL</label>
                            <div class="fw-medium">
                                @if($seoPage->canonical_url)
                                    <a href="{{ $seoPage->canonical_url }}" target="_blank" class="text-decoration-none">
                                        {{ $seoPage->canonical_url }}
                                        <i class="ti ti-external-link ms-1"></i>
                                    </a>
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Schema Markup (JSON-LD)</label>
                            @if($seoPage->schema_markup)
                                <div class="position-relative">
                                    <pre class="bg-light p-3 rounded border" style="max-height: 300px; overflow-y: auto;"><code>{{ $seoPage->schema_markup }}</code></pre>
                                    <button class="btn btn-sm btn-outline-secondary position-absolute top-0 end-0 m-2" onclick="copyToClipboard('schema-markup')">
                                        <i class="ti ti-copy"></i>
                                    </button>
                                </div>
                                <div class="mt-2">
                                    @if($seoPage->hasValidSchema())
                                        <span class="badge bg-label-success">
                                            <i class="ti ti-check me-1"></i>
                                            Valid JSON
                                        </span>
                                    @else
                                        <span class="badge bg-label-danger">
                                            <i class="ti ti-x me-1"></i>
                                            Invalid JSON
                                        </span>
                                    @endif
                                </div>
                            @else
                                <div class="text-muted">Not set</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Status & Actions -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Status & Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label text-muted">Status</label>
                            <div>
                                @if($seoPage->status == 'active')
                                    <span class="badge bg-label-success fs-6">
                                        <i class="ti ti-check me-1"></i>
                                        Active
                                    </span>
                                @else
                                    <span class="badge bg-label-danger fs-6">
                                        <i class="ti ti-x me-1"></i>
                                        Inactive
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Created</label>
                            <div class="fw-medium">{{ $seoPage->created_at->format('M d, Y') }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Last Updated</label>
                            <div class="fw-medium">{{ $seoPage->updated_at->format('M d, Y') }}</div>
                        </div>

                        <hr>

                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.seo-pages.edit', $seoPage) }}" class="btn btn-primary">
                                <i class="ti ti-edit me-2"></i>
                                Edit SEO Page
                            </a>

                            <form action="{{ route('admin.seo-pages.destroy', $seoPage) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this SEO page?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    <i class="ti ti-trash me-2"></i>
                                    Delete SEO Page
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- SEO Preview -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="ti ti-search me-2"></i>
                            Search Engine Preview
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="seo-preview">
                            <div class="seo-title text-primary text-decoration-none fw-medium" style="font-size: 18px;">
                                {{ $seoPage->final_meta_title }}
                            </div>
                            <div class="seo-url text-success small mt-1">
                                {{ $seoPage->canonical_url ?: 'https://yoursite.com/' . $seoPage->page_name }}
                            </div>
                            <div class="seo-description text-muted mt-1" style="font-size: 14px;">
                                {{ $seoPage->meta_description ?: 'No meta description available for this page.' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden textarea for copying -->
    <textarea id="schema-markup" style="position: absolute; left: -9999px;">{{ $seoPage->schema_markup }}</textarea>
@endsection

@push('js')
<script>
    function copyToClipboard(elementId) {
        const textarea = document.getElementById(elementId);
        textarea.select();
        document.execCommand('copy');

        // Show success message
        const button = event.target.closest('button');
        const originalHtml = button.innerHTML;
        button.innerHTML = '<i class="ti ti-check"></i>';
        button.classList.add('btn-success');

        setTimeout(() => {
            button.innerHTML = originalHtml;
            button.classList.remove('btn-success');
        }, 2000);
    }
</script>
@endpush
