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
                <h1 class="title">About Us</h1>
                <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                <a class="inner-page" href="javascript:void(0)"> About Us</a>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <!-- about section (same dynamic content as home \"من نحن\") -->
    @if(isset($aboutSection) && $aboutSection)
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
                                @if($aboutSection->video_url)
                                    <iframe style="position: absolute; top: 0; border-radius: 10px; left: 0; width: 100%; height: 100%; border: 0;"
                                            src="{{ $aboutSection->embed_video_url_with_autoplay }}"
                                            title="About video"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                    </iframe>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="about-content-3">
                            <div class="section-heading mb-20">
                                @if($aboutSection->subtitle)
                                    <h4 class="sub-heading wow fade-in-bottom" data-wow-delay="300ms">
                                        <span class="heading-icon"><i class="fa-sharp fa-solid fa-bolt"></i></span>
                                        {{ $aboutSection->subtitle }}
                                    </h4>
                                @endif
                                <h2 class="section-title wow fade-in-bottom" data-wow-delay="400ms">
                                    {!! nl2br(e($aboutSection->title)) !!}
                                </h2>
                            </div>
                            @if($aboutSection->description)
                                <p class="mb-30 wow fade-in-bottom" data-wow-delay="500ms">
                                    {{ $aboutSection->description }}
                                </p>
                            @endif
                            @if($aboutSection->button_text && $aboutSection->button_link)
                                <div class="about-btn wow fade-in-bottom" data-wow-delay="600ms">
                                    <a href="{{ $aboutSection->button_link }}" class="ed-primary-btn">
                                        {{ $aboutSection->button_text }}
                                        <i class="fa-regular fa-arrow-right"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- ./ about section -->

    <section class="history-mission-vision-section pt-120 pb-120">
        <style>
            .hmv-card {
                background: var(--ed-color-common-white, #ffffff);
                border-radius: 20px;
                padding: 40px 35px;
                height: 100%;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
                border: 1px solid var(--ed-color-border-1, #E0E5EB);
                position: relative;
                overflow: hidden;
            }

            .hmv-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 4px;
                background: var(--ed-color-theme-primary, #006D64);
                transform: scaleX(0);
                transform-origin: left;
                transition: transform 0.4s ease;
            }

            .hmv-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 40px rgba(0, 109, 100, 0.15);
                border-color: rgba(0, 109, 100, 0.2);
            }

            .hmv-card:hover::before {
                transform: scaleX(1);
            }

            .hmv-card .icon-wrapper {
                margin-bottom: 25px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .hmv-card .icon {
                width: 80px;
                height: 80px;
                background: var(--ed-color-theme-primary, #006D64);
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 32px;
                color: var(--ed-color-common-white, #ffffff);
                box-shadow: 0 8px 20px rgba(0, 109, 100, 0.3);
                transition: all 0.4s ease;
                position: relative;
                overflow: hidden;
            }

            .hmv-card .icon::after {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                width: 0;
                height: 0;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.3);
                transform: translate(-50%, -50%);
                transition: width 0.6s, height 0.6s;
            }

            .hmv-card:hover .icon {
                transform: rotateY(360deg) scale(1.1);
                box-shadow: 0 12px 30px rgba(0, 109, 100, 0.4);
                background: linear-gradient(135deg, #006D64 0%, #004d47 100%);
            }

            .hmv-card:hover .icon::after {
                width: 200px;
                height: 200px;
            }

            .hmv-card:nth-child(1) .icon {
                background: var(--ed-color-theme-primary, #006D64);
            }

            .hmv-card:nth-child(2) .icon {
                background: linear-gradient(135deg, #006D64 0%, #008a7f 100%);
            }

            .hmv-card:nth-child(3) .icon {
                background: linear-gradient(135deg, #006D64 0%, #004d47 100%);
            }

            .hmv-card .content {
                text-align: center;
            }

            .hmv-card .title {
                font-size: 24px;
                font-weight: 700;
                color: var(--ed-color-heading-primary, #162726);
                margin-bottom: 18px;
                letter-spacing: 0.5px;
                transition: color 0.3s ease;
            }

            .hmv-card:hover .title {
                color: var(--ed-color-theme-primary, #006D64);
            }

            .hmv-card p {
                font-size: 15px;
                line-height: 1.8;
                color: var(--ed-color-text-body, #6C706F);
                margin: 0;
                transition: color 0.3s ease;
            }

            .hmv-card:hover p {
                color: var(--ed-color-heading-primary, #162726);
            }

            @media (max-width: 991px) {
                .hmv-card {
                    padding: 35px 30px;
                    margin-bottom: 30px;
                }

                .hmv-card .icon {
                    width: 70px;
                    height: 70px;
                    font-size: 28px;
                }

                .hmv-card .title {
                    font-size: 22px;
                }
            }

            @media (max-width: 767px) {
                .hmv-card {
                    padding: 30px 25px;
                }

                .hmv-card .icon {
                    width: 65px;
                    height: 65px;
                    font-size: 26px;
                }

                .hmv-card .title {
                    font-size: 20px;
                }

                .hmv-card p {
                    font-size: 14px;
                }
            }
        </style>
        <div class="container">
            <div class="row gy-5">
                @if(isset($aboutInfos) && $aboutInfos->count() > 0)
                    @foreach($aboutInfos as $info)
                        <div class="col-lg-4 col-md-6">
                            <div class="hmv-card">
                                <div class="icon-wrapper">
                                    <div class="icon">
                                        @if($info->icon_class)
                                            <i class="{{ $info->icon_class }}"></i>
                                        @else
                                            <i class="fa-sharp fa-solid fa-bolt"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="content">
                                    <h3 class="title">{{ $info->title }}</h3>
                                    <p>{{ $info->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- ./ team-section -->
    @if(isset($counters) && $counters->count() > 0)
    <section class="counter-section">
        <div class="container">
            <div class="row counter-wrap gy-lg-0 gy-5">
                @foreach($counters as $index => $counter)
                    <div class="col-lg-3 col-md-6">
                        <div class="counter-item {{ $index === 0 ? 'item-1' : ($index === 3 ? 'item-4' : '') }} white-content">
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
    <!-- ./ counter-section -->

    <!-- ./ testimonial -->
    @if ($testimonials->count() > 0)
        <section class="testimonial-section-2 py-5">
            <div class="container">
                <div class="section-heading text-center">
                    <h4 class="sub-heading wow fade-in-bottom" data-wow-delay="200ms"><span class="heading-icon"><i
                                class="fa-sharp fa-solid fa-bolt"></i></span>Our Testimonials</h4>
                    <h2 class="section-title wow fade-in-bottom" data-wow-delay="400ms">Feedback’s From Our Student</h2>
                </div>
                <div class="testi-carousel swiper">
                    <div class="swiper-wrapper">
                        @foreach ($testimonials as $testimonial)
                            @php
                                // Choose avatar by gender; default to male if not set
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
                                            <img src="{{ asset($avatarPath) }}" alt="{{ $testimonial->name }}" style="object-fit: cover; width: 60px; height: 60px; border-radius: 50%;">
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
    <!-- ./ testimonial -->

    <!-- ./ sponsor (partners) -->
    @if($partners->count() > 0)
    <div class="sponsor-section pb-120 bg-grey">
        <div class="shapes">
            <div class="bg-shape"><img src="{{ asset('assets/frontend/img/shapes/sponsor-shape.png') }}" alt="shape"></div>
            <div class="shape shape-1"><img src="{{ asset('assets/frontend/img/shapes/sponsor-1.png') }}" alt="shape"></div>
            <div class="shape shape-2"><img src="{{ asset('assets/frontend/img/shapes/sponsor-2.png') }}" alt="shape"></div>
        </div>
        <div class="container">
            <div class="row gy-4 justify-content-center">
                @foreach($partners as $partner)
                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                        <div class="sponsor-item text-center"
                             style="background:#fff;border-radius:16px;padding:20px 15px;box-shadow:0 8px 20px rgba(0,0,0,0.05);">
                            @php
                                $logoUrl = $partner->logo ? asset('uploads/partners/' . $partner->logo) : null;
                            @endphp
                            @if($partner->link)
                                <a href="{{ $partner->link }}" target="_blank" rel="noopener">
                                    @if($logoUrl)
                                        <img src="{{ $logoUrl }}" alt="{{ $partner->name }}"
                                             style="max-width:100%;height:60px;object-fit:contain;">
                                    @else
                                        <span>{{ $partner->name }}</span>
                                    @endif
                                </a>
                            @else
                                @if($logoUrl)
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
    <!-- ./ sponsor (partners) -->

@endsection
