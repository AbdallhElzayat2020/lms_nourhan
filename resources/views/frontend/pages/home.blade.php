@extends('frontend.layouts.master')

@section('content')

    <section class="slider-section overflow-hidden">
        <div class="edcare-slider swiper-container">
            <div class="swiper-wrapper">
                @forelse($sliders as $slider)
                    <div class="swiper-slide">
                        <div class="slider-item">
                            <div class="bg-img" data-background="{{ asset('uploads/sliders/' . $slider->image) }}"></div>
                            <div class="overlay"></div>
                            <div class="overlay-2"></div>
                            <div class="container">
                                <div class="slider-content-wrap">
                                    <div class="slider-content">
                                        <div class="sub-heading-wrap" data-animation="edcare-fadeInDown" data-delay="1000ms"
                                            data-duration="1200ms">
                                            <h1 class="sub-heading">{{ $slider->title }}</h1>
                                        </div>
                                        <div class="edcare-caption heading">
                                            <div class="inner-layer">
                                                <div class="edcare-cap" data-animation="edcare-fadeInDown"
                                                    data-delay="1200ms" data-duration="1400ms">
                                                    <span>{{ $slider->text_line_1 }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($slider->description)
                                            <div class="edcare-slider-desc" data-animation="edcare-fadeInUp"
                                                data-delay="1500ms" data-duration="1700ms">
                                                <p>{{ $slider->description }}</p>
                                            </div>
                                        @endif
                                        <div class="slider-btn-wrap" data-animation="edcare-fadeInUp" data-delay="1600ms"
                                            data-duration="1800ms">
                                            @if ($slider->link && $slider->button_text)
                                                <a class="ed-primary-btn slider-btn" href="{{ $slider->link }}">
                                                    {{ $slider->button_text }}
                                                    <i class="fa-sharp fa-regular fa-arrow-right"></i>
                                                </a>
                                            @endif
                                            @if ($slider->link_2 && $slider->button_text_2)
                                                <a class="ed-primary-btn slider-btn" href="{{ $slider->link_2 }}">
                                                    {{ $slider->button_text_2 }}
                                                    <i class="fa-sharp fa-regular fa-arrow-right"></i>
                                                </a>
                                            @else
                                                <!-- Fallback to default courses button -->
                                                <a class="ed-primary-btn slider-btn" href="{{ route('frontend.courses') }}">
                                                    Our Courses
                                                    <i class="fa-sharp fa-regular fa-arrow-right"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Fallback static slide if no sliders configured --}}
                    <div class="swiper-slide">
                        <div class="slider-item">
                            <div class="bg-img"
                                data-background="{{ asset('assets/frontend/img/new-update-2/slider-img-1.png') }}">
                            </div>
                            <div class="overlay"></div>
                            <div class="overlay-2"></div>
                            <div class="container">
                                <div class="slider-content-wrap">
                                    <div class="slider-content">
                                        <div class="sub-heading-wrap" data-animation="edcare-fadeInDown" data-delay="1000ms"
                                            data-duration="1200ms">
                                            <h1 class="sub-heading">Welcome to Sister Nourhan Academy</h1>
                                        </div>
                                        <div class="edcare-caption heading">
                                            <div class="inner-layer">
                                                <div class="edcare-cap" data-animation="edcare-fadeInDown"
                                                    data-delay="1200ms" data-duration="1400ms">
                                                    <span>Where Knowledge Meets</span>
                                                </div>
                                            </div>
                                            <div class="inner-layer">
                                                <div class="edcare-cap edcare-cap-2" data-animation="edcare-fadeInDown"
                                                    data-delay="1400ms" data-duration="1600ms">
                                                    <span>Innovation and Dreams</span>
                                                </div>
                                            </div>
                                            <div class="inner-layer">
                                                <div class="edcare-cap edcare-cap-3" data-animation="edcare-fadeInDown"
                                                    data-delay="1400ms" data-duration="1600ms">
                                                    <span>Become Reality.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="edcare-slider-desc" data-animation="edcare-fadeInUp" data-delay="1500ms"
                                            data-duration="1700ms">
                                            <p>Start your learning journey with our curated courses and expert teachers.</p>
                                        </div>
                                        <div class="slider-btn-wrap" data-animation="edcare-fadeInUp" data-delay="1600ms"
                                            data-duration="1800ms">
                                            <a class="ed-primary-btn slider-btn" href="{{ route('frontend.contact') }}">
                                                Book Free Trial Now
                                                <i class="fa-sharp fa-regular fa-arrow-right"></i>
                                            </a>
                                            <a class="ed-primary-btn slider-btn" href="{{ route('frontend.courses') }}">
                                                Our Courses
                                                <i class="fa-sharp fa-regular fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <!-- <div class="edcare-swiper-pagination"></div> -->
        </div>
        <div thumbsSlider="" class="swiper edcare-slider-thumb">
            <div class="swiper-wrapper">
                @forelse($sliders as $slider)
                    <div class="swiper-slide">
                        <div class="slider-thumb-item">
                            <img src="{{ asset('uploads/sliders/' . $slider->image) }}" alt="{{ $slider->title }}">
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <div class="slider-thumb-item">
                            <img src="{{ asset('assets/frontend/img/new-update-2/slider-bullet-1.png') }}"
                                alt="Slide">
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <!-- Carousel Dots -->
    </section>
    <!-- ./ slider-section -->

    <style>
        /* Full height slider minus navbar */
        .slider-section {
            height: calc(90vh - 120px) !important; /* Subtract navbar height */
            min-height: 600px; /* Minimum height for small screens */
        }

        .slider-section .slider-item {
            height: calc(90vh - 120px) !important;
            min-height: 600px;
        }

        .slider-section .edcare-slider,
        .slider-section .edcare-slider .swiper-wrapper,
        .slider-section .edcare-slider .swiper-slide {
            height: 100% !important;
        }

        /* Center slider content vertically */
        .slider-section .slider-content-wrap {
            display: flex;
            align-items: center;
            height: 100%;
        }

        /* Fix for 4+ sliders thumbnails */
        .slider-section .edcare-slider-thumb {
            height: 350px !important;
        }

        /* Ensure proper spacing for more thumbnails */
        .slider-section .edcare-slider-thumb .swiper-slide {
            margin-bottom: 8px;
        }

        /* Responsive adjustments */
        @media (max-width: 1199px) {
            .slider-section {
                height: calc(90vh - 100px) !important;
                min-height: 500px;
            }
            .slider-section .slider-item {
                height: calc(90vh - 100px) !important;
                min-height: 500px;
            }
            .slider-section .edcare-slider-thumb {
                height: 320px !important;
            }
        }

        @media (max-width: 991px) {
            .slider-section {
                height: calc(90vh - 80px) !important;
                min-height: 450px;
            }
            .slider-section .slider-item {
                height: calc(90vh - 80px) !important;
                min-height: 450px;
            }
            .slider-section .edcare-slider-thumb {
                height: 300px !important;
            }
        }

        @media (max-width: 767px) {
            .slider-section {
                height: calc(90vh - 70px) !important;
                min-height: 400px;
            }
            .slider-section .slider-item {
                height: calc(90vh - 70px) !important;
                min-height: 400px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fix for slider thumbnails to show all slides
            setTimeout(function() {
                const thumbSlider = document.querySelector('.edcare-slider-thumb .swiper-wrapper');
                if (thumbSlider) {
                    // Force recalculation of swiper dimensions
                    const swiperInstance = thumbSlider.swiper;
                    if (swiperInstance) {
                        swiperInstance.update();
                        swiperInstance.updateSlides();
                        swiperInstance.updateProgress();
                        swiperInstance.updateSlidesClasses();
                    }
                }
            }, 1000);
        });
    </script>


    <!-- about section -->
    @if (isset($aboutSection) && $aboutSection)
        <section class="about-section-3 pt-120 pb-120">
            <div class="shapes">
                <div class="shape shape-1"><img src="{{ asset('assets/frontend/img/shapes/about-shape-1.png') }}"
                        alt="shape"></div>
                <div class="shape shape-2"><img src="{{ asset('assets/frontend/img/shapes/about-shape-2.png') }}"
                        alt="shape"></div>
                <div class="shape shape-3"><img src="{{ asset('assets/frontend/img/shapes/about-shape-3.png') }}"
                        alt="shape"></div>
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="about-img-wrap-3 wow fade-in-left" data-wow-delay="400ms">
                            <div class="about-img">
                                @if ($aboutSection->video_url)
                                    {{-- <div class="about-video"
                                    style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; background: #000; border-radius: 12px;">

                                </div> --}}
                                    <iframe
                                        style="position: absolute; top: 0; border-radius: 10px; left: 0; width: 100%; height: 100%; border: 0;"
                                        src="{{ $aboutSection->video_url }}" title="About video"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                    </iframe>
                                @else
                                    <img class="main-img" src="{{ asset('assets/frontend/img/images/about-img-3.png') }}"
                                        alt="about">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="about-content-3">
                            <div class="section-heading mb-20">
                                @if ($aboutSection->subtitle)
                                    <p class="sub-heading wow fade-in-bottom" data-wow-delay="300ms"><span
                                            class="heading-icon"><i
                                                class="fa-sharp fa-solid fa-bolt"></i></span>{{ $aboutSection->subtitle }}
                                    </p>
                                @endif
                                <h2 class="section-title wow fade-in-bottom" data-wow-delay="400ms">
                                    {!! nl2br(e($aboutSection->title)) !!}</h2>
                            </div>
                            @if ($aboutSection->description)
                                <p class="mb-30 wow fade-in-bottom" data-wow-delay="500ms">
                                    {{ $aboutSection->description }}</p>
                            @endif
                            @if ($aboutSection->button_text && $aboutSection->button_link)
                                <div class="about-btn wow fade-in-bottom" data-wow-delay="600ms">
                                    <a href="{{ $aboutSection->button_link }}"
                                        class="ed-primary-btn">{{ $aboutSection->button_text }} <i
                                            class="fa-regular fa-arrow-right"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- about section -->

    {{-- counter section (dynamic) --}}
    @if(isset($counters) && $counters->count() > 0)
        <section class="counter-section">
            <div class="container">
                <div class="row counter-wrap gy-lg-0 gy-5">
                    @foreach ($counters as $index => $counter)
                        <div class="col-lg-3 col-md-6">
                            <div
                                class="counter-item {{ $index === 0 ? 'item-1' : ($index === 3 ? 'item-4' : '') }} white-content">
                                <h3 class="title">
                                    <span class="odometer" data-count="{{ $counter->value }}">0</span>{{ $counter->suffix }}
                                </h3>
                                <p>{{ $counter->subtitle }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    {{-- ./ counter-section --}}

    {{-- categories section --}}
    @if ($categories->count() > 0)
        <section class="course-section-11 pt-120 pb-120 overflow-hidden">
            <div class="container">
                <div class="section-heading text-center">
                    <p class="sub-heading wow fade-in-bottom" data-wow-delay="200ms"><span class="heading-icon"><i
                                class="fa-sharp fa-solid fa-bolt"></i></span>Popular Categories</p>
                    <h2 class="section-title wow fade-in-bottom" data-wow-delay="400ms">Browse Categories</h2>
                </div>
                <div class="course-carousel-4 swiper">
                    <div class="swiper-wrapper">
                        @foreach ($categories as $category)
                            <div class="swiper-slide">
                                <div class="course-item-11">
                                    <a href="{{ route('frontend.courses', ['category' => $category->slug]) }}">
                                        <div class="course-thumb">
                                            @if ($category->image)
                                                <img src="{{ asset('uploads/categories/' . $category->image) }}"
                                                    alt="{{ $category->name }}">
                                            @else
                                                <img src="{{ asset('assets/frontend/img/new-update-2/course-img-1.png') }}"
                                                    alt="{{ $category->name }}">
                                            @endif
                                        </div>
                                        <div class="course-content">
                                            <h3 class="title">{{ $category->name }}</h3>
                                            <div class="category-count">
                                                <span class="count-badge">{{ $category->courses_count }} Courses</span>
                                            </div>
                                            @if ($category->description)
                                                <div class="category-description">
                                                    {!! $category->description !!}
                                                </div>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    {{-- ./ categories section --}}

    @if(isset($whyChooseItems) && $whyChooseItems->count() > 0)
        <!-- WHY choose us -->
        <section class="offer-section pt-120 pb-120 pt-md-80 pb-md-80 pt-sm-60 pb-sm-60">
            <div class="container">
                <div class="section-heading text-center">
                    <p class="sub-heading wow fade-in-bottom" data-wow-delay="200ms">
                        <span class="heading-icon"><i class="fa-sharp fa-solid fa-bolt"></i></span>
                        Why Choose US
                    </p>
                    <h2 class="section-title wow fade-in-bottom" data-wow-delay="400ms">
                        Why Choose Sister Nourhan Academy
                    </h2>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                        <ul class="offer-nav nav nav-tabs mb-0" id="myTab" role="tablist">
                            @foreach($whyChooseItems as $index => $item)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" type="button"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        <div class="offer-tab-btn">
                                            <div class="icon">
                                                <i class="{{ $item->icon_class ?: 'fa-solid fa-star' }}"></i>
                                            </div>
                                            <div class="content">
                                                <h3 class="title">{{ $item->title }}</h3>
                                                @if($item->subtitle)
                                                    <p class="mb-1"><strong>{{ $item->subtitle }}</strong></p>
                                                @endif
                                                @if($item->description)
                                                    <p class="mb-0">{{ $item->description }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                <div class="col-lg-6 col-md-12">
                    <div class="offer-tab-content tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                            aria-labelledby="home-tab">

                            <div class="offer-video"
                                style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; background: #000;">
                                @php
    // Get video URL from first active item that has a video
    $whyChooseVideo = $whyChooseItems->firstWhere('video_url', '!=', null);
                                @endphp
                                @if($whyChooseVideo && $whyChooseVideo->embed_video_url)
                                    <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                                        src="{{ $whyChooseVideo->embed_video_url }}"
                                        title="YouTube video player"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                    </iframe>
                                @else
                                    <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                                        src="https://www.youtube.com/embed/qjxDcU4m2FQ?si=9JC0uy-hV0SeDxQR"
                                        title="YouTube video player"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                    </iframe>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    @endif
    {{-- <!-- WHY choose us --> --}}



    {{-- <!--our courses --> --}}
    @if(isset($featuredCourses) && $featuredCourses->count() > 0)
        <section class="feature-course feature-course-2 pt-120 pb-120">
            <div class="shapes">
                <div class="shape-1"><img src="{{ asset('assets/frontend/img/shapes/feature-shape-1.png') }}"
                        alt="shape"></div>
                <div class="shape-2"><img src="{{ asset('assets/frontend/img/shapes/feature-shape-2.png') }}"
                        alt="shape"></div>
            </div>
            <div class="container">
                <div class="section-heading text-center">
                    <p class="sub-heading wow fade-in-bottom" data-wow-delay="200ms"><span class="heading-icon"><i
                                class="fa-sharp fa-solid fa-bolt"></i></span>Top Class Courses</p>
                    <h2 class="section-title text-white wow fade-in-bottom" data-wow-delay="400ms">Popular Courses</h2>
                </div>
                <div class="course-tab-content">
                    <div class="row gy-4 justify-content-center">
                        @foreach($featuredCourses as $index => $course)
                            <div class="col-lg-4 col-md-6">
                                <div class="course-item dark-item wow fade-in-bottom" data-wow-delay="{{ 300 + $index * 100 }}ms">
                                    <div class="course-thumb-wrap">
                                        <div class="course-thumb">
                                            <a href="{{ route('frontend.course.details', ['slug' => $course->slug]) }}">
                                                @php
            $courseImage = $course->banner_image
                ? asset('uploads/courses/' . $course->banner_image)
                : asset('assets/frontend/img/service/course-img-8.png');
                                                @endphp
                                                <img src="{{ $courseImage }}" alt="{{ $course->title }}">
                                            </a>
                                        </div>
                                        @if($course->category)
                                            <div class="course-category-badge">
                                                <i class="fa-sharp fa-solid fa-tag me-1"></i>
                                                {{ $course->category->name }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="course-content">
                                        <h3 class="title">
                                            <a href="{{ route('frontend.course.details', ['slug' => $course->slug]) }}">
                                                {{ $course->title }}
                                            </a>
                                        </h3>
                                        @if($course->subtitle)
                                            <p class="course-subtitle">{{ Str::limit($course->subtitle, 70) }}</p>
                                        @endif
                                        @if($course->short_description)
                                            <p class="course-description">{{ Str::limit($course->short_description, 90) }}</p>
                                        @endif
                                        <ul class="course-list">
                                            @if($course->lessons_count)
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
                                                    @elseif($course->course_type == 'live')
                                                        Live
                                                    @else
                                                        {{ $course->course_type ?: 'Course' }}
                                                    @endif
                                                </span>
                                            </li>
                                            @if($course->duration_hours)
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
                </div>
            </div>
        </section>
    @endif

    @if (isset($recentTeachers) && $recentTeachers->count() > 0)
        <!--  team  -->
        <section class="team-section pt-5 pb-5">
            <div class="container">
                <div class="section-heading text-center">
                    <p class="sub-heading wow fade-in-bottom" data-wow-delay="200ms"><span class="heading-icon"><i
                                class="fa-sharp fa-solid fa-bolt"></i></span>Our Instructors</p>
                    <h2 class="section-title wow fade-in-bottom" data-wow-delay="400ms">Meet Our Expert Instructors</h2>
                </div>
                <div class="row gy-lg-0 gy-4">
                    @foreach ($recentTeachers as $teacher)
                        <div class="col-lg-3 col-md-6 my-3">
                            <div class="team-item-3 wow fade-in-bottom" data-wow-delay="200ms">
                                <a href="{{ route('frontend.teacher.details', $teacher->slug) }}">
                                    <div class="team-thumb-wrap">
                                        <div class="team-thumb">
                                            @if ($teacher->image)
                                                <img src="{{ asset('uploads/teachers/' . $teacher->image) }}"
                                                    alt="{{ $teacher->name }}">
                                            @else
                                                <img src="{{ asset('assets/frontend/img/male.png') }}"
                                                    alt="{{ $teacher->name }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="team-content">
                                        <h3 class="name">{{ $teacher->name }}</h3>
                                        @if ($teacher->short_description)
                                            <span class="designation">{!! $teacher->short_description !!}</span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- <!-- ./ testimonial --> --}}
    @if ($testimonials->count() > 0)
        <section class="testimonial-section-2 py-5">
            <div class="container">
                <div class="section-heading text-center">
                    <p class="sub-heading wow fade-in-bottom" data-wow-delay="200ms">
                        <span class="heading-icon">
                            <i class="fa-sharp fa-solid fa-bolt"></i>
                        </span>
                        Our Testimonials
                    </p>
                    <h2 class="section-title wow fade-in-bottom" data-wow-delay="400ms">
                        Feedback’s From Our Student
                    </h2>
                </div>
                <div class="testi-carousel swiper">
                    <div class="swiper-wrapper">
                        @foreach ($testimonials as $testimonial)
                            @php
        $avatarPath =
            $testimonial->gender === 'female'
            ? asset('assets/frontend/img/female.png')
            : asset('assets/frontend/img/male.png');
        $rating = 5;
                            @endphp
                            <div class="swiper-slide">
                                <div class="testi-item-2">
                                    <div class="testi-top-content">
                                        <div class="testi-thumb">
                                            <img src="{{ $avatarPath }}" alt="{{ $testimonial->name }}"
                                                style="object-fit: cover; width: 60px; height: 60px; border-radius: 50%;">
                                        </div>
                                        <p>"{{ $testimonial->description }}"</p>
                                    </div>
                                    <div class="testi-bottom">
                                        <div class="author-info">
                                            <h4 class="name">{{ $testimonial->name }}</h4>
                                            @if ($testimonial->country)
                                                <span>{{ $testimonial->country }}</span>
                                            @endif
                                        </div>
                                        <ul class="testi-review">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <li>
                                                    <i
                                                        class="fa-sharp fa-solid fa-star {{ $i <= $rating ? '' : 'text-muted' }}"></i>
                                                </li>
                                            @endfor
                                            <li class="point">({{ number_format($rating, 1) }})</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endif
    {{-- <!-- ./ testimonial --> --}}

    {{-- <!-- ./ sponsor (partners) --> --}}
    @if ($partners->count() > 0)
        <div class="sponsor-section pb-120 bg-grey">
            <div class="shapes">
                <div class="bg-shape"><img src="{{ asset('assets/frontend/img/shapes/sponsor-shape.png') }}"
                        alt="shape"></div>
                <div class="shape shape-1"><img src="{{ asset('assets/frontend/img/shapes/sponsor-1.png') }}"
                        alt="shape"></div>
                <div class="shape shape-2"><img src="{{ asset('assets/frontend/img/shapes/sponsor-2.png') }}"
                        alt="shape"></div>
            </div>
            <div class="container">
                <div class="row gy-4 justify-content-center">
                    @foreach ($partners as $partner)
                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                            <div class="sponsor-item text-center"
                                style="background:#fff;border-radius:16px;padding:20px 15px;box-shadow:0 8px 20px rgba(0,0,0,0.05);">
                                @php
        $logoUrl = $partner->logo ? asset('uploads/partners/' . $partner->logo) : null;
                                @endphp
                                @if ($partner->link)
                                    <a href="{{ $partner->link }}" target="_blank" rel="noopener">
                                        @if ($logoUrl)
                                            <img src="{{ $logoUrl }}" alt="{{ $partner->name }}"
                                                style="max-width:100%;height:60px;object-fit:contain;">
                                        @else
                                            <span>{{ $partner->name }}</span>
                                        @endif
                                    </a>
                                @else
                                    @if ($logoUrl)
                                        <img src="{{ $logoUrl }}" alt="{{ $partner->name }}"
                                            style="max-width:100%;height:60px;object-fit:contain;">
                                    @else
                                        <span>{{ $partner->name }}</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    {{-- <!-- ./ sponsor (partners) --> --}}

    {{-- <!-- events --> --}}
    @if(isset($upcomingEvents) && $upcomingEvents->count() > 0)
    <section class="features-event pt-5 pb-5">
        <div class="container">
            <div class="section-heading text-center">
                <p class="sub-heading wow fade-in-bottom" data-wow-delay="200ms"><span class="heading-icon"><i
                            class="fa-sharp fa-solid fa-bolt"></i></span>Events</p>
                <h2 class="section-title wow fade-in-bottom" data-wow-delay="400ms">Upcoming Events</h2>
            </div>
            <div class="row gy-4 justify-content-center">
                @foreach($upcomingEvents as $index => $event)
                    <div class="col-lg-4 col-md-6">
                        <div class="event-item wow fade-in-bottom" data-wow-delay="{{ 400 + $index * 100 }}ms">
                            <div class="event-thumb">
                                @php
        $eventImage = $event->image
            ? asset('uploads/events/' . $event->image)
            : asset('assets/frontend/img/images/event-img-1.png');
                                @endphp
                                <img src="{{ $eventImage }}" alt="{{ $event->name }}">
                                <div class="date-wrap">
                                    <h5 class="date">
                                        {{ optional($event->start_date)->format('d') }}
                                        <span>{{ optional($event->start_date)->format('M') }}</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="event-content">
                                @if($event->time)
                                    <span class="time"><i class="fa-regular fa-clock"></i> {{ $event->time }}</span>
                                @endif
                                <h3 class="title">
                                    <a href="{{ route('frontend.event.details', ['slug' => $event->slug]) }}">
                                        {!! nl2br(e(Str::limit($event->name, 60))) !!}
                                    </a>
                                </h3>
                                @if($event->location)
                                    <div class="location">
                                        <span><i class="fa-regular fa-location-dot"></i>{{ $event->location }}</span>
                                    </div>
                                @endif
                                <a href="{{ route('frontend.event.details', ['slug' => $event->slug]) }}" class="ed-primary-btn">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    {{-- <!-- events --> --}}


    {{-- <!--blogs (dynamic from DB) --> --}}
    @if ($recentBlogs->count() > 0)
        <section class="blog-section pt-5 pb-120">
            <div class="container">
                <div class="section-heading text-center">
                    <p class="sub-heading wow fade-in-bottom" data-wow-delay="200ms"><span class="heading-icon"><i
                                class="fa-sharp fa-solid fa-bolt"></i></span>News & Blogs</p>
                    <h2 class="section-title wow fade-in-bottom" data-wow-delay="400ms">Latest News Updates</h2>
                </div>
                <div class="row gy-lg-0 gy-4 justify-content-center post-card-2-wrap">
                    @foreach ($recentBlogs as $index => $blog)
                        <div class="col-lg-4 col-md-6">
                            <div class="post-card-2 post-card-3 wow fade-in-bottom"
                                data-wow-delay="{{ 300 + $index * 100 }}ms">
                                <a href="{{ route('frontend.blog.details', ['slug' => $blog->slug]) }}">
                                    <div class="post-thumb">
                                        @if ($blog->cover_image)
                                            <img src="{{ asset('uploads/blogs/' . $blog->cover_image) }}"
                                                alt="{{ $blog->title }}">
                                        @endif
                                    </div>
                                    <div class="post-content-wrap">
                                        <div class="post-content">
                                            <ul class="post-meta">
                                                <li><i
                                                        class="fa-sharp fa-regular fa-clock"></i>{{ optional($blog->published_at)->format('M d, Y') }}
                                                </li>
                                                @if ($blog->author)
                                                    <li><i class="fa-sharp fa-regular fa-user"></i>{{ $blog->author }}
                                                    </li>
                                                @endif
                                            </ul>
                                            <h3 class="title">
                                                <a
                                                    href="{{ route('frontend.blog.details', ['slug' => $blog->slug]) }}">{{ $blog->title }}</a>
                                            </h3>
                                            @if ($blog->short_description)
                                                <p>{{ Str::limit($blog->short_description, 100) }}</p>
                                            @endif
                                            <a href="{{ route('frontend.blog.details', ['slug' => $blog->slug]) }}"
                                                class="read-more">Read More <i
                                                    class="fa-regular fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <a href="{{ route('frontend.blog') }}" class="count-badge">View All Blogs</a>
                </div>
            </div>
        </section>
    @endif
    {{-- <!--blogs  --> --}}

@endsection

@push('css')
<style>
    /* Category Count Badge */
    .category-count {
        margin: 8px 0;
    }

    .count-badge {
        display: inline-block;
        background: rgba(223, 138, 57, 0.1);
        color: #DF8A39;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid rgba(223, 138, 57, 0.3);
        transition: all 0.3s ease;
    }

    .course-item-11:hover .count-badge {
        background: #DF8A39;
        color: #fff;
        border-color: #DF8A39;
        transform: scale(1.05);
    }
</style>
@endpush
