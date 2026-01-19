@extends('frontend.layouts.master')
@section('title', 'Courses')
@section('content')
    <section class="page-header">
        <div class="bg-item">
            <div class="bg-img" data-background="{{ asset('assets/frontend/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="shapes">
                <div class="shape shape-1"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-1.png') }}"
                        alt="shape"></div>
                <div class="shape shape-2"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-2.png') }}"
                        alt="shape"></div>
                <div class="shape shape-3"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-3.png') }}"
                        alt="shape"></div>
            </div>
        </div>
        <div class="container">
            <div class="page-header-content">
                <h1 class="title">Our Courses</h1>
                <h4 class="sub-title"><a class="home" href="{{ route('frontend.home') }}">Home </a><span
                        class="icon">/</span><a class="inner-page" href="{{ route('frontend.courses') }}"> Courses</a></h4>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="feature-course bg-white pt-120 pb-120">
        <div class="container">
            <!-- Filter Section -->
            <div class="courses-filter-section mb-5">
                <form action="{{ route('frontend.courses') }}" method="GET" class="filter-form">
                    <div class="filter-row">
                        <div class="filter-group search-group">
                            <div class="input-wrapper">
                                <input type="text" name="search" class="form-control filter-input"
                                       placeholder="Search courses..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="filter-group sort-group">
                            <select name="sort" class="form-select filter-select" onchange="this.form.submit()">
                                <option value="latest" {{ request('sort') == 'latest' || !request('sort') ? 'selected' : '' }}>Latest</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                            </select>
                        </div>
                        <div class="filter-group category-group">
                            <select name="category" class="form-select filter-select" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ $category->courses_count }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @if(request('search') || request('category') || request('sort'))
                            <div class="filter-group clear-group">
                                <a href="{{ route('frontend.courses') }}" class="clear-filters-btn">
                                    <i class="fa-sharp fa-solid fa-times"></i>
                                    Clear
                                </a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Results Header -->
            <div class="courses-results-header mb-5">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="courses-title">
                            @if(isset($selectedCategory))
                                {{ $selectedCategory->name }} Courses
                            @else
                                All Courses
                            @endif
                        </h2>
                        <p class="courses-count mb-0">
                            @if($courses->total() > 0)
                                Showing <strong>{{ $courses->firstItem() }}</strong> - <strong>{{ $courses->lastItem() }}</strong> of <strong>{{ $courses->total() }}</strong> courses
                            @else
                                No courses found
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            @if ($courses->count() > 0)
                <div class="row gy-4">
                    @foreach ($courses as $index => $course)
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="course-item wow fade-in-bottom" data-wow-delay="{{ 200 + ($index % 3) * 100 }}ms">
                                <div class="course-thumb-wrap">
                                    <div class="course-thumb">
                                        <a href="{{ route('frontend.course.details', ['slug' => $course->slug]) }}">
                                            @if ($course->banner_image)
                                                <img src="{{ asset('uploads/courses/' . $course->banner_image) }}" alt="{{ $course->title }}">
                                            @else
                                                <img src="{{ asset('assets/frontend/img/images/course-img-1.png') }}" alt="{{ $course->title }}">
                                            @endif
                                        </a>
                                    </div>
                                    @if ($course->category)
                                        <div class="course-category-badge">
                                            <i class="fa-sharp fa-solid fa-tag me-1"></i>
                                            {{ $course->category->name }}
                                        </div>
                                    @endif
                                </div>
                                <div class="course-content">
                                    <h3 class="title">
                                        <a href="{{ route('frontend.course.details', ['slug' => $course->slug]) }}">{{ $course->title }}</a>
                                    </h3>
                                    @if ($course->subtitle)
                                        <p class="course-subtitle">{{ Str::limit($course->subtitle, 70) }}</p>
                                    @endif
                                    @if ($course->short_description)
                                        <p class="course-description">{{ Str::limit($course->short_description, 90) }}</p>
                                    @endif
                                    <ul class="course-list">
                                        @if ($course->lessons_count)
                                            <li>
                                                <i class="fa-light fa-file"></i>
                                                <span>{{ $course->lessons_count }} Lessons</span>
                                            </li>
                                        @endif
                                        <li>
                                            <i class="fa-light fa-user"></i>
                                            <span>
                                                @if($course->course_type == 'both')
                                                    Private & Live
                                                @elseif($course->course_type == 'private')
                                                    Private
                                                @else
                                                    Live
                                                @endif
                                            </span>
                                        </li>
                                        @if ($course->duration_hours)
                                            <li>
                                                <i class="fa-light fa-clock"></i>
                                                <span>{{ $course->duration_hours }} Hours</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="bottom-content">
                                    <a href="{{ route('frontend.course.details', ['slug' => $course->slug]) }}" class="course-btn">
                                        View Details
                                        <i class="fa-regular fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($courses->hasPages())
                    <div class="row mt-5">
                        <div class="col-12">
                            <nav aria-label="Course pagination" class="courses-pagination">
                                {{ $courses->links('pagination::bootstrap-4') }}
                            </nav>
                        </div>
                    </div>
                @endif
            @else
                <div class="no-courses-found">
                    <div class="no-courses-icon">
                        <i class="fa-sharp fa-solid fa-book-open"></i>
                    </div>
                    <h3>No Courses Found</h3>
                    <p>We couldn't find any courses matching your criteria. Try adjusting your filters or search terms.</p>
                    <a href="{{ route('frontend.courses') }}" class="ed-primary-btn">
                        <i class="fa-sharp fa-solid fa-rotate-left me-2"></i>
                        Reset Filters
                    </a>
                </div>
            @endif
        </div>
    </section>
    <!-- ./ course-section -->
