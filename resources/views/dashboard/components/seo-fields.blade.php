{{-- SEO Fields Component --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="ti ti-seo me-2"></i>
            SEO Settings
        </h5>
        <p class="text-muted small mb-0">Configure SEO meta tags and schema markup for {{ $itemType ?? 'this item' }}</p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                       id="meta_title" name="meta_title" value="{{ old('meta_title', $item->meta_title ?? '') }}"
                       maxlength="255" placeholder="SEO title for {{ $itemType ?? 'this item' }}">
                <small class="text-muted">Recommended: 50-60 characters. Leave empty to use {{ $fallbackField ?? 'name' }}.</small>
                @error('meta_title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="meta_keywords" class="form-label">Meta Keywords</label>
                <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror"
                       id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $item->meta_keywords ?? '') }}"
                       placeholder="keyword1, keyword2, keyword3">
                <small class="text-muted">Separate keywords with commas</small>
                @error('meta_keywords')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Description</label>
            <textarea class="form-control @error('meta_description') is-invalid @enderror"
                      id="meta_description" name="meta_description" rows="3"
                      maxlength="500" placeholder="Brief description for search engines">{{ old('meta_description', $item->meta_description ?? '') }}</textarea>
            <small class="text-muted">Recommended: 150-160 characters. Leave empty to use short description.</small>
            @error('meta_description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="canonical_url" class="form-label">Canonical URL</label>
            <input type="url" class="form-control @error('canonical_url') is-invalid @enderror"
                   id="canonical_url" name="canonical_url" value="{{ old('canonical_url', $item->canonical_url ?? '') }}"
                   placeholder="https://example.com/page-url">
            <small class="text-muted">Leave empty to auto-generate from page URL. Use for duplicate content prevention.</small>
            @error('canonical_url')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="schema_block" class="form-label">Schema Markup (JSON-LD)</label>
            <textarea class="form-control @error('schema_block') is-invalid @enderror"
                      id="schema_block" name="schema_block" rows="8"
                      placeholder="{{ $schemaPlaceholder ?? '{&quot;@@context&quot;: &quot;https://schema.org&quot;, &quot;@type&quot;: &quot;Thing&quot;, &quot;name&quot;: &quot;Item Name&quot;}' }}">{{ old('schema_block', $item->schema_block ?? '') }}</textarea>
            <small class="text-muted">Optional: Add structured data markup for better SEO. Must be valid JSON-LD format.</small>
            @error('schema_block')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
