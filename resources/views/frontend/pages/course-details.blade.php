@extends('frontend.layouts.master')
@section('content')
    <section class="page-header">
        <div class="bg-item">
            <div class="bg-img" data-background="{{ asset('assets/frontend/img/banner_top.jpeg') }}"></div>
            <div class="overlay"></div>
            <div class="shapes">
                <div class="shape shape-1"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-1.png') }}"
                        alt="shape"></div>
                {{-- <div class="shape shape-2"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-2.png') }}"
                        alt="shape"></div> --}}
                {{-- <div class="shape shape-3"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-3.png') }}"
                        alt="shape"></div> --}}
            </div>
        </div>
        <div class="container">
            <div class="page-header-content">
                <h1 class="title">{{ $course->title }}</h1>

                    <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                    <a class="inner-page" href="{{ route('frontend.courses') }}"> Courses</a><span class="icon">/</span>
                    <span>{{ Str::limit($course->title, 30) }}</span>
              
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="course-details pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Course Image (Single Image - No Swiper) -->
                    @if ($course->banner_image)
                        <div class="course-images-slider mb-50">
                            <div class="course-slide-img">
                                <img src="{{ asset('uploads/courses/' . $course->banner_image) }}"
                                    alt="{{ $course->title }}">
                            </div>
                        </div>
                    @endif

                    <!-- Course Header Info -->
                    <div class="course-header-info mb-50">

                        @if ($course->subtitle)
                            <h4 class="subtitle mb-10" style="color: #DF8A39; font-weight: 600;">{{ $course->subtitle }}
                            </h4>
                        @endif
                        <div class="course-meta-info">
                            @if ($course->category)
                                <div class="meta-item">
                                    <i class="fa-solid fa-tags"></i>
                                    <span>Category: <strong>{{ $course->category->name }}</strong></span>
                                </div>
                            @endif
                        </div>

                    </div>

                    <!-- Course Content Sections -->
                    <div class="course-content-sections">
                        <!-- Description Section -->
                        @if ($course->description || $course->short_description)
                            <div class="course-section mb-60">
                                <div class="section-content">
                                    <div class="row align-items-center gy-4">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="section-text">
                                                @if ($course->description)
                                                    {!! $course->description !!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="book-now-btn">
                                        <a href="{{ route('frontend.book') }}" class="ed-primary-btn">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- About the Program Section -->
                        @if ($course->about_program_text || $course->about_program_image)
                            <div class="course-section mb-60">
                                <h3 class="section-title mb-30">About the Program</h3>
                                <div class="section-content">
                                    <div class="row align-items-center gy-4">
                                        @if ($course->about_program_text)
                                            <div
                                                class="{{ $course->about_program_image ? 'col-lg-7 col-md-6' : 'col-lg-12' }}">
                                                <div class="section-text">
                                                    {!! $course->about_program_text !!}
                                                </div>
                                            </div>
                                        @endif
                                        @if ($course->about_program_image)
                                            <div
                                                class="{{ $course->about_program_text ? 'col-lg-5 col-md-6' : 'col-lg-12' }}">
                                                <div class="section-img-wrapper">
                                                    <img src="{{ asset('uploads/courses/' . $course->about_program_image) }}"
                                                        alt="about program" class="section-img">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="book-now-btn">
                                        <a href="{{ route('frontend.book') }}" class="ed-primary-btn">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- How Course Works Section -->
                        @if ($course->how_course_works_text || $course->how_course_works_image)
                            <div class="course-section mb-60">
                                <h3 class="section-title mb-30">How Course Works</h3>
                                <div class="section-content">
                                    <div class="row align-items-center gy-4">
                                        @if ($course->how_course_works_image)
                                            <div
                                                class="{{ $course->how_course_works_text ? 'col-lg-5 col-md-6' : 'col-lg-12' }}">
                                                <div class="section-img-wrapper">
                                                    <img src="{{ asset('uploads/courses/' . $course->how_course_works_image) }}"
                                                        alt="how course works" class="section-img">
                                                </div>
                                            </div>
                                        @endif
                                        @if ($course->how_course_works_text)
                                            <div
                                                class="{{ $course->how_course_works_image ? 'col-lg-7 col-md-6' : 'col-lg-12' }}">
                                                <div class="section-text">
                                                    {!! $course->how_course_works_text !!}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="book-now-btn">
                                        <a href="{{ route('frontend.book') }}" class="ed-primary-btn">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- What You Will Achieve Section -->
                        @if ($course->what_you_achieve_text || $course->what_you_achieve_image)
                            <div class="course-section mb-60">
                                <h3 class="section-title mb-30">What You Will Achieve</h3>
                                <div class="section-content">
                                    <div class="row align-items-center gy-4">
                                        @if ($course->what_you_achieve_text)
                                            <div
                                                class="{{ $course->what_you_achieve_image ? 'col-lg-7 col-md-6' : 'col-lg-12' }}">
                                                <div class="section-text">
                                                    {!! $course->what_you_achieve_text !!}
                                                </div>
                                            </div>
                                        @endif
                                        @if ($course->what_you_achieve_image)
                                            <div
                                                class="{{ $course->what_you_achieve_text ? 'col-lg-5 col-md-6' : 'col-lg-12' }}">
                                                <div class="section-img-wrapper">
                                                    <img src="{{ asset('uploads/courses/' . $course->what_you_achieve_image) }}"
                                                        alt="achievements" class="section-img">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="book-now-btn">
                                        <a href="{{ route('frontend.book') }}" class="ed-primary-btn">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- FAQs Section -->
                        @if ($course->faqs->count() > 0)
                            <div class="course-section mb-60">
                                <h3 class="section-title mb-30">FAQ</h3>
                                <div class="section-content">
                                    <div class="row align-items-start gy-4">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="section-text">
                                                <div class="accordion" id="faqAccordion">
                                                    @foreach ($course->faqs as $index => $faq)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="faq{{ $faq->id }}">
                                                                <button
                                                                    class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#collapseFaq{{ $faq->id }}"
                                                                    aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                                    aria-controls="collapseFaq{{ $faq->id }}">
                                                                    {{ $faq->question }}
                                                                </button>
                                                            </h2>
                                                            <div id="collapseFaq{{ $faq->id }}"
                                                                class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                                                aria-labelledby="faq{{ $faq->id }}"
                                                                data-bs-parent="#faqAccordion">
                                                                <div class="accordion-body">
                                                                    {!! $faq->answer !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="book-now-btn">
                                        <a href="{{ route('frontend.book') }}" class="ed-primary-btn">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <style>
        /* Course Image Styles */
        .course-images-slider {
            margin-bottom: 50px;
        }

        .course-slide-img {
            width: 100%;
            height: 500px;
            overflow: hidden;
            border-radius: 15px;
        }

        .course-slide-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Course Header Info */
        .course-header-info {
            margin-bottom: 50px;
        }

        .course-meta-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--ed-color-text-body);
        }

        .meta-item i {
            color: var(--ed-color-theme-primary);
            font-size: 18px;
        }

        .meta-item strong {
            color: var(--ed-color-heading-primary);
            font-weight: 600;
        }

        /* Course Info Card */
        .course-info-card {
            background: var(--ed-color-common-white);
            border: 1px solid var(--ed-color-border-1);
            border-radius: 15px;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .info-card {
            display: flex;
            align-items: center;
            gap: 0;
            flex: 1;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
        }

        .info-item i {
            font-size: 24px;
            color: var(--ed-color-theme-primary);
            width: 40px;
            text-align: center;
        }

        .info-item .label {
            display: block;
            font-size: 14px;
            color: var(--ed-color-text-body);
            margin-bottom: 5px;
        }

        .info-item .value {
            display: block;
            font-size: 18px;
            font-weight: 600;
            color: var(--ed-color-heading-primary);
        }

        .info-divider {
            width: 1px;
            height: 50px;
            background: var(--ed-color-border-1);
            margin: 0 20px;
        }

        .book-now-btn {
            flex-shrink: 0;
        }

        @media (max-width: 991px) {
            .course-info-card {
                flex-direction: column;
            }

            .info-card {
                width: 100%;
                flex-direction: column;
                gap: 20px;
            }

            .info-divider {
                display: none;
            }

            .info-item {
                width: 100%;
                justify-content: space-between;
                padding: 15px;
                background: var(--ed-color-grey-1);
                border-radius: 10px;
            }
        }

        /* Course Sections */
        .course-content-sections {
            margin-top: 50px;
        }

        .course-section {
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--ed-color-heading-primary);
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--ed-color-border-1);
        }

        .section-content {
            color: var(--ed-color-text-body);
            line-height: 1.8;
        }

        .section-content p {
            margin-bottom: 20px;
        }

        /* Section Image Wrapper */
        .section-img-wrapper {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .section-img-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
        }

        .section-img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 15px;
        }

        .section-text {
            padding: 20px 0;
        }

        @media (max-width: 991px) {
            .section-img-wrapper {
                margin-bottom: 30px;
            }
        }

        /* FAQ Accordion */
        .accordion-item {
            border: 1px solid var(--ed-color-border-1);
            border-radius: 10px !important;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .accordion-button {
            background: var(--ed-color-grey-1);
            color: var(--ed-color-heading-primary);
            font-weight: 600;
            border: none;
            box-shadow: none;
        }

        .accordion-button:not(.collapsed) {
            background: var(--ed-color-theme-primary);
            color: var(--ed-color-common-white);
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-body {
            background: var(--ed-color-common-white);
            color: var(--ed-color-text-body);
        }
    </style>
@endpush
