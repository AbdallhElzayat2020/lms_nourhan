<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- SEO Meta Tags -->
    @if(isset($seoPageName))
        @seoMeta($seoPageName)
    @elseif(isset($dynamicSeoModel))
        @dynamicSeoMeta($dynamicSeoModel)
    @else
        <title>@yield('title', config('app.name'))</title>
        <meta name="description" content="@yield('description', 'Nourhan Academy - English Learning & Travel Services')">
    @endif

    <!-- Noindex for search pages -->
    @if(isset($noindex) && $noindex)
        <meta name="robots" content="noindex, nofollow">
    @endif

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/img/favicon.png') }}">

    <!-- Resource Hints for Faster Navigation -->
    <link rel="dns-prefetch" href="{{ url('/') }}">
    <link rel="preconnect" href="{{ url('/') }}" crossorigin>

    <!-- Prefetch common pages for faster navigation -->
    <link rel="prefetch" href="{{ route('frontend.courses') }}">
    <link rel="prefetch" href="{{ route('frontend.blog') }}">
    <link rel="prefetch" href="{{ route('frontend.about') }}">
    <link rel="prefetch" href="{{ route('frontend.contact') }}">

    @stack('css')
    <!-- Critical CSS (load immediately) -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}">

    <!-- Non‑critical CSS (loaded asynchronously to reduce render‑blocking) -->
    <link rel="preload" href="{{ asset('assets/frontend/css/fontawesome.min.css') }}" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/frontend/css/fontawesome.min.css') }}"></noscript>

    <link rel="preload" href="{{ asset('assets/frontend/css/venobox.min.css') }}" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/frontend/css/venobox.min.css') }}"></noscript>

    <link rel="preload" href="{{ asset('assets/frontend/css/animate.min.css') }}" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.min.css') }}"></noscript>

    <link rel="preload" href="{{ asset('assets/frontend/css/keyframe-animation.css') }}" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/frontend/css/keyframe-animation.css') }}"></noscript>

    <link rel="preload" href="{{ asset('assets/frontend/css/odometer.min.css') }}" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/frontend/css/odometer.min.css') }}"></noscript>

    <link rel="preload" href="{{ asset('assets/frontend/css/nice-select.css') }}" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/frontend/css/nice-select.css') }}"></noscript>

    <link rel="preload" href="{{ asset('assets/frontend/css/daterangepicker.css') }}" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/frontend/css/daterangepicker.css') }}"></noscript>

    <link rel="preload" href="{{ asset('assets/frontend/css/swiper.min.css') }}" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/frontend/css/swiper.min.css') }}"></noscript>

    <!-- Floating Buttons + Scroll Top CSS -->
    <style>
        /* Optimized Preloader - Faster hide animation */
        #preloader {
            transition: opacity 0.15s ease-out, visibility 0.15s ease-out;
        }
        #preloader.fade-out {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .floating-buttons {
            position: fixed;
            bottom: 80px;
            left: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .floating-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 22px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .floating-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            color: #fff;
        }

        .floating-btn:active {
            transform: scale(0.95);
        }

        .whatsapp-btn {
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        }

        .call-btn {
            background: linear-gradient(135deg, #DF8A39 0%, #DF8A39 100%);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .floating-buttons {
                bottom: 70px;
                right: 15px;
            }

            .floating-btn {
                width: 46px;
                height: 46px;
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .floating-buttons {
                bottom: 60px;
                right: 10px;
            }

            .floating-btn {
                width: 42px;
                height: 42px;
                font-size: 18px;
            }
        }

        /* Scroll to top button */
        #scrollup {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 10001; /* فوق أزرار واتساب/الاتصال */
        }

        #scrollup.hide {
            opacity: 0;
            pointer-events: none;
        }

        #scrollup.show {
            opacity: 1;
        }

        #scroll-top.scroll-to-top {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: none;
            background: #0f4d46;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.16);
            transition: all 0.3s ease;
        }

        #scroll-top.scroll-to-top:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            #scrollup {
                bottom: 130px;
                right: 16px;
            }
        }
    </style>

    <!-- SEO Schema Markup -->
    @if(isset($seoPageName))
        @seoSchema($seoPageName)
    @elseif(isset($dynamicSeoModel))
        @dynamicSeoSchema($dynamicSeoModel)
    @endif
</head>
