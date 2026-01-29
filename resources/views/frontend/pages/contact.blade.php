@extends('frontend.layouts.master')
@section('title','Contact Us')
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
                <h1 class="title">Contact Us</h1>
                <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                <a class="inner-page" href="{{ route('frontend.contact') }}"> Contact Us</a>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="contact-section pt-120 pb-120">
        <div class="container">
            <div class="row gy-lg-0 gy-5">
                <div class="col-lg-7">
                    <div class="blog-contact-form contact-form">
                        <h2 class="title mb-0">Leave A Reply</h2>
                        <p class="mb-30 mt-10">Fill-up The Form and Message us of your amazing question</p>
                        <div class="request-form">
                            <form action="{{ route('frontend.contact.store') }}" method="post" class="form-horizontal">
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
                                            <input type="text" id="fullname" name="fullname" class="form-control"
                                                   placeholder="Your Name" value="{{ old('fullname') }}" required>
                                            <div class="icon"><i class="fa-regular fa-user"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <input type="tel" id="phone" name="phone" class="form-control"
                                                   placeholder="Phone" value="{{ old('phone') }}" required>
                                            <div class="icon"><i class="fa-sharp fa-solid fa-phone"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <input type="email" id="email" name="email" class="form-control"
                                                   placeholder="Your Email" value="{{ old('email') }}" required>
                                            <div class="icon"><i class="fa-sharp fa-regular fa-envelope"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <select name="timezone" id="timezone"
                                                    class="niceSelect select-control form-control" required>
                                                <option value="">Select Time Zone</option>
                                                <option value="UTC-12" {{ old('timezone') == 'UTC-12' ? 'selected' : '' }}>UTC-12:00 (Baker Island Time)</option>
                                                <option value="UTC-11" {{ old('timezone') == 'UTC-11' ? 'selected' : '' }}>UTC-11:00 (Hawaii-Aleutian Standard Time)</option>
                                                <option value="UTC-10" {{ old('timezone') == 'UTC-10' ? 'selected' : '' }}>UTC-10:00 (Hawaii Standard Time)</option>
                                                <option value="UTC-9" {{ old('timezone') == 'UTC-9' ? 'selected' : '' }}>UTC-09:00 (Alaska Standard Time)</option>
                                                <option value="UTC-8" {{ old('timezone') == 'UTC-8' ? 'selected' : '' }}>UTC-08:00 (Pacific Standard Time)</option>
                                                <option value="UTC-7" {{ old('timezone') == 'UTC-7' ? 'selected' : '' }}>UTC-07:00 (Mountain Standard Time)</option>
                                                <option value="UTC-6" {{ old('timezone') == 'UTC-6' ? 'selected' : '' }}>UTC-06:00 (Central Standard Time)</option>
                                                <option value="UTC-5" {{ old('timezone') == 'UTC-5' ? 'selected' : '' }}>UTC-05:00 (Eastern Standard Time)</option>
                                                <option value="UTC-4" {{ old('timezone') == 'UTC-4' ? 'selected' : '' }}>UTC-04:00 (Atlantic Standard Time)</option>
                                                <option value="UTC-3" {{ old('timezone') == 'UTC-3' ? 'selected' : '' }}>UTC-03:00 (Argentina Time)</option>
                                                <option value="UTC-2" {{ old('timezone') == 'UTC-2' ? 'selected' : '' }}>UTC-02:00 (South Georgia Time)</option>
                                                <option value="UTC-1" {{ old('timezone') == 'UTC-1' ? 'selected' : '' }}>UTC-01:00 (Cape Verde Time)</option>
                                                <option value="UTC+0" {{ old('timezone') == 'UTC+0' ? 'selected' : '' }}>UTC+00:00 (Greenwich Mean Time)</option>
                                                <option value="UTC+1" {{ old('timezone') == 'UTC+1' ? 'selected' : '' }}>UTC+01:00 (Central European Time)</option>
                                                <option value="UTC+2" {{ old('timezone') == 'UTC+2' ? 'selected' : '' }}>UTC+02:00 (Eastern European Time)</option>
                                                <option value="UTC+3" {{ old('timezone') == 'UTC+3' ? 'selected' : '' }}>UTC+03:00 (Moscow Time)</option>
                                                <option value="UTC+4" {{ old('timezone') == 'UTC+4' ? 'selected' : '' }}>UTC+04:00 (Gulf Standard Time)</option>
                                                <option value="UTC+5" {{ old('timezone') == 'UTC+5' ? 'selected' : '' }}>UTC+05:00 (Pakistan Standard Time)</option>
                                                <option value="UTC+6" {{ old('timezone') == 'UTC+6' ? 'selected' : '' }}>UTC+06:00 (Bangladesh Standard Time)</option>
                                                <option value="UTC+7" {{ old('timezone') == 'UTC+7' ? 'selected' : '' }}>UTC+07:00 (Indochina Time)</option>
                                                <option value="UTC+8" {{ old('timezone') == 'UTC+8' ? 'selected' : '' }}>UTC+08:00 (China Standard Time)</option>
                                                <option value="UTC+9" {{ old('timezone') == 'UTC+9' ? 'selected' : '' }}>UTC+09:00 (Japan Standard Time)</option>
                                                <option value="UTC+10" {{ old('timezone') == 'UTC+10' ? 'selected' : '' }}>UTC+10:00 (Australian Eastern Standard Time)</option>
                                                <option value="UTC+11" {{ old('timezone') == 'UTC+11' ? 'selected' : '' }}>UTC+11:00 (Solomon Islands Time)</option>
                                                <option value="UTC+12" {{ old('timezone') == 'UTC+12' ? 'selected' : '' }}>UTC+12:00 (New Zealand Standard Time)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <select name="country" id="country"
                                                    class="niceSelect select-control form-control" required>
                                                <option value="">Select Country</option>
                                                @include('frontend.partials.countries')
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item message-item">
                                            <textarea id="notes" name="notes" cols="30" rows="5"
                                                      class="form-control address" placeholder="Notes (Optional)">{{ old('notes') }}</textarea>
                                            <div class="icon"><i class="fa-light fa-messages"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-btn">
                                    <button type="submit" class="ed-primary-btn">Submit Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="contact-content">
                        <div class="contact-top">
                            <h3 class="title">Office Information</h3>
                            <p>Completely recapitalize 24/7 communities via standards compliant metrics whereas.</p>
                        </div>
                        <div class="contact-list">
                            <div class="list-item">
                                <div class="icon">
                                    <i class="fa-sharp fa-solid fa-phone"></i>
                                </div>
                                <div class="content">
                                    <h4 class="title">Phone Number & Email</h4>
                                    <span><a href="tel:+201065537718">+20 10 65537718</a></span>
                                    <span><a href="mailto:info@sisternourhan.com">info@sisternourhan.com</a></span>
                                </div>
                            </div>

                            <div class="list-item">
                                <div class="icon">
                                    <i class="fa-sharp fa-solid fa-clock"></i>
                                </div>
                                <div class="content">
                                    <h4 class="title">Official Work Time</h4>
                                    <span>All days: 8:00 AM - 2:00 AM (Egypt Time)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ contact-section -->
