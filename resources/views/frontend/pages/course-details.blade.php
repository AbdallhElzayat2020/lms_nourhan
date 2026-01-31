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
                <h1 class="title">{{ $course->title }}</h1>

                <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                <a class="inner-page" href="{{ route('frontend.courses') }}"> Courses</a><span class="icon">/</span>
                <span>{{ Str::limit($course->title, 30) }}</span>

            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="page-course-details course-details pt-120 pb-120">
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
                                            <div class="book-now-btn">
                                                <a href="{{ route('frontend.book') }}" class="ed-primary-btn">Book Now</a>
                                            </div>
                                        @endif
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
                                            <div class="book-now-btn">
                                                <a href="{{ route('frontend.book') }}" class="ed-primary-btn">Book Now</a>
                                            </div>
                                        @endif

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
        /* Scoped to page-course-details only - do not affect other pages */
        /* Course Image Styles */
        .page-course-details .course-images-slider {
            margin-bottom: 50px;
        }

        .page-course-details .course-slide-img {
            width: 100%;
            height: 500px;
            overflow: hidden;
            border-radius: 15px;
        }

        .page-course-details .course-slide-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Course Header Info */
        .page-course-details .course-header-info {
            margin-bottom: 50px;
        }

        .page-course-details .course-meta-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .page-course-details .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--ed-color-text-body);
        }

        .page-course-details .meta-item i {
            color: var(--ed-color-theme-primary);
            font-size: 18px;
        }

        .page-course-details .meta-item strong {
            color: var(--ed-color-heading-primary);
            font-weight: 600;
        }

        /* Course Info Card */
        .page-course-details .course-info-card {
            background: var(--ed-color-common-white);
            border: 1px solid var(--ed-color-border-1);
            border-radius: 15px;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .page-course-details .info-card {
            display: flex;
            align-items: center;
            gap: 0;
            flex: 1;
        }

        .page-course-details .info-item {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
        }

        .page-course-details .info-item i {
            font-size: 24px;
            color: var(--ed-color-theme-primary);
            width: 40px;
            text-align: center;
        }

        .page-course-details .info-item .label {
            display: block;
            font-size: 14px;
            color: var(--ed-color-text-body);
            margin-bottom: 5px;
        }

        .page-course-details .info-item .value {
            display: block;
            font-size: 18px;
            font-weight: 600;
            color: var(--ed-color-heading-primary);
        }

        .page-course-details .info-divider {
            width: 1px;
            height: 50px;
            background: var(--ed-color-border-1);
            margin: 0 20px;
        }

        .page-course-details .book-now-btn {
            flex-shrink: 0;
        }

        @media (max-width: 991px) {
            .page-course-details .course-info-card {
                flex-direction: column;
            }

            .page-course-details .info-card {
                width: 100%;
                flex-direction: column;
                gap: 20px;
            }

            .page-course-details .info-divider {
                display: none;
            }

            .page-course-details .info-item {
                width: 100%;
                justify-content: space-between;
                padding: 15px;
                background: var(--ed-color-grey-1);
                border-radius: 10px;
            }
        }

        /* Course Sections */
        .page-course-details .course-content-sections {
            margin-top: 50px;
        }

        .page-course-details .course-section {
            margin-bottom: 60px;
        }

        .page-course-details .section-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--ed-color-heading-primary);
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--ed-color-border-1);
        }

        .page-course-details .section-content {
            color: var(--ed-color-text-body);
            line-height: 1.8;
        }

        .page-course-details .section-content p {
            margin-bottom: 20px;
        }

        /* Section Image Wrapper */
        .page-course-details .section-img-wrapper {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .page-course-details .section-img-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
        }

        .page-course-details .section-img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 15px;
        }

        .page-course-details .section-text {
            padding: 20px 0;
        }

        .page-course-details .section-text p {
            margin-bottom: 20px;
            text-align: left;
        }

        /* Same list/li formatting as blog - match dashboard editor */
        .page-course-details .section-text ul,
        .page-course-details .section-text ol {
            list-style-position: outside;
            padding-left: 2em;
            margin: 1em 0;
        }

        .page-course-details .section-text ul {
            list-style-type: disc;
        }

        .page-course-details .section-text ol {
            list-style-type: decimal;
        }

        .page-course-details .section-text li {
            display: list-item;
            margin-bottom: 0.5em;
            margin-top: 0;
            padding-left: 0;
            font-size: inherit;
            font-weight: inherit;
            color: inherit;
            line-height: inherit;
            text-transform: none;
            white-space: normal;
            text-align: left;
        }

        .page-course-details .section-text li::before {
            display: none !important;
            content: none !important;
        }

        .page-course-details .section-text ul li::marker,
        .page-course-details .section-text ol li::marker {
            color: inherit;
        }

        .page-course-details .section-text h1,
        .page-course-details .section-text h2,
        .page-course-details .section-text h3,
        .page-course-details .section-text h4,
        .page-course-details .section-text h5,
        .page-course-details .section-text h6 {
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .page-course-details .section-text img {
            margin: 25px 0;
            border-radius: 8px;
        }

        .page-course-details .section-text blockquote {
            margin: 30px 0;
            padding: 20px 30px;
            background: #f8f9fa;
            border-left: 4px solid var(--ed-color-theme-primary, #0f4d46);
            border-radius: 8px;
        }

        @media (max-width: 991px) {
            .page-course-details .section-img-wrapper {
                margin-bottom: 30px;
            }
        }

        /* FAQ: remove extra margins from accordion headers (this page only) */
        .page-course-details .section-text .accordion .accordion-header,
        .page-course-details .section-text .accordion .accordion-header h2 {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        /* FAQ Accordion - compact & clean */
        .page-course-details #faqAccordion.accordion {
            --bs-accordion-border-width: 0;
            --bs-accordion-btn-focus-box-shadow: none;
        }

        .page-course-details .course-section .accordion-item {
            border: 1px solid #e5e7eb;
            border-radius: 10px !important;
            margin-bottom: 10px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        .page-course-details .course-section .accordion-button {
            background: #fff !important;
            color: #1f2937;
            font-weight: 500;
            border: none;
            box-shadow: none;
            padding: 14px 52px 14px 18px;
            font-size: 15px;
            line-height: 1.45;
            min-height: auto;
        }

        .page-course-details .course-section .accordion-button::after {
            width: 28px;
            height: 28px;
            background-size: 14px;
            border-radius: 50%;
            background-color: #f3f4f6;
            background-position: center;
            margin-left: auto;
            flex-shrink: 0;
        }

        .page-course-details .course-section .accordion-button:not(.collapsed) {
            background: #fff !important;
            color: var(--ed-color-theme-primary, #0f4d46);
            border-bottom: 1px solid #e5e7eb;
        }

        .page-course-details .course-section .accordion-button:not(.collapsed)::after {
            background-color: var(--ed-color-theme-primary, #0f4d46);
            filter: brightness(0) invert(1);
        }

        .page-course-details .course-section .accordion-button:focus {
            box-shadow: none;
        }

        .page-course-details .course-section .accordion-body {
            background: #fafafa;
            color: #374151;
            padding: 16px 18px;
            font-size: 14px;
            line-height: 1.65;
        }

        .page-course-details .course-section .accordion-body p {
            margin-bottom: 0.5em;
        }

        .page-course-details .course-section .accordion-body p:last-child {
            margin-bottom: 0;
        }
    </style>
@endpush
