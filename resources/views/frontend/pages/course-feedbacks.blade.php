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
                <h1 class="title">Testimonials</h1>
                <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                <a class="inner-page" href="javascript:void(0)">Testimonials</a>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="video-feature-section pb-120 pt-5">
        <div class="container">
            <div class="section-heading text-center">
                <h4 class="sub-heading wow fade-in-bottom" data-wow-delay="200ms"><span class="heading-icon"><i
                            class="fa-sharp fa-solid fa-bolt"></i></span>Testimonials</h4>
                <h2 class="section-title wow fade-in-bottom" data-wow-delay="400ms">Founded by Industry Leaders With
                    <br>Testimonials from our students
                </h2>
            </div>
            @if($feedbacks->count() > 0)
                <div class="row gy-md-0 gy-4">
                    @foreach($feedbacks as $index => $feedback)
                        <div class="col-md-6">
                            <div class="video-feature text-center wow fade-in-bottom" data-wow-delay="{{ 400 + ($index % 2) * 100 }}ms">
                                <div class="video-thumb">
                                    @if($feedback->image)
                                        <img src="{{ asset('uploads/course-feedbacks/' . $feedback->image) }}" alt="{{ $feedback->title }}" style="width: 100%; height: 300px; object-fit: cover; border-radius: 10px;">
                                    @else
                                        <img src="{{ asset('assets/frontend/img/images/video-img-1.png') }}" alt="{{ $feedback->title }}" style="width: 100%; height: 300px; object-fit: cover; border-radius: 10px;">
                                    @endif
                                    @if($feedback->video_url)
                                        <div class="video-btn">
                                            <a class="video-popup venobox" data-autoplay="true" data-vbtype="video"
                                                href="{{ $feedback->video_url }}">
                                                <div class="play-btn">
                                                    <i class="fa-sharp fa-solid fa-play"></i>
                                                </div>
                                                <div class="ripple"></div>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div class="video-content">
                                    <h3 class="title">{{ $feedback->title }}</h3>
                                    @if($feedback->description)
                                        <p>{{ $feedback->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <p class="text-muted">No testimonials available at the moment.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
