@extends('frontend.layouts.master')
@section('title', 'Success Send')
@push('css')
        <style>
        .success-section {
            padding: 120px 0;
            text-align: center;
        }

        .success-content {
            max-width: 600px;
            margin: 0 auto;
            padding: 60px 40px;
            background-color: var(--ed-color-grey-1);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .success-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: scaleIn 0.5s ease-out;
        }

        .success-icon i {
            font-size: 60px;
            color: #fff;
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-title {
            font-size: 36px;
            font-weight: 700;
            color: var(--ed-color-heading-primary);
            margin-bottom: 20px;
        }

        .success-message {
            font-size: 18px;
            color: var(--ed-color-text-body);
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .success-actions {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .success-actions .ed-primary-btn {
            min-width: 180px;
        }

        @media (max-width: 768px) {
            .success-content {
                padding: 40px 30px;
            }

            .success-title {
                font-size: 28px;
            }

            .success-message {
                font-size: 16px;
            }

            .success-icon {
                width: 100px;
                height: 100px;
            }

            .success-icon i {
                font-size: 50px;
            }
        }
    </style>
@endpush
@section('content')
    <section class="page-header">
        <div class="bg-item">
            <div class="bg-img" data-background="{{ asset('assets/frontend/img/banner_top.jpeg') }}"></div>
            <div class="overlay"></div>
            <div class="shapes">
                <div class="shape shape-1"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-1.png') }}" alt="shape"></div>
                {{-- <div class="shape shape-2"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-2.png') }}" alt="shape"></div> --}}
                {{-- <div class="shape shape-3"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-3.png') }}" alt="shape"></div> --}}
            </div>
        </div>
        <div class="container">
            <div class="page-header-content">
                <h1 class="title">Success</h1>
                <h4 class="sub-title"><a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span><a
                        class="inner-page" href="{{ route('frontend.success.send') }}"> Success</a></h4>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="success-section">
        <div class="container">
            <div class="success-content">
                <div class="success-icon">
                    <i class="fa-sharp fa-solid fa-check"></i>
                </div>
                <h2 class="success-title">
                    @if(session('success'))
                        @php
                            $successMessage = session('success');
                            // Extract title from message (first sentence or first 50 chars)
                            $title = strlen($successMessage) > 60 ? substr($successMessage, 0, 60) . '...' : $successMessage;
                        @endphp
                        {{ $title }}
                    @else
                        Request Submitted Successfully!
                    @endif
                </h2>
                <p class="success-message">
                    @if(session('success'))
                        @php
                            $successMessage = session('success');
                            // If message is long, show it as description, otherwise show default
                            $description = strlen($successMessage) > 60 ? $successMessage : 'Thank you for your submission. We have received your information and will contact you shortly.';
                        @endphp
                        {{ $description }}
                    @else
                        Thank you for your request. We have received your information and will contact you shortly.
                    @endif
                </p>
                <div class="success-actions">
                    <a href="{{ route('frontend.home') }}" class="ed-primary-btn">Go to Home</a>
                    @php
                        $referer = request()->headers->get('referer');
                    @endphp
                    @if($referer)
                        @if(str_contains($referer, 'book'))
                            <a href="{{ route('frontend.book') }}" class="ed-primary-btn">Book Another Session</a>
                        @elseif(str_contains($referer, 'contact'))
                            <a href="{{ route('frontend.contact') }}" class="ed-primary-btn">Send Another Message</a>
                        @elseif(str_contains($referer, 'testimonials'))
                            <a href="{{ route('frontend.testimonials.create') }}" class="ed-primary-btn">Share Another Feedback</a>
                        @elseif(str_contains($referer, 'event-booking'))
                            <a href="{{ route('frontend.events') }}" class="ed-primary-btn">View More Events</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- ./ success-section -->
@endsection
