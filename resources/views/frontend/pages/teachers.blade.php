@extends('frontend.layouts.master')
@section('title', 'Teachers')
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
                <h1 class="title">Our Teachers</h1>
                <h4 class="sub-title"><a class="home" href="{{ route('frontend.home') }}">Home </a><span
                        class="icon">/</span><a class="inner-page" href="javascript:void(0)"> Our Teachers</a></h4>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <!--  team  -->
    <section class="team-section pt-120 pb-120">
        <div class="container">
            <div class="section-heading text-center">
                <h4 class="sub-heading wow fade-in-bottom" data-wow-delay="200ms"><span class="heading-icon"><i
                            class="fa-sharp fa-solid fa-bolt"></i></span>Our Instructors</h4>
                <h2 class="section-title wow fade-in-bottom" data-wow-delay="400ms">Meet Our Expert Instructors</h2>
            </div>
            <div class="row gy-lg-0 gy-4">
                @forelse($teachers as $teacher)
                    <div class="col-lg-3 col-md-6 mt-3">
                        <div class="team-item-3 wow fade-in-bottom" data-wow-delay="200ms">
                            <a href="{{ route('frontend.teacher.details', $teacher->slug) }}">
                                <div class="team-thumb-wrap">
                                    <div class="team-thumb">
                                        @if ($teacher->image)
                                            <img src="{{ asset('uploads/teachers/' . $teacher->image) }}"
                                                alt="{{ $teacher->name }}">
                                        @else
                                            <img src="{{ asset('assets/frontend/img/team/team-9.png') }}"
                                                alt="{{ $teacher->name }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="team-content">
                                    <h3 class="title"><a
                                            href="{{ route('frontend.teacher.details', $teacher->slug) }}">{{ $teacher->name }}</a>
                                    </h3>
                                    @if ($teacher->short_description)
                                        <span>{!! $teacher->short_description !!}</span>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <p class="text-muted">No teachers found.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($teachers->hasPages())
                <div class="mt-5">
                    {{ $teachers->links() }}
                </div>
            @endif
        </div>
    </section>
    <!--  team  -->
@endsection
