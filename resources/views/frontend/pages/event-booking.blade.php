@extends('frontend.layouts.master')
@section('title', 'Book Event - ' . $event->name)
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
                <h1 class="title">Book Event</h1>
                <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                <a class="inner-page" href="{{ route('frontend.events') }}"> Events</a><span class="icon">/</span>
                <span>Book Event</span>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="contact-section pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="blog-contact-form contact-form">
                        <h2 class="title mb-0">Book Event: {{ $event->name }}</h2>
                        <p class="mb-30 mt-10">Please fill out the form below to book your spot for this event</p>

                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Event Details</h5>
                                <ul class="list-unstyled mb-0">
                                    <li><strong>Date:</strong> {{ $event->start_date->format('M d, Y') }}@if($event->end_date) - {{ $event->end_date->format('M d, Y') }}@endif</li>
                                    @if($event->time)
                                        <li><strong>Time:</strong> {{ $event->time }}</li>
                                    @endif
                                    @if($event->location)
                                        <li><strong>Location:</strong> {{ $event->location }}</li>
                                    @endif
                                    @if($event->phone)
                                        <li><strong>Contact:</strong> <a href="tel:{{ $event->phone }}">{{ $event->phone }}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="request-form">
                            <form action="{{ route('frontend.event.booking.store', ['slug' => $event->slug]) }}" method="post" class="form-horizontal">
                                @csrf

                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                                   placeholder="Your Name" value="{{ old('name') }}" required>
                                            <div class="icon"><i class="fa-regular fa-user"></i></div>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="Your Email" value="{{ old('email') }}" required>
                                            <div class="icon"><i class="fa-sharp fa-regular fa-envelope"></i></div>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                                   placeholder="Phone Number" value="{{ old('phone') }}" required>
                                            <div class="icon"><i class="fa-sharp fa-solid fa-phone"></i></div>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item message-item">
                                            <textarea id="notes" name="notes" cols="30" rows="5"
                                                      class="form-control address @error('notes') is-invalid @enderror" placeholder="Notes (Optional)">{{ old('notes') }}</textarea>
                                            <div class="icon"><i class="fa-light fa-messages"></i></div>
                                            @error('notes')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="submit-btn">
                                    <div class="d-flex gap-3 flex-wrap justify-content-center">
                                        <button type="submit" class="ed-primary-btn">
                                            <i class="fa-regular fa-calendar-check me-1"></i>
                                            Submit Booking
                                        </button>
                                        <a href="{{ route('frontend.event.details', ['slug' => $event->slug]) }}" class="ed-primary-btn" style="background: #6c757d;">
                                            <i class="fa-regular fa-arrow-left me-1"></i>
                                            Back to Event
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ contact-section -->
@endsection
