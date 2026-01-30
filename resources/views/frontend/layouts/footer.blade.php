<footer class="footer-section pt-120" id="footer-section"
    data-background="{{ asset('assets/frontend/img/bg-img/footer-bg.png') }}">
    <style>
        .footer-logo {
            max-width: 200px;
            height: auto;
            width: 100%;
            object-fit: contain;
            display: block;
        }

        .footer-logo-link {
            display: inline-block;
            transition: opacity 0.3s ease;
            margin-left: 0;
            padding-left: 0;
        }

        .footer-logo-link:hover {
            opacity: 0.8;
        }

        .footer-widget p {
            margin-left: 0;
            padding-left: 0;
            text-align: left;
        }

        .footer-wrap .col-lg-3:first-child .footer-widget {
            padding-left: 0 !important;
            margin-left: 0 !important;
        }

        .footer-wrap .col-lg-3:first-child .footer-widget * {
            margin-left: 0;
            padding-left: 14px;
        }

        .footer-wrap .col-lg-3:first-child {
            padding-left: 0 !important;
        }

        .footer-contact-info .contact-item {
            display: flex;
            align-items: center;
            color: #fff;
            margin-bottom: 10px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 100%;
        }

        .footer-contact-info .contact-item i {
            color: var(--ed-color-theme-primary, #006D64);
            font-size: 18px;
            min-width: 24px;
            flex-shrink: 0;
        }

        .footer-contact-info .contact-item a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
            word-break: break-word;
            overflow-wrap: break-word;
            max-width: 100%;
        }

        .footer-contact-info .contact-item a:hover {
            color: var(--ed-color-theme-primary, #006D64);
        }

        .footer-contact-info .contact-item span {
            color: #fff;
        }

        @media (max-width: 991.98px) {
            .footer-wrap {
                row-gap: 30px;
            }

            .footer-wrap .footer-widget {
                text-align: left;
                padding-left: 16px;
            }

            .footer-wrap .footer-widget p {
                text-align: left;
            }

            .footer-wrap .footer-widget .footer-list {
                display: inline-block;
                text-align: left;
                padding-left: 0;
            }

            .footer-wrap .footer-widget .footer-list li {
                margin-bottom: 6px;
            }

            .footer-contact-info .contact-item {
                justify-content: flex-start;
            }

            .footer-social {
                justify-content: flex-start;
            }

            .footer-logo {
                max-width: 180px;
                margin-left: 0;
                margin-right: 0;
            }
        }

        /* Mobile: 2 boxes side by side */
        @media (max-width: 767.98px) {
            .footer-wrap {
                row-gap: 20px;
                display: flex;
                flex-wrap: wrap;
            }

            /* Logo - First row, left side */
            .footer-wrap .col-lg-3:nth-child(1) {
                flex: 0 0 50%;
                max-width: 50%;
                padding-left: 8px;
                padding-right: 8px;
                order: 1;
            }

            /* Contact Us - First row, right side */
            .footer-wrap .col-lg-3:nth-child(4) {
                flex: 0 0 50%;
                max-width: 50%;
                padding-left: 8px;
                padding-right: 8px;
                order: 2;
            }

            /* Company Info - Second row, left side */
            .footer-wrap .col-lg-3:nth-child(2) {
                flex: 0 0 50%;
                max-width: 50%;
                padding-left: 8px;
                padding-right: 8px;
                order: 3;
            }

            /* Useful Links - Second row, right side */
            .footer-wrap .col-lg-3:nth-child(3) {
                flex: 0 0 50%;
                max-width: 50%;
                padding-left: 8px;
                padding-right: 8px;
                order: 4;
            }

            .footer-wrap .footer-widget {
                padding-left: 8px;
                padding-right: 8px;
                overflow: hidden;
                word-wrap: break-word;
                max-width: 100%;
            }

            .footer-contact-info {
                max-width: 100%;
                overflow: hidden;
            }

            .footer-contact-info .contact-item {
                flex-wrap: wrap;
                max-width: 100%;
            }

            .footer-contact-info .contact-item a {
                font-size: 14px;
                line-height: 1.4;
            }
            .footer-widget .widget-header {
                margin-top: 15px;
            }
        }
    </style>
    <div class="footer-top-wrap">
        <div class="container">
            <div class="footer-top text-center" id="subscribe-form-section">
                <h2 class="title">Subscribe Our Newsletter For <br>Latest Updates</h2>
                <div class="footer-form-wrap">
                    @if (session('success_subscribe'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            {{ session('success_subscribe') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($errors->has('email'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            {{ $errors->first('email') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('frontend.subscribe') }}" method="POST" class="footer-form"
                        id="subscribe-form">
                        @csrf
                        <div class="form-item">
                            <input type="email" id="email-2" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Enter Your E-mail" value="{{ old('email') }}" required>
                            <div class="icon"><i class="fa-light fa-envelope"></i></div>
                        </div>
                        <button type="submit" class="ed-primary-btn">Subscribe Now</button>
                    </form>
                </div>
            </div>
            <div class="row footer-wrap">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <a href="javascript:void(0)" class="footer-logo-link">
                            <img src="{{ asset('assets/frontend/img/logo_horezntal.webp') }}"
                                alt="Sister Nourhan Academy Logo" class="footer-logo mb-30">
                        </a>
                        <p class="mb-30">Trusted online Islamic learning: Qur’an, Arabic, and Islamic studies anytime,
                            anywhere</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget widget-2">
                        <ul class="footer-list">
                            <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                            <li><a href="{{ route('frontend.contact') }}">Contact</a></li>
                            <li><a href="{{ route('frontend.pricing') }}">Pricing</a></li>
                            <li><a href="{{ route('frontend.terms') }}">Terms &amp; Conditions</a></li>
                            <li><a href="{{ route('frontend.privacy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget widget-2">
                        <ul class="footer-list">
                            @php
$footerCategories = \Illuminate\Support\Facades\Cache::remember(
    'footer_categories',
    600,
    function () {
        return \App\Models\Category::active()->orderBy('sort_order')->take(5)->get();
    },
);
                            @endphp
                            @foreach ($footerCategories as $category)
                                <li>
                                    <a href="{{ route('frontend.courses', ['category' => $category->slug]) }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                            <li><a href="{{ route('frontend.blog') }}">Blogs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h3 class="widget-header">Contact Us</h3>
                        <div class="footer-contact-info">
                            <div class="contact-item mb-3">
                                <i class="fa-regular fa-phone me-2"></i>
                                <a href="tel:+201065537718">+20 10 65537718</a>
                            </div>
                            <div class="contact-item mb-3">
                                <i class="fa-light fa-envelope me-2"></i>
                                <a href="mailto:info@sisternourhan.com">info@sisternourhan.com</a>
                            </div>
                        </div>
                        <div class="mt-4">
                            <ul class="footer-social">
                                <li><a href="https://www.facebook.com/sister.nourhan.academy" target="_blank"
                                        title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://www.instagram.com/sister.nourhan.academy/" target="_blank"
                                        title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="https://www.youtube.com/@sister.nourhan" target="_blank" title="YouTube"><i
                                            class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="copyright-content">
                <p>Copyright © 2026 <a href="javascript:void(0)">Sister Nourhan Academy</a>. All Rights Reserved.</p>

            </div>
        </div>
    </div>
</footer>

@if (session('success_subscribe') || session('scroll_to_footer') || $errors->has('email'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll to footer section smoothly
            const footerSection = document.getElementById('footer-section');
            if (footerSection) {
                setTimeout(function() {
                    footerSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 100);
            }
        });
    </script>
@endif
