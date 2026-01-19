@extends('frontend.layouts.master')
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
                <h1 class="title">Events</h1>
                <h4 class="sub-title"><a class="home" href="{{ route('frontend.home') }}">Home </a><span
                        class="icon">/</span><a class="inner-page" href="{{ route('frontend.events') }}"> Events</a></h4>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="features-event pt-5 pb-120">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
         
            @if ($events->count() > 0)
                <div class="row gy-4 justify-content-center">
                    @foreach ($events as $index => $event)
                        <div class="col-lg-4 col-md-6">
                            <div class="event-item wow fade-in-bottom" data-wow-delay="{{ 400 + ($index % 3) * 100 }}ms">
                                <div class="event-thumb">
                                    @if ($event->image)
                                        <img src="{{ asset('uploads/events/' . $event->image) }}" alt="{{ $event->name }}"
                                            style="width: 100%; height: 250px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('assets/frontend/img/images/event-img-1.png') }}"
                                            alt="{{ $event->name }}"
                                            style="width: 100%; height: 250px; object-fit: cover;">
                                    @endif
                                    <div class="date-wrap">
                                        <h5 class="date">{{ $event->start_date->format('d') }}
                                            <span>{{ $event->start_date->format('M') }}</span></h5>
                                    </div>
                                </div>
                                <div class="event-content">
                                    @if ($event->time)
                                        <span class="time"><i class="fa-regular fa-clock"></i> {{ $event->time }}</span>
                                    @endif
                                    <h3 class="title">
                                        <a
                                            href="{{ route('frontend.event.details', ['slug' => $event->slug]) }}">{{ $event->name }}</a>
                                    </h3>
                                    @if ($event->short_description)
                                        <p>{{ Str::limit($event->short_description, 100) }}</p>
                                    @endif
                                    @if ($event->location)
                                        <div class="location">
                                            <span><i class="fa-regular fa-location-dot"></i> {{ $event->location }}</span>
                                        </div>
                                    @endif
                                    <div class="d-flex gap-2 mt-3">
                                        <a href="{{ route('frontend.event.details', ['slug' => $event->slug]) }}"
                                            class="ed-primary-btn">View Details</a>
                                        <a href="{{ route('frontend.event.booking', ['slug' => $event->slug]) }}"
                                            class="ed-primary-btn text-white orange-btn">
                                            Book Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="row mt-5">
                    <div class="col-12">
                        <nav aria-label="Events pagination">
                            {{ $events->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                </div>
            @else
                <div class="alert alert-info text-center">
                    <p class="mb-0">No events available at the moment.</p>
                </div>
            @endif
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
