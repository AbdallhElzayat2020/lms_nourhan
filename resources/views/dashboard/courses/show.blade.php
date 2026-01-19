@extends('dashboard.layouts.master')

@section('title', 'Course Details')

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
    .cover-image-container {
        background: #252836;
        border: 1px solid #3a3d4a;
        border-radius: 12px;
        padding: 1rem;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 300px;
        margin-bottom: 1.5rem;
    }
    .cover-image-container img {
        max-width: 100%;
        max-height: 400px;
        border-radius: 8px;
    }
    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding: 0.75rem;
        background: #252836;
        border-radius: 8px;
        border: 1px solid #3a3d4a;
    }
    .info-item i {
        color: #667eea;
        margin-right: 0.75rem;
        font-size: 1.2rem;
    }
    .info-item strong {
        color: #e4e6eb;
        margin-right: 0.5rem;
        min-width: 120px;
    }
    .info-item span {
        color: #b0b3b8;
    }
    .description-content {
        color: #b0b3b8;
        line-height: 1.8;
    }
    .description-content p {
        margin-bottom: 1rem;
    }
    .section-image {
        max-width: 100%;
        border-radius: 8px;
        margin-top: 1rem;
        border: 1px solid #3a3d4a;
    }
    .faq-item {
        padding: 1rem;
        margin-bottom: 0.75rem;
        background: #252836;
        border-radius: 8px;
        border: 1px solid #3a3d4a;
    }
    .faq-question {
        color: #e4e6eb;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .faq-answer {
        color: #b0b3b8;
        margin: 0;
    }
