@extends('dashboard.layouts.master')

@section('title', 'Edit Course')

@php
    use Illuminate\Support\Str;
@endphp

@push('css')
<style>
    body {
        background: #1a1d29;
    }
    .main-card {
        background: #1e2130;
        border: 1px solid #2a2d3a;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        overflow: hidden;
    }
    .main-card-header {
        background: linear-gradient(135deg, #1e2130 0%, #252836 100%);
        border-bottom: 1px solid #2a2d3a;
        padding: 1.5rem 2rem;
    }
    .main-card-header h5 {
        color: #e4e6eb;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .main-card-header i {
        color: #667eea;
        font-size: 1.75rem;
    }
    .main-card-body {
        background: #1a1d29;
        padding: 2rem;
    }
    .section-card {
        background: #1e2130;
        border: 1px solid #2a2d3a;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(0,0,0,0.2);
    }
    .section-header {
        background: linear-gradient(135deg, #252836 0%, #2a2d3a 100%);
        border-bottom: 1px solid #3a3d4a;
        padding: 1.25rem 1.75rem;
        position: relative;
        overflow: hidden;
    }
    .section-header::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
    }
    .section-header.info::before { background: linear-gradient(180deg, #667eea 0%, #764ba2 100%); }
    .section-header.images::before { background: linear-gradient(180deg, #f093fb 0%, #f5576c 100%); }
    .section-header.details::before { background: linear-gradient(180deg, #4facfe 0%, #00f2fe 100%); }
    .section-header.sections::before { background: linear-gradient(180deg, #30cfd0 0%, #330867 100%); }
    .section-header.settings::before { background: linear-gradient(180deg, #fa709a 0%, #fee140 100%); }
    .section-header h6 {
        margin: 0;
        font-weight: 600;
        font-size: 1.1rem;
        color: #e4e6eb;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .section-header i {
        font-size: 1.5rem;
        color: #667eea;
    }
    .section-body {
        padding: 1.75rem;
        background: #1e2130;
    }
    .form-label {
        color: #b0b3b8;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .form-control, .form-select {
        background: #252836;
        border: 1px solid #3a3d4a;
        color: #e4e6eb;
        padding: 0.75rem;
    }
    .form-control:focus, .form-select:focus {
        background: #252836;
        border-color: #667eea;
        color: #e4e6eb;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .form-control::placeholder {
        color: #6c757d;
    }
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }
    .text-muted {
        color: #8a8d94 !important;
    }
    .text-danger {
        color: #ff6b6b !important;
    }
    .invalid-feedback {
        color: #ff6b6b;
        font-size: 0.85rem;
    }
    .form-check-input {
        background-color: #252836;
        border: 1px solid #3a3d4a;
    }
    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }
    .form-check-label {
        color: #b0b3b8;
    }
    .note-editor {
        background: #252836 !important;
        border: 1px solid #3a3d4a !important;
    }
    .note-editor .note-editing-area {
        background: #252836 !important;
        color: #e4e6eb !important;
    }
    .note-toolbar {
        background: #2a2d3a !important;
        border-bottom: 1px solid #3a3d4a !important;
    }
    .note-btn-group .note-btn {
        background: transparent !important;
        border-color: #3a3d4a !important;
        color: #b0b3b8 !important;
    }
    .note-btn-group .note-btn:hover {
        background: #3a3d4a !important;
        color: #e4e6eb !important;
    }
    .faq-list {
        max-height: 300px;
        overflow-y: auto;
        border: 1px solid #3a3d4a;
        border-radius: 8px;
        padding: 1rem;
        background: #252836;
    }
    .faq-item {
        padding: 0.75rem;
        margin-bottom: 0.5rem;
        background: #1e2130;
        border-radius: 6px;
        border: 1px solid #3a3d4a;
    }
</style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card main-card">
                    <div class="card-header main-card-header">
                        <h5>
                            <i class="ti ti-edit"></i>
                            Edit Course
                        </h5>
                    </div>
                    <div class="card-body main-card-body">
                        <form action="{{ route('admin.courses.update', $course->id) }}{{ request()->query() ? '?' . http_build_query(request()->query()) : '' }}" method="POST" enctype="multipart/form-data" id="courseForm">
                            @csrf
                            @method('PUT')

                            <!-- Basic Information Section -->
                            <div class="section-card mt-3">
                                <div class="section-header info">
                                    <h6>
                                        <i class="ti ti-info-circle"></i>
                                        Basic Information
                                    </h6>
                                </div>
                                <div class="section-body">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                                            value="{{ old('title', $course->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="subtitle" class="form-label">Subtitle</label>
                                        <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle"
                                            value="{{ old('subtitle', $course->subtitle) }}">
                                        @error('subtitle')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                                            value="{{ old('slug', $course->slug) }}" placeholder="Auto-generated from title if left empty">
                                        <small class="text-muted">Leave empty to auto-generate from title</small>
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="category_id" class="form-label">Category</label>
                                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="short_description" class="form-label">Short Description</label>
                                        <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                                            name="short_description" rows="3">{{ old('short_description', $course->short_description) }}</textarea>
                                        @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Full Description</label>
                                        <textarea class="form-control summernote @error('description') is-invalid @enderror" id="description"
                                            name="description">{{ old('description', $course->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Banner Image Section -->
                            <div class="section-card">
                                <div class="section-header images">
                                    <h6>
                                        <i class="ti ti-photo"></i>
                                        Banner Image
                                    </h6>
                                </div>
                                <div class="section-body">
                                    <div class="mb-4">
                                        <label for="banner_image" class="form-label">Banner Image</label>
                                        @if($course->banner_image)
                                            <div class="mb-2">
                                                <img src="{{ asset('uploads/courses/' . $course->banner_image) }}" alt="{{ $course->title }}"
                                                    style="width: 200px; height: 120px; object-fit: cover; border-radius: 4px; border: 1px solid #3a3d4a;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('banner_image') is-invalid @enderror" id="banner_image" name="banner_image"
                                            accept="image/*">
                                        <small class="text-muted">Leave empty to keep current image. Recommended size: 1200x600px. Max size: 5MB</small>
                                        @error('banner_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="bannerImagePreview" class="mt-3"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Details Section -->
                            <div class="section-card">
                                <div class="section-header details">
                                    <h6>
                                        <i class="ti ti-school"></i>
                                        Course Details
                                    </h6>
                                </div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="lessons_count" class="form-label">Lessons Count</label>
                                            <input type="text" class="form-control @error('lessons_count') is-invalid @enderror" id="lessons_count" name="lessons_count"
                                                value="{{ old('lessons_count', $course->lessons_count) }}">
                                            @error('lessons_count')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="course_type" class="form-label">Course Type <span class="text-danger">*</span></label>
                                            <select class="form-select @error('course_type') is-invalid @enderror" id="course_type" name="course_type" required>
                                                <option value="both" {{ old('course_type', $course->course_type) == 'both' ? 'selected' : '' }}>Both (Private & Live)</option>
                                                <option value="private" {{ old('course_type', $course->course_type) == 'private' ? 'selected' : '' }}>Private</option>
                                                <option value="live" {{ old('course_type', $course->course_type) == 'live' ? 'selected' : '' }}>Live</option>
                                            </select>
                                            @error('course_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="duration_hours" class="form-label">Duration (Hours)</label>
                                            <input type="number" class="form-control @error('duration_hours') is-invalid @enderror" id="duration_hours" name="duration_hours"
                                                value="{{ old('duration_hours', $course->duration_hours) }}" min="0">
                                            @error('duration_hours')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="language" class="form-label">Language</label>
                                            <input type="text" class="form-control @error('language') is-invalid @enderror" id="language" name="language"
                                                value="{{ old('language', $course->language) }}" placeholder="e.g. English, Arabic">
                                            @error('language')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- About the Program Section -->
                            <div class="section-card">
                                <div class="section-header sections">
                                    <h6>
                                        <i class="ti ti-file-text"></i>
                                        About the Program
                                    </h6>
                                </div>
                                <div class="section-body">
                                    <div class="mb-3">
                                        <label for="about_program_text" class="form-label">Text</label>
                                        <textarea class="form-control summernote @error('about_program_text') is-invalid @enderror" id="about_program_text"
                                            name="about_program_text">{{ old('about_program_text', $course->about_program_text) }}</textarea>
                                        @error('about_program_text')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="about_program_image" class="form-label">Image</label>
                                        @if($course->about_program_image)
                                            <div class="mb-2">
                                                <img src="{{ asset('uploads/courses/' . $course->about_program_image) }}" alt="About Program"
                                                    style="width: 200px; height: 120px; object-fit: cover; border-radius: 4px; border: 1px solid #3a3d4a;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('about_program_image') is-invalid @enderror" id="about_program_image" name="about_program_image"
                                            accept="image/*">
                                        <small class="text-muted">Leave empty to keep current image. Max size: 5MB</small>
                                        @error('about_program_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="aboutProgramImagePreview" class="mt-3"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- How Course Works Section -->
                            <div class="section-card">
                                <div class="section-header sections">
                                    <h6>
                                        <i class="ti ti-settings"></i>
                                        How Course Works
                                    </h6>
                                </div>
                                <div class="section-body">
                                    <div class="mb-3">
                                        <label for="how_course_works_text" class="form-label">Text</label>
                                        <textarea class="form-control summernote @error('how_course_works_text') is-invalid @enderror" id="how_course_works_text"
                                            name="how_course_works_text">{{ old('how_course_works_text', $course->how_course_works_text) }}</textarea>
                                        @error('how_course_works_text')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="how_course_works_image" class="form-label">Image</label>
                                        @if($course->how_course_works_image)
                                            <div class="mb-2">
                                                <img src="{{ asset('uploads/courses/' . $course->how_course_works_image) }}" alt="How Course Works"
                                                    style="width: 200px; height: 120px; object-fit: cover; border-radius: 4px; border: 1px solid #3a3d4a;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('how_course_works_image') is-invalid @enderror" id="how_course_works_image" name="how_course_works_image"
                                            accept="image/*">
                                        <small class="text-muted">Leave empty to keep current image. Max size: 5MB</small>
                                        @error('how_course_works_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="howCourseWorksImagePreview" class="mt-3"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- What You Will Achieve Section -->
                            <div class="section-card">
                                <div class="section-header sections">
                                    <h6>
                                        <i class="ti ti-trophy"></i>
                                        What You Will Achieve
                                    </h6>
                                </div>
                                <div class="section-body">
                                    <div class="mb-3">
                                        <label for="what_you_achieve_text" class="form-label">Text</label>
                                        <textarea class="form-control summernote @error('what_you_achieve_text') is-invalid @enderror" id="what_you_achieve_text"
                                            name="what_you_achieve_text">{{ old('what_you_achieve_text', $course->what_you_achieve_text) }}</textarea>
                                        @error('what_you_achieve_text')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="what_you_achieve_image" class="form-label">Image</label>
                                        @if($course->what_you_achieve_image)
                                            <div class="mb-2">
                                                <img src="{{ asset('uploads/courses/' . $course->what_you_achieve_image) }}" alt="What You Will Achieve"
                                                    style="width: 200px; height: 120px; object-fit: cover; border-radius: 4px; border: 1px solid #3a3d4a;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('what_you_achieve_image') is-invalid @enderror" id="what_you_achieve_image" name="what_you_achieve_image"
                                            accept="image/*">
                                        <small class="text-muted">Leave empty to keep current image. Max size: 5MB</small>
                                        @error('what_you_achieve_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="whatYouAchieveImagePreview" class="mt-3"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQs Section -->
                            <div class="section-card">
                                <div class="section-header settings">
                                    <h6>
                                        <i class="ti ti-help"></i>
                                        FAQs
                                    </h6>
                                </div>
                                <div class="section-body">
                                    <div class="mb-3">
                                        <label class="form-label">Select FAQs</label>
                                        <div class="faq-list">
                                            @forelse($faqs as $faq)
                                                <div class="faq-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="faqs[]" value="{{ $faq->id }}" id="faq_{{ $faq->id }}"
                                                            {{ in_array($faq->id, old('faqs', $course->faqs->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="faq_{{ $faq->id }}">
                                                            <strong>{{ $faq->question }}</strong>
                                                            <br>
                                                            <small class="text-muted">{{ Str::limit($faq->answer, 100) }}</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="text-muted">No FAQs available. Please create FAQs first.</p>
                                            @endforelse
                                        </div>
                                        @error('faqs')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Status & Settings Section -->
                            <div class="section-card">
                                <div class="section-header settings">
                                    <h6>
                                        <i class="ti ti-settings"></i>
                                        Status & Settings
                                    </h6>
                                </div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                                <option value="active" {{ old('status', $course->status) == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ old('status', $course->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="sort_order" class="form-label">Sort Order</label>
                                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order"
                                                value="{{ old('sort_order', $course->sort_order) }}" min="0">
                                            @error('sort_order')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="show_on_homepage" name="show_on_homepage" value="1" {{ old('show_on_homepage', $course->show_on_homepage) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="show_on_homepage">
                                                    Show on Homepage
                                                </label>
                                            </div>
                                            <small class="text-muted">Enable this to display the course on the homepage</small>
                                            @error('show_on_homepage')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SEO Section -->
                            <div class="section-card">
                                <div class="section-header settings">
                                    <h6>
                                        <i class="ti ti-search"></i>
                                        SEO Settings
                                    </h6>
                                </div>
                                <div class="section-body">
                                    <div class="mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title"
                                            value="{{ old('meta_title', $course->meta_title) }}" placeholder="Leave empty to use course title">
                                        <small class="text-muted">SEO meta title (recommended: 50-60 characters)</small>
                                        @error('meta_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description"
                                            rows="3" placeholder="Leave empty to use short description">{{ old('meta_description', $course->meta_description) }}</textarea>
                                        <small class="text-muted">SEO meta description (recommended: 150-160 characters)</small>
                                        @error('meta_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <textarea class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords"
                                            rows="2" placeholder="Comma-separated keywords">{{ old('meta_keywords', $course->meta_keywords) }}</textarea>
                                        <small class="text-muted">Comma-separated keywords for SEO</small>
                                        @error('meta_keywords')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="canonical_url" class="form-label">Canonical URL</label>
                                    <input type="url" class="form-control @error('canonical_url') is-invalid @enderror"
                                           id="canonical_url" name="canonical_url" value="{{ old('canonical_url', $course->canonical_url) }}"
                                           placeholder="https://example.com/course-name">
                                    <small class="text-muted">Leave empty to auto-generate from course page URL. Use for duplicate content prevention.</small>
                                    @error('canonical_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="schema_block" class="form-label">Schema Markup (JSON-LD)</label>
                                    <textarea class="form-control @error('schema_block') is-invalid @enderror"
                                              id="schema_block" name="schema_block" rows="8"
                                              placeholder='{"@@context": "https://schema.org", "@type": "Course", "name": "Course Name", "provider": {"@type": "Organization", "name": "Nourhan Academy"}}'>{{ old('schema_block', $course->schema_block) }}</textarea>
                                    <small class="text-muted">Optional: Add structured data markup for better SEO. Must be valid JSON-LD format.</small>
                                    @error('schema_block')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('admin.courses.index', request()->query()) }}" class="btn btn-label-secondary">
                                    <i class="ti ti-x me-1"></i>
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-check me-1"></i>
                                    Update Course
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Summernote
            if (typeof $.fn.summernote !== 'undefined') {
                $('.summernote').summernote({
                    height: 300,
                    tooltip: false,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ],
                    placeholder: 'Write content here...',
                    tabsize: 2,
                    focus: false,
                    dialogsInBody: true,
                    callbacks: {
                        onInit: function() {
                            $('.note-editor').css('background-color', '#252836');
                            $('.note-editing-area').css('background-color', '#252836');
                            $('.note-editing-area').css('color', '#e4e6eb');
                        }
                    },
                    codeviewFilter: true
                });

                // Fix Summernote dropdowns
                $(document).on('click', '.note-btn-group .dropdown-toggle', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    var $group = $this.closest('.note-btn-group');
                    var $menu = $group.find('.note-dropdown-menu');
                    $('.note-btn-group').not($group).removeClass('open');
                    $('.note-dropdown-menu').not($menu).removeClass('open').hide();
                    $group.toggleClass('open');
                    $menu.toggleClass('open').toggle();
                });

                $(document).on('click', function(e) {
                    if (!$(e.target).closest('.note-btn-group').length) {
                        $('.note-btn-group').removeClass('open');
                        $('.note-dropdown-menu').removeClass('open').hide();
                    }
                });
            }

            // Image previews
            $('#banner_image').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#bannerImagePreview').html(`<img src="${e.target.result}" alt="Banner Preview" style="max-width: 300px; border-radius: 8px; border: 2px solid #3a3d4a;">`);
                    };
                    reader.readAsDataURL(file);
                }
            });

            $('#about_program_image').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#aboutProgramImagePreview').html(`<img src="${e.target.result}" alt="Preview" style="max-width: 300px; border-radius: 8px; border: 2px solid #3a3d4a;">`);
                    };
                    reader.readAsDataURL(file);
                }
            });

            $('#how_course_works_image').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#howCourseWorksImagePreview').html(`<img src="${e.target.result}" alt="Preview" style="max-width: 300px; border-radius: 8px; border: 2px solid #3a3d4a;">`);
                    };
                    reader.readAsDataURL(file);
                }
            });

            $('#what_you_achieve_image').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#whatYouAchieveImagePreview').html(`<img src="${e.target.result}" alt="Preview" style="max-width: 300px; border-radius: 8px; border: 2px solid #3a3d4a;">`);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
