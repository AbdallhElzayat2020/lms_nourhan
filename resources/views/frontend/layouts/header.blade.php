<!-- header-area-start -->
<header class="header header-3 header-6 header-7 sticky-active">
 @include('frontend.layouts.topnav')
    <div class="primary-header">
        <div class="container">
            <div class="primary-header-inner">
                <div class="header-logo d-lg-block">
                    <a href="{{ route('frontend.home') }}">
                        <img src="{{ asset('assets/frontend/img/logo_horezntal.webp') }}" alt="Logo">
                    </a>
                </div>
                <div class="header-menu-wrap">
                    <div class="mobile-menu-items">
                        <ul class="sub-menu">
                            <li class="menu-item-has-children active mega-menu">
                                <a href="{{ route('frontend.home') }}">Home</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="javascript:void(0)">About <i class="fa-solid fa-chevron-down"></i></a>
                                <ul>
                                    <li><a href="{{ route('frontend.about') }}">AboutUs</a></li>
                                    <li><a href="{{ route('frontend.teachers') }}">Teachers</a></li>
                                    <li><a href="{{ route('frontend.course-feedbacks') }}">Testimonials</a></li>
                                    <li><a href="{{ route('frontend.events') }}">Events</a></li>
                                </ul>
                            </li>
                            @isset($navCourseCategories)
                                @foreach ($navCourseCategories as $navCategory)
                                    <li class="menu-item-has-children">
                                        <a href="{{ route('frontend.courses', ['category' => $navCategory->slug]) }}">
                                            {{ $navCategory->name }} <i class="fa-solid fa-chevron-down"></i>
                                        </a>
                                        @if ($navCategory->courses->isNotEmpty())
                                            <ul>
                                                @foreach ($navCategory->courses->take(6) as $navCourse)
                                                    <li>
                                                        <a href="{{ route('frontend.course.details', $navCourse->slug) }}">
                                                            {{ $navCourse->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @endisset

                            <li class="menu-item-has-children">
                                <a href="{{ route('frontend.blog') }}">Blog</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('frontend.pricing') }}">Pricing</a>
                            </li>
                            <li><a href="{{ route('frontend.contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.header-menu-wrap -->
                <div class="header-right-wrap">
                    <div class="header-right">
                        {{-- <a href="{{ route('frontend.book') }}" class="ed-primary-btn header-btn">Book Now</a> --}}
                        <div class="header-logo d-none d-lg-none">
                            <a href="{{ route('frontend.home') }}">
                                <img src="{{ asset('assets/frontend/img/logo_horezntal.webp') }}" alt="Logo">
                            </a>
                        </div>
                        <div class="header-right-item d-lg-none d-md-block">
                            <a href="javascript:void(0)" class="mobile-side-menu-toggle"><i
                                    class="fa-sharp fa-solid fa-bars"></i></a>
                        </div>
                    </div>
                    <!-- /.header-right -->
                </div>
            </div>
            <!-- /.primary-header-inner -->
        </div>
    </div>
</header>
<!-- /.Main Header -->

<div id="popup-search-box">
    <div class="box-inner-wrap d-flex align-items-center">
        <form id="form" action="#" method="get" role="search">
            <input id="popup-search" type="text" name="s" placeholder="Type keywords here...">
        </form>
        <div class="search-close"><i class="fa-sharp fa-regular fa-xmark"></i></div>
    </div>
</div>
<!-- /#popup-search-box -->

<div class="mobile-side-menu">
    <div class="side-menu-content">
        <div class="side-menu-head">
            <a href="{{ route('frontend.home') }}"><img src="{{ asset('assets/frontend/img/logo_horezntal.webp') }}" alt="logo"></a>
            <button class="mobile-side-menu-close"><i class="fa-regular fa-xmark"></i></button>
        </div>
        <div class="side-menu-wrap"></div>
        <ul class="side-menu-list">
            <li><i class="fa-light fa-phone"></i>Phone : <a href="tel:+201065537718">+20 10 65537718</a></li>
            <li><i class="fa-light fa-envelope"></i>Email : <a href="mailto:info@example.com">info@example.com</a></li>
        </ul>
    </div>
</div>
<!-- /.mobile-side-menu -->
<div class="mobile-side-menu-overlay"></div>

<div id="preloader">
    <div style="width: 200px; height: 200px;" class="spinner-logo"><img src="{{ asset('assets/frontend/img/logo_horezntal.webp') }}" alt="logo"></div>
    {{-- <div class="spinner"></div> --}}
</div>
<!-- ./ preloader -->
