@extends('frontend.layouts.master')
@section('title', $event->name)
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
                <h1 class="title">{{ $event->name }}</h1>
                <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                <a class="inner-page" href="{{ route('frontend.events') }}"> Events</a><span class="icon">/</span>
                <span>{{ $event->name }}</span>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="event-details pt-120 pb-120">
        <div class="container">
            <div class="row gy-xl-0 gy-5">
                <div class="col-lg-8 col-md-12">
                    <div class="event-details-content">
                        <div class="event-details-img">
                            @if($event->image)
                                <img src="{{ asset('uploads/events/' . $event->image) }}" alt="{{ $event->name }}" style="width: 100%; height: 400px; object-fit: cover;">
                            @else
                                <img src="{{ asset('assets/frontend/img/images/event-details.png') }}" alt="{{ $event->name }}" style="width: 100%; height: 400px; object-fit: cover;">
                            @endif
                        </div>
                        <h2 class="title">Event Overview</h2>
                        @if($event->description)
                            <div class="mb-30">
                                {!! nl2br(e(strip_tags($event->description))) !!}
                            </div>
                        @elseif($event->short_description)
                            <p class="mb-30">{{ $event->short_description }}</p>
                        @endif

                        @if($event->google_map_link)
                            <h2 class="title">Check Live Map</h2>
                            <div class="event-map-wrapper">
                                @if(str_contains($event->google_map_link, 'embed'))
                                    <iframe src="{{ $event->google_map_link }}" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                                @else
                                    <a href="{{ $event->google_map_link }}" target="_blank" class="ed-primary-btn orange-btn">
                                        <i class="fa-regular fa-map"></i> View on Google Maps
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    {{-- <div class="course-sidebar price-box event-sidebar">

                    </div> --}}
                    <div class="course-sidebar event-sidebar sticky-widget">
                        <h4 class="sidebar-title">Event Information</h4>
                        <ul class="course-sidebar-list">

                            <li><i class="fa-light fa-calendar-days"></i>Start Date: <span>{{ $event->start_date->format('M d, Y') }}</span></li>
                            @if($event->end_date)
                                <li><i class="fa-light fa-calendar-days"></i>End Date: <span>{{ $event->end_date->format('M d, Y') }}</span></li>
                            @endif
                            @if($event->time)
                                <li><i class="fa-regular fa-clock"></i>Time: <span>{{ $event->time }}</span></li>
                            @endif
                            @if($event->location)
                                <li><i class="fa-regular fa-location-dot"></i>Location: <span>{{ $event->location }}</span></li>
                            @endif
                            @if($event->phone)
                                <li><i class="fa-regular fa-phone"></i>Phone: <span><a href="tel:{{ $event->phone }}">{{ $event->phone }}</a></span></li>
                            @endif
                            <li>
                                <a href="{{ route('frontend.event.booking', ['slug' => $event->slug]) }}" class="ed-primary-btn buy-btn">Book
                                    Now</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
<style>
    .ed-primary-btn.orange-btn {
        background: #DF8A39 !important;
    }

    .ed-primary-btn.orange-btn:before {
        background: rgba(255, 255, 255, 0.2) !important;
    }

    .ed-primary-btn.orange-btn:hover {
        background: #DF8A39 !important;
        opacity: 0.9;
    }

    .ed-primary-btn.orange-btn:hover:before {
        background: rgba(255, 255, 255, 0.3) !important;
    }
</style>
@endpush
