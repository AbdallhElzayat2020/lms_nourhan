@extends('frontend.layouts.master')
@section('content')
    <section class="page-header">
        <div class="bg-item">
            <div class="bg-img" data-background="{{ asset('assets/frontend/img/banner_top.jpeg') }}"></div>
            <div class="overlay"></div>
            <div class="shapes">
                {{-- <div class="shape shape-1"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-1.png') }}"
                        alt="shape"></div> --}}
                {{-- <div class="shape shape-2"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-2.png') }}"
                        alt="shape"></div> --}}
                {{-- <div class="shape shape-3"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-3.png') }}"
                        alt="shape"></div> --}}
            </div>
        </div>
        <div class="container">
            <div class="page-header-content">
                <h1 class="title">{{ $category->name }}</h1>
                <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                <a href="{{ route('frontend.courses') }}">Courses</a><span class="icon">/</span>
                <span class="inner-page">{{ $category->name }}</span>
            </div>
        </div>
    </section>

    <section class="course-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-header text-center">
                        <h2 class="title">{{ $category->name }} Courses</h2>
                        @if($category->description)
                            <div class="category-description">
                                {!! $category->description !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($courses->count() > 0)
                <div class="row py-5">
                    @foreach($courses as $course)
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="course-item">
                                <div class="course-thumb">
                                    <img src="{{ $course->banner_image ? asset('uploads/courses/' . $course->banner_image) : asset('assets/frontend/img/course/course-1.png') }}"
                                         alt="{{ $course->title }}">
                                    <div class="course-thumb-overlay">
                                        <div class="course-thumb-content">
                                            <div class="course-thumb-btn">
                                                <a href="{{ route('frontend.course.details', $course->slug) }}">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="course-content">
                                    <div class="course-content-top">
                                        <div class="course-tag">
                                            <a href="{{ route('frontend.category.details', $course->category->slug) }}">{{ $course->category->name }}</a>
                                        </div>
                                        <div class="course-price">
                                            @if($course->course_type === 'free')
                                                <span class="price">Free</span>
                                            @else
                                                <span class="price">Premium</span>
                                            @endif
                                        </div>
                                    </div>
                                    <h4 class="title"><a href="{{ route('frontend.course.details', $course->slug) }}">{{ $course->title }}</a></h4>

                                    @if($course->short_description)
                                        <p class="description">{{ Str::limit($course->short_description, 120) }}</p>
                                    @endif
                                    <div class="course-content-bottom">
                                        <div class="course-info">
                                            @if($course->lessons_count)
                                                <div class="course-info-item">
                                                    <div class="info-icon">
                                                        <i class="flaticon-book"></i>
                                                    </div>
                                                    <div class="info-text">
                                                        <span>{{ $course->lessons_count }} Lessons</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($course->duration_hours)
                                                <div class="course-info-item">
                                                    <div class="info-icon">
                                                        <i class="flaticon-clock"></i>
                                                    </div>
                                                    <div class="info-text">
                                                        <span>{{ $course->duration_hours }}h Duration</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="course-btn">
                                            <a href="{{ route('frontend.course.details', $course->slug) }}">View Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($courses->hasPages())
                    <div class="row">
                        <div class="col-12">
                            <div class="pagination-wrapper text-center">
                                {{ $courses->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <div class="empty-state">
                                <img src="{{ asset('assets/frontend/img/icons/empty-courses.svg') }}" alt="No courses" style="max-width: 200px; opacity: 0.5;">
                                <h4 class="mt-3">No Courses Available</h4>
                                <p class="text-muted">There are currently no courses available in this category.</p>
                                <a href="{{ route('frontend.courses') }}" class="btn btn-primary mt-3">Browse All Courses</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('css')
<style>
.category-description {
    margin-top: 20px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
    color: #666;
    line-height: 1.6;
}

.empty-state {
    padding: 60px 20px;
}

.empty-state h4 {
    color: #333;
    margin-bottom: 10px;
}

.pagination-wrapper {
    margin-top: 50px;
}
</style>
@endpush
