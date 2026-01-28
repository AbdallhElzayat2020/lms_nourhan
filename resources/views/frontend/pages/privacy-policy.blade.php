@extends('frontend.layouts.master')

@section('content')
    <section class="page-header">
        <div class="bg-item">
            <div class="bg-img" data-background="{{ asset('assets/frontend/img/banner_top.jpeg') }}"></div>
            <div class="overlay"></div>
            <div class="shapes">
                <div class="shape shape-1">
                    <img src="{{ asset('assets/frontend/img/shapes/page-header-shape-1.png') }}" alt="shape">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="page-header-content">
                <h1 class="title">Privacy Policy</h1>
                <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                    <a class="inner-page" href="javascript:void(0)">Privacy Policy</a>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="terms-content">
                        <h2 class="mb-20">Privacy Policy</h2>

                        <h3 class="mb-15">Data Collection</h3>
                        <p class="mb-15">
                            We collect personal information from students only for the purpose of providing and improving our
                            services. All collected information is kept secure and confidential.
                        </p>

                        <h3 class="mb-15">Use of Data</h3>
                        <p class="mb-15">
                            Your personal data is used exclusively for communication, account management, payment processing,
                            and service improvement. We do not share personal data with third parties without explicit consent,
                            except where required by law.
                        </p>

                        <h3 class="mb-15">Data Deletion</h3>
                        <p class="mb-20">
                            Students have the right to request the deletion of their personal data from our records, and such
                            requests will be processed according to our internal procedures.
                        </p>

                        <h3 class="mb-15">Amendments to Terms and Conditions</h3>
                        <h4 class="mb-10">Changes to Policies</h4>
                        <p class="mb-15">
                            Sister Nourhan Academy reserves the right to update or modify these terms at any time. Any changes
                            will be posted on this page, and continued use of the website or services will be considered
                            acceptance of the updated terms.
                        </p>

                        <h3 class="mb-15">Contact Information</h3>
                        <p>
                            If you have any questions or concerns regarding these terms and conditions or this privacy policy,
                            please contact us at:
                        </p>
                        <ul class="mb-0" style="margin-left: 1.2rem;">
                            <li>Email: <a href="mailto:info@sisternourhan.academy">info@sisternourhan.academy</a></li>
                            <li>WhatsApp: <a href="https://wa.me/201065537718" target="_blank">+20 106 553 7718</a></li>
                            <li>Website: <a href="https://sisternourhan.academy/" target="_blank">sisternourhan.academy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