@endsection

@push('css')
<style>
    /* Filter Section Styles */
    .courses-filter-section {
        padding: 25px 30px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #E0E5EB;
    }

    .filter-form {
        width: 100%;
    }

    .filter-row {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }

    .filter-group {
        flex: 1;
        min-width: 180px;
    }

    .search-group {
        flex: 2;
        min-width: 250px;
    }

    .sort-group {
        flex: 1;
        min-width: 150px;
    }

    .category-group {
        flex: 1;
        min-width: 200px;
    }

    .clear-group {
        flex-shrink: 0;
    }

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        color: #DF8A39;
        font-size: 16px;
        z-index: 2;
        pointer-events: none;
    }

    .filter-input {
        padding: 12px 15px 12px 45px;
        border: 2px solid #E0E5EB;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #fff;
        width: 100%;
    }

    .filter-input:focus {
        border-color: #DF8A39;
        box-shadow: 0 0 0 4px rgba(223, 138, 57, 0.1);
        outline: none;
    }

    .filter-select {
        padding: 12px 15px;
        border: 2px solid #E0E5EB;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #fff;
        cursor: pointer;
        width: 100%;
        color: #1a1d29;
    }

    /* Remove duplicate arrow from nice-select - hide any background arrows */
    .filter-select {
        background-image: none !important;
        background: #fff !important;
    }

    .nice-select.filter-select {
        background-image: none !important;
        background: #fff !important;
    }

    /* Keep only nice-select's default arrow */
    .nice-select.filter-select::after {
        display: block !important;
        border-color: #666 !important;
    }

    .filter-select:focus {
        border-color: #DF8A39;
        box-shadow: 0 0 0 4px rgba(223, 138, 57, 0.1);
        outline: none;
    }

    .clear-filters-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        background: #f8f9fa;
        color: #666;
        text-decoration: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid #E0E5EB;
        white-space: nowrap;
    }

    .clear-filters-btn:hover {
        background: #DF8A39;
        color: #fff;
        border-color: #DF8A39;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(223, 138, 57, 0.3);
    }

    /* Results Header */
    .courses-results-header {
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f0f0;
    }

    .courses-title {
        font-size: 28px;
        font-weight: 700;
        color: #1a1d29;
        margin-bottom: 8px;
    }

    .courses-count {
        color: #666;
        font-size: 14px;
    }

    /* Course Item Enhancements */
    .course-item {
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .course-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .course-category-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(223, 138, 57, 0.95);
        color: #fff;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        z-index: 2;
        backdrop-filter: blur(10px);
    }

    .course-thumb-wrap {
        position: relative;
    }

    .course-subtitle {
        color: #DF8A39;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .course-description {
        color: #666;
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .course-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .course-btn:hover {
        background: #DF8A39;
        color: #fff;
        border-color: #DF8A39;
    }

    .course-btn:hover i {
        transform: translateX(5px);
    }

    /* No Courses Found */
    .no-courses-found {
        text-align: center;
        padding: 60px 20px;
        background: #f8f9fa;
        border-radius: 12px;
        border: 2px dashed #E0E5EB;
    }

    .no-courses-icon {
        font-size: 64px;
        color: #ccc;
        margin-bottom: 20px;
    }

    .no-courses-found h3 {
        color: #1a1d29;
        margin-bottom: 10px;
    }

    .no-courses-found p {
        color: #666;
        margin-bottom: 25px;
    }

    /* Pagination */
    .courses-pagination {
        display: flex;
        justify-content: center;
    }

    .courses-pagination .pagination {
        margin: 0;
    }

    .courses-pagination .page-link {
        color: #666;
        border-color: #E0E5EB;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .courses-pagination .page-link:hover {
        background: #DF8A39;
        color: #fff;
        border-color: #DF8A39;
    }

    .courses-pagination .page-item.active .page-link {
        background: #DF8A39;
        border-color: #DF8A39;
        color: #fff;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .courses-filter-section {
            padding: 20px;
        }

        .filter-row {
            flex-direction: column;
        }

        .filter-group {
            width: 100%;
            min-width: 100%;
        }

        .search-group,
        .sort-group,
        .category-group {
            min-width: 100%;
        }

        .clear-group {
            width: 100%;
        }

        .clear-filters-btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 575px) {
        .courses-filter-section {
            padding: 15px;
        }

        .filter-input,
        .filter-select {
            padding: 10px 12px 10px 40px;
            font-size: 14px;
        }
    }

    /* Ensure nice-select arrow is visible and styled correctly */
    .nice-select.filter-select .current {
        color: #1a1d29;
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ensure nice-select is initialized for filter selects
        if (typeof jQuery !== 'undefined' && typeof jQuery.fn.niceSelect !== 'undefined') {
            jQuery('.filter-select').niceSelect();
        }
    });
</script>
@endpush