</style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card main-card">
                    <div class="card-header main-card-header d-flex justify-content-between align-items-center">
                        <h5>
                            <i class="ti ti-school"></i>
                            Course Details
                        </h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-label-primary">
                                <i class="ti ti-edit me-1"></i>
                                Edit
                            </a>
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-label-secondary">
                                <i class="ti ti-arrow-left me-1"></i>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body main-card-body">
                        <!-- Banner Image -->
                        @if($course->banner_image)
                            <div class="section-card">
                                <div class="section-header images">
                                    <h6>
                                        <i class="ti ti-photo"></i>
                                        Banner Image
                                    </h6>
                                </div>
                                <div class="section-body">
                                    <div class="cover-image-container">
                                        <img src="{{ asset('uploads/courses/' . $course->banner_image) }}" alt="{{ $course->title }}">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Basic Information -->
                        <div class="section-card">
                            <div class="section-header info">
                                <h6>
                                    <i class="ti ti-info-circle"></i>
                                    Basic Information
                                </h6>
                            </div>
                            <div class="section-body">
                                <div class="info-item">
                                    <i class="ti ti-heading"></i>
                                    <strong>Title:</strong>
                                    <span>{{ $course->title }}</span>
                                </div>

                                @if($course->subtitle)
                                    <div class="info-item">
                                        <i class="ti ti-subtitle"></i>
                                        <strong>Subtitle:</strong>
                                        <span>{{ $course->subtitle }}</span>
                                    </div>
                                @endif

                                <div class="info-item">
                                    <i class="ti ti-link"></i>
                                    <strong>Slug:</strong>
                                    <span>{{ $course->slug }}</span>
                                </div>

                                @if($course->category)
                                    <div class="info-item">
                                        <i class="ti ti-category"></i>
                                        <strong>Category:</strong>
                                        <span><span class="badge bg-label-info">{{ $course->category->name }}</span></span>
                                    </div>
                                @endif

                                @if($course->short_description)
                                    <div class="info-item">
                                        <i class="ti ti-file-text"></i>
                                        <strong>Short Description:</strong>
                                        <span>{{ $course->short_description }}</span>
                                    </div>
                                @endif

                                <div class="info-item">
                                    <i class="ti ti-toggle-left"></i>
                                    <strong>Status:</strong>
                                    <span>
                                        @if($course->status == 'active')
                                            <span class="badge bg-label-success">Active</span>
                                        @else
                                            <span class="badge bg-label-danger">Inactive</span>
                                        @endif
                                    </span>
                                </div>

                                <div class="info-item">
                                    <i class="ti ti-sort-ascending"></i>
                                    <strong>Sort Order:</strong>
                                    <span>{{ $course->sort_order }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Course Details -->
                        <div class="section-card">
                            <div class="section-header details">
                                <h6>
                                    <i class="ti ti-school"></i>
                                    Course Details
                                </h6>
                            </div>
                            <div class="section-body">
                                <div class="info-item">
                                    <i class="ti ti-book"></i>
                                    <strong>Lessons Count:</strong>
                                    <span>{{ $course->lessons_count }}</span>
                                </div>

                                <div class="info-item">
                                    <i class="ti ti-users"></i>
                                    <strong>Course Type:</strong>
                                    <span>
                                        @if($course->course_type == 'private')
                                            <span class="badge bg-label-warning">Private</span>
                                        @elseif($course->course_type == 'live')
                                            <span class="badge bg-label-primary">Live</span>
                                        @else
                                            <span class="badge bg-label-success">Both (Private & Live)</span>
                                        @endif
                                    </span>
                                </div>

                                <div class="info-item">
                                    <i class="ti ti-clock"></i>
                                    <strong>Duration:</strong>
                                    <span>{{ $course->duration_hours }} Hours</span>
                                </div>

                                @if($course->language)
                                    <div class="info-item">
                                        <i class="ti ti-language"></i>
                                        <strong>Language:</strong>
                                        <span>{{ $course->language }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Full Description -->
                        @if($course->description)
                            <div class="section-card">
                                <div class="section-header details">
                                    <h6>
                                        <i class="ti ti-file-text"></i>
                                        Full Description
                                    </h6>
                                </div>
                                <div class="section-body">
                                    <div class="description-content">
                                        {!! $course->description !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- About the Program -->
                        @if($course->about_program_text || $course->about_program_image)
                            <div class="section-card">
                                <div class="section-header sections">
                                    <h6>
                                        <i class="ti ti-file-text"></i>
                                        About the Program
                                    </h6>
                                </div>
                                <div class="section-body">
                                    @if($course->about_program_text)
                                        <div class="description-content">
                                            {!! $course->about_program_text !!}
                                        </div>
                                    @endif
                                    @if($course->about_program_image)
                                        <img src="{{ asset('uploads/courses/' . $course->about_program_image) }}" alt="About Program" class="section-image">
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- How Course Works -->
                        @if($course->how_course_works_text || $course->how_course_works_image)
                            <div class="section-card">
                                <div class="section-header sections">
                                    <h6>
                                        <i class="ti ti-settings"></i>
                                        How Course Works
                                    </h6>
                                </div>
                                <div class="section-body">
                                    @if($course->how_course_works_text)
                                        <div class="description-content">
                                            {!! $course->how_course_works_text !!}
                                        </div>
                                    @endif
                                    @if($course->how_course_works_image)
                                        <img src="{{ asset('uploads/courses/' . $course->how_course_works_image) }}" alt="How Course Works" class="section-image">
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- What You Will Achieve -->
                        @if($course->what_you_achieve_text || $course->what_you_achieve_image)
                            <div class="section-card">
                                <div class="section-header sections">
                                    <h6>
                                        <i class="ti ti-trophy"></i>
                                        What You Will Achieve
                                    </h6>
                                </div>
                                <div class="section-body">
                                    @if($course->what_you_achieve_text)
                                        <div class="description-content">
                                            {!! $course->what_you_achieve_text !!}
                                        </div>
                                    @endif
                                    @if($course->what_you_achieve_image)
                                        <img src="{{ asset('uploads/courses/' . $course->what_you_achieve_image) }}" alt="What You Will Achieve" class="section-image">
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- FAQs -->
                        @if($course->faqs->count() > 0)
                            <div class="section-card">
                                <div class="section-header details">
                                    <h6>
                                        <i class="ti ti-help"></i>
                                        FAQs ({{ $course->faqs->count() }})
                                    </h6>
                                </div>
                                <div class="section-body">
                                    @foreach($course->faqs as $faq)
                                        <div class="faq-item">
                                            <div class="faq-question">
                                                <i class="ti ti-help-circle me-1"></i>{{ $faq->question }}
                                            </div>
                                            <p class="faq-answer">{{ $faq->answer }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Timestamps -->
                        <div class="section-card">
                            <div class="section-header info">
                                <h6>
                                    <i class="ti ti-calendar-time"></i>
                                    Timestamps
                                </h6>
                            </div>
                            <div class="section-body">
                                <div class="info-item">
                                    <i class="ti ti-calendar-time"></i>
                                    <strong>Created At:</strong>
                                    <span>{{ \Carbon\Carbon::parse($course->created_at)->setTimezone('Africa/Cairo')->format('Y-m-d h:i A') }}</span>
                                </div>

                                <div class="info-item">
                                    <i class="ti ti-edit"></i>
                                    <strong>Updated At:</strong>
                                    <span>{{ \Carbon\Carbon::parse($course->updated_at)->setTimezone('Africa/Cairo')->format('Y-m-d h:i A') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Button -->
                        <div class="mt-4">
                            <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this course?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="ti ti-trash me-1"></i>
                                    Delete Course
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
