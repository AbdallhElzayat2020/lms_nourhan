@extends('dashboard.layouts.master')

@section('title', 'Edit SEO Page')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard / SEO Management /</span> Edit {{ $seoPage->page_title }}
        </h4>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="ti ti-seo me-2"></i>
                    Edit SEO Page: {{ $seoPage->page_title }}
                </h5>
            </div>

            <form action="{{ route('admin.seo-pages.update', $seoPage) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">

                    <!-- Basic Information -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="page_name" class="form-label">Page Name (Identifier)</label>
                            <input type="text" id="page_name" name="page_name"
                                   class="form-control @error('page_name') is-invalid @enderror"
                                   value="{{ old('page_name', $seoPage->page_name) }}"
                                   placeholder="e.g., home, about, contact"
                                   required>
                            <div class="form-text">Unique identifier for this page (lowercase, no spaces)</div>
                            @error('page_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="page_title" class="form-label">Page Title (Display Name)</label>
                            <input type="text" id="page_title" name="page_title"
                                   class="form-control @error('page_title') is-invalid @enderror"
                                   value="{{ old('page_title', $seoPage->page_title) }}"
                                   placeholder="e.g., الصفحة الرئيسية"
                                   required>
                            <div class="form-text">Display name for admin panel</div>
                            @error('page_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- SEO Meta Tags -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="ti ti-tags me-2"></i>
                                SEO Meta Tags
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                <input type="text" id="meta_title" name="meta_title"
                                       class="form-control @error('meta_title') is-invalid @enderror"
                                       value="{{ old('meta_title', $seoPage->meta_title) }}"
                                       placeholder="SEO title for search engines"
                                       maxlength="60">
                                <div class="form-text">Recommended: 50-60 characters. <span id="meta-title-count">0</span>/60</div>
                                @error('meta_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <textarea id="meta_description" name="meta_description"
                                          class="form-control @error('meta_description') is-invalid @enderror"
                                          rows="3"
                                          placeholder="Brief description for search engines"
                                          maxlength="160">{{ old('meta_description', $seoPage->meta_description) }}</textarea>
                                <div class="form-text">Recommended: 150-160 characters. <span id="meta-desc-count">0</span>/160</div>
                                @error('meta_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                <textarea id="meta_keywords" name="meta_keywords"
                                          class="form-control @error('meta_keywords') is-invalid @enderror"
                                          rows="2"
                                          placeholder="keyword1, keyword2, keyword3">{{ old('meta_keywords', $seoPage->meta_keywords) }}</textarea>
                                <div class="form-text">Separate keywords with commas</div>
                                @error('meta_keywords')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Advanced SEO -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="ti ti-code me-2"></i>
                                Advanced SEO
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="canonical_url" class="form-label">Canonical URL</label>
                                <input type="url" id="canonical_url" name="canonical_url"
                                       class="form-control @error('canonical_url') is-invalid @enderror"
                                       value="{{ old('canonical_url', $seoPage->canonical_url) }}"
                                       placeholder="https://example.com/page">
                                <div class="form-text">Full URL for canonical link (optional)</div>
                                @error('canonical_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="schema_markup" class="form-label">Schema Markup (JSON-LD)</label>
                                <textarea id="schema_markup" name="schema_markup"
                                          class="form-control @error('schema_markup') is-invalid @enderror"
                                          rows="8"
                                          placeholder='{"@@context": "https://schema.org", "@type": "WebPage", "name": "Page Name"}'>{{ old('schema_markup', $seoPage->schema_markup) }}</textarea>
                                <div class="form-text">Valid JSON-LD structured data (optional)</div>
                                @error('schema_markup')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="active" {{ old('status', $seoPage->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $seoPage->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.seo-pages.index') }}" class="btn btn-label-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-2"></i>
                        Update SEO Page
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character counters
        const metaTitleInput = document.getElementById('meta_title');
        const metaDescInput = document.getElementById('meta_description');
        const metaTitleCount = document.getElementById('meta-title-count');
        const metaDescCount = document.getElementById('meta-desc-count');

        function updateCounter(input, counter) {
            const length = input.value.length;
            counter.textContent = length;

            // Color coding
            const maxLength = input.getAttribute('maxlength');
            const percentage = (length / maxLength) * 100;

            if (percentage > 90) {
                counter.style.color = '#dc3545'; // Red
            } else if (percentage > 75) {
                counter.style.color = '#fd7e14'; // Orange
            } else {
                counter.style.color = '#198754'; // Green
            }
        }

        metaTitleInput.addEventListener('input', () => updateCounter(metaTitleInput, metaTitleCount));
        metaDescInput.addEventListener('input', () => updateCounter(metaDescInput, metaDescCount));

        // Initial count
        updateCounter(metaTitleInput, metaTitleCount);
        updateCounter(metaDescInput, metaDescCount);

        // Page name formatting
        document.getElementById('page_name').addEventListener('input', function() {
            this.value = this.value.toLowerCase().replace(/[^a-z0-9-_]/g, '');
        });

        // Schema validation
        document.getElementById('schema_markup').addEventListener('blur', function() {
            const value = this.value.trim();
            if (value) {
                try {
                    JSON.parse(value);
                    this.classList.remove('is-invalid');
                } catch (e) {
                    this.classList.add('is-invalid');
                    // Show error message
                    let feedback = this.parentNode.querySelector('.invalid-feedback');
                    if (!feedback) {
                        feedback = document.createElement('div');
                        feedback.className = 'invalid-feedback';
                        this.parentNode.appendChild(feedback);
                    }
                    feedback.textContent = 'Invalid JSON format';
                }
            }
        });
    });
</script>
@endpush
