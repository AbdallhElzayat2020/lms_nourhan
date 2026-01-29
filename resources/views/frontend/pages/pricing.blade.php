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
                <h1 class="title">Pricing</h1>
                <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                <a class="inner-page" href="{{ route('frontend.pricing') }}"> Pricing</a>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="pricing-section pt-120 pb-120">
        <div class="container">
                <div class="section-heading text-center">
                    <h4 class="sub-heading wow fade-in-bottom" data-wow-delay="200ms"><span class="heading-icon"><i
                                class="fa-sharp fa-solid fa-bolt"></i></span>Pricing Plans</h4>
                    <h2 class="section-title wow fade-in-bottom" data-wow-delay="400ms">Choose the best plan for you</h2>
                </div>
            <div class="tab-content wow fadeInUp" id="priceTabContent" data-wow-delay=".5s">
                <div class="tab-pane fade show active" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
                    @if ($pricingPlans->count() > 0)
                        <div class="row gy-lg-0 gy-4">
                            @foreach ($pricingPlans as $plan)
                                <div class="col-lg-4 col-md-6">
                                    <div class="pricing-item {{ $plan->is_featured ? 'active' : '' }}">
                                        <div class="pricing-top">
                                            <h4 class="title">{{ $plan->name }}</h4>
                                            <h3 class="price">${{ number_format($plan->price, 0) }} <span>{{ $plan->price_period }}</span></h3>
                                            @if ($plan->description)
                                                <p class="pricing-description">{{ $plan->description }}</p>
                                            @endif
                                        </div>
                                        @if ($plan->features && count($plan->features) > 0)
                                            <ul class="pricing-list">
                                                @foreach ($plan->features as $feature)
                                                    <li>
                                                        <i class="fa-sharp fa-solid fa-circle-check"></i>{{ $feature }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        <div class="pricing-btn">
                                            <a href="{{ route('frontend.book') }}" class="ed-primary-btn">Register Now <i
                                                    class="fa-light fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <p class="mb-0">No pricing plans available at the moment.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- ./ pricing-section -->
@endsection

@push('css')
<style>
    .pricing-item .pricing-top .pricing-description {
        word-wrap: break-word;
        word-break: break-word;
        overflow-wrap: break-word;
        white-space: normal;
        hyphens: auto;
    }
</style>
@endpush
