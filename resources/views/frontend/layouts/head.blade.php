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

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/img/favicon.png') }}">
    @stack('css')
    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/venobox.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/keyframe-animation.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/odometer.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/main.css')}}">

    <!-- Floating Buttons + Scroll Top CSS -->
    <style>
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
            z-index: 9999;
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
    </style>

    <!-- SEO Schema Markup -->
    @if(isset($seoPageName))
        @seoSchema($seoPageName)
    @elseif(isset($dynamicSeoModel))
        @dynamicSeoSchema($dynamicSeoModel)
    @endif
</head>