@endsection

@push('css')
<style>
    /* Nice Select Search Input Styling */
    .nice-select .search-input {
        background: #fff !important;
        border: 1px solid #e0e0e0 !important;
        border-radius: 6px !important;
        padding: 10px 12px !important;
        font-size: 14px !important;
        color: #333 !important;
        width: calc(100% - 10px) !important;
        margin: 5px 5px 8px 5px !important;
        box-sizing: border-box !important;
        transition: border-color 0.3s ease !important;
    }

    .nice-select .search-input:focus {
        border-color: #007bff !important;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25) !important;
        outline: none !important;
    }

    .nice-select .search-input::placeholder {
        color: #999 !important;
        font-style: italic !important;
    }

    /* Dropdown styling improvements */
    .nice-select .list {
        max-height: 250px !important;
        overflow-y: auto !important;
    }

    .nice-select .option {
        padding: 10px 15px !important;
        transition: background-color 0.2s ease !important;
    }

    .nice-select .option:hover {
        background-color: #f8f9fa !important;
    }

    /* Scrollbar styling for dropdown */
    .nice-select .list::-webkit-scrollbar {
        width: 6px;
    }

    .nice-select .list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .nice-select .list::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    .nice-select .list::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize niceSelect
        if (typeof jQuery !== 'undefined' && typeof jQuery.fn.niceSelect !== 'undefined') {
            jQuery('select').niceSelect();
        }

        // Add search functionality to Time Zone dropdown
        function addSearchToTimezone() {
            const timezoneSelect = document.getElementById('timezone');
            const timezoneWrapper = timezoneSelect ? timezoneSelect.closest('.form-item') : null;

            if (!timezoneWrapper) {
                return;
            }

            const niceSelect = timezoneWrapper.querySelector('.nice-select');
            if (!niceSelect) {
                return;
            }

            // Check if search input already exists
            if (niceSelect.querySelector('.search-input')) {
                return;
            }

            // Create search input
            const searchInput = document.createElement('input');
            searchInput.type = 'text';
            searchInput.className = 'search-input';
            searchInput.placeholder = 'Search timezone...';
            searchInput.style.cssText = `
                width: 100%;
                padding: 8px 12px;
                border: 1px solid #ddd;
                border-radius: 4px;
                margin-bottom: 5px;
                font-size: 14px;
                outline: none;
            `;

            // Insert search input at the top of the dropdown
            const list = niceSelect.querySelector('.list');
            if (list) {
                list.insertBefore(searchInput, list.firstChild);

                // Add search functionality
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const options = list.querySelectorAll('.option');

                    options.forEach(option => {
                        const text = option.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            option.style.display = 'block';
                        } else {
                            option.style.display = 'none';
                        }
                    });
                });

                // Prevent dropdown from closing when clicking on search input
                searchInput.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
        }

        // Add search functionality to Country dropdown
        function addSearchToCountry() {
            const countrySelect = document.getElementById('country');
            const countryWrapper = countrySelect ? countrySelect.closest('.form-item') : null;

            if (!countryWrapper) {
                return;
            }

            const niceSelect = countryWrapper.querySelector('.nice-select');
            if (!niceSelect) {
                return;
            }

            // Check if search input already exists
            if (niceSelect.querySelector('.search-input')) {
                return;
            }

            // Create search input
            const searchInput = document.createElement('input');
            searchInput.type = 'text';
            searchInput.className = 'search-input';
            searchInput.placeholder = 'Search country...';
            searchInput.style.cssText = `
                width: 100%;
                padding: 8px 12px;
                border: 1px solid #ddd;
                border-radius: 4px;
                margin-bottom: 5px;
                font-size: 14px;
                outline: none;
            `;

            // Insert search input at the top of the dropdown
            const list = niceSelect.querySelector('.list');
            if (list) {
                list.insertBefore(searchInput, list.firstChild);

                // Add search functionality
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const options = list.querySelectorAll('.option');

                    options.forEach(option => {
                        const text = option.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            option.style.display = 'block';
                        } else {
                            option.style.display = 'none';
                        }
                    });
                });

                // Prevent dropdown from closing when clicking on search input
                searchInput.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
        }

        // Wait for niceSelect to initialize
        setTimeout(function() {
            addSearchToTimezone();
            addSearchToCountry();
        }, 500);

        // Reinitialize when niceSelect updates
        if (typeof jQuery !== 'undefined') {
            jQuery(document).on('click', '.nice-select', function() {
                setTimeout(function() {
                    addSearchToTimezone();
                    addSearchToCountry();
                }, 100);
            });
        }
    });
</script>
@endpush
