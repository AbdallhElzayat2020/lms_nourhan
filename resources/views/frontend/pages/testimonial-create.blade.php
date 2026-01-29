@extends('frontend.layouts.master')

@section('title', 'Share Your Testimonial')

@section('content')
    <section class="page-header">
        <div class="bg-item">
            <div class="bg-img" data-background="{{ asset('assets/frontend/img/banner_top.jpeg') }}"></div>
            <div class="overlay"></div>
            <div class="shapes">
                {{-- <div class="shape shape-1"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-1.png') }}" alt="shape"></div> --}}
                {{-- <div class="shape shape-2"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-2.png') }}" alt="shape"></div> --}}
                {{-- <div class="shape shape-3"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-3.png') }}" alt="shape"></div> --}}
            </div>
        </div>
        <div class="container">
            <div class="page-header-content text-center">
                <h1 class="title">Share Your Experience</h1>
                <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                <a class="inner-page" href="javascript:void(0)">Share Testimonial</a>
            </div>
        </div>
    </section>

    <section class="pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h2 class="section-title mb-2">We’d Love to Hear From You</h2>
                                <p class="mb-0 text-muted">Share your experience with Sister Nourhan Academy. Your feedback
                                    helps other students and inspires our community.</p>
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('frontend.testimonials.store') }}" method="POST" class="testimonial-form">
                                @csrf
                                <div class="row gy-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Full Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}"
                                            placeholder="Your Name" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="country" class="form-label">Country</label>
                                        <input type="text"
                                            class="form-control @error('country') is-invalid @enderror"
                                            id="country" name="country" value="{{ old('country') }}"
                                            placeholder="e.g., Egypt, Saudi Arabia">
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label d-block">Gender <span
                                                class="text-danger">*</span></label>
                                        <div class="d-flex gap-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="gender_male_public" value="male"
                                                    {{ old('gender', 'male') == 'male' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gender_male_public">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="gender_female_public" value="female"
                                                    {{ old('gender') == 'female' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gender_female_public">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                        @error('gender')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="description" class="form-label">Your Feedback / Notes <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                            id="description" name="description" rows="5"
                                            placeholder="Write your experience with the academy...">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="ed-primary-btn w-100 text-center">
                                            Submit Testimonial
                                            <i class="fa-regular fa-arrow-right ms-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .testimonial-form .form-control {
                border-radius: 12px;
                border-color: rgba(0, 0, 0, 0.05);
                padding: 0.75rem 1rem;
            }

            .testimonial-form .form-control:focus {
                box-shadow: 0 0 0 0.2rem rgba(0, 109, 100, 0.15);
                border-color: #006D64;
            }

            .testimonial-form .form-label {
                font-weight: 600;
                color: var(--ed-color-heading-primary, #162726);
            }
        </style>
    </section>
@endsection

