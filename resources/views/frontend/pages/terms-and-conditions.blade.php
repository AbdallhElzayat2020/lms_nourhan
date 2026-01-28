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
                <h1 class="title">Terms &amp; Conditions</h1>
                <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                <a class="inner-page" href="javascript:void(0)">Terms &amp; Conditions</a>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="terms-content">
                        <h2 class="mb-20">Terms and Conditions</h2>
                        <p class="mb-20">
                            Welcome to Sister Nourhan Academy for Learning Arabic, Quran, and Islamic Studies.
                            These terms and conditions outline the rules and regulations governing the use of our website and services.
                            By accessing our website or enrolling in any of our courses, you acknowledge and agree as a legally
                            binding commitment to comply fully with these terms and conditions. If you do not agree with any part
                            of these terms, please refrain from using our website and services.
                        </p>

                        <h3 class="mb-15">Course Enrollment and Payment</h3>
                        <h4 class="mb-10">Course Plans</h4>
                        <p class="mb-15">
                            We offer several course plans, each containing a specified number of lessons.
                            Details of all available plans are listed on our website.
                        </p>
                        <h4 class="mb-10">Payment</h4>
                        <p class="mb-15">
                            Course fees are paid online through PayPal, bank account, MoneyGram, and Ria.
                            All fees are clearly displayed on the relevant page of our website.
                            The academy is not responsible for any additional charges imposed by your bank or payment provider.
                        </p>
                        <h4 class="mb-10">Transfer Fees</h4>
                        <p class="mb-20">
                            Any transfer fees incurred during the payment process are the responsibility of the student.
                        </p>

                        <h3 class="mb-15">Refund Policy</h3>
                        <h4 class="mb-10">Refund Eligibility</h4>
                        <p class="mb-15">
                            Students are eligible to request a refund within three days from the date of payment.
                            Requests must be submitted to our support team within this timeframe.
                        </p>
                        <h4 class="mb-10">Non-Refundable Conditions</h4>
                        <p class="mb-15">
                            Refunds will not be issued once the student has completed the third paid lesson of the purchased plan,
                            except where the refund request arises due to a fault or failure on the part of Sister Nourhan Academy.
                        </p>
                        <h4 class="mb-10">Processing Refunds</h4>
                        <p class="mb-20">
                            Refunds are issued through the original payment method.
                            Please allow up to ten business days for the refunded amount to appear in your account.
                        </p>

                        <h3 class="mb-15">Conduct and Policies</h3>
                        <h4 class="mb-10">Non-Discrimination and Neutrality</h4>
                        <p class="mb-15">
                            Sister Nourhan Academy provides instruction in Arabic, Quran, and Islamic studies using an educational
                            approach that is free from political, ethnic, or sectarian bias. We do not promote any political agenda
                            or ideological conflict.
                        </p>
                        <h4 class="mb-10">Student Conduct</h4>
                        <p class="mb-20">
                            All students are expected to maintain respectful behavior toward instructors and fellow students.
                        </p>

                        <h3 class="mb-15">Intellectual Property</h3>
                        <h4 class="mb-10">Content Ownership</h4>
                        <p class="mb-15">
                            All educational materials provided by Sister Nourhan Academy including lessons, videos, documents, and
                            other resources are the exclusive intellectual property of the academy. Reproduction, distribution, or
                            commercial use of this content without written permission is strictly prohibited.
                        </p>
                        <h4 class="mb-10">Use of Website</h4>
                        <p class="mb-20">
                            You may use our website strictly for personal and educational purposes.
                            Unauthorized use may result in legal action, including claims for damages or other appropriate measures.
                        </p>

                        <h3 class="mb-15">Privacy Policy</h3>
                        <h4 class="mb-10">Data Collection</h4>
                        <p class="mb-15">
                            We collect personal information from students only for the purpose of providing and improving our
                            services. All collected information is kept secure and confidential.
                        </p>
                        <h4 class="mb-10">Use of Data</h4>
                        <p class="mb-15">
                            Your personal data is used exclusively for communication, account management, payment processing,
                            and service improvement. We do not share personal data with third parties without explicit consent,
                            except where required by law.
                        </p>
                        <h4 class="mb-10">Data Deletion</h4>
                        <p class="mb-20">
                            Students have the right to request the deletion of their personal data from our records, and such
                            requests will be processed according to our internal procedures.
                        </p>

                        <h3 class="mb-15">Amendments to Terms and Conditions</h3>
                        <h4 class="mb-10">Changes to Policies</h4>
                        <p class="mb-15">
                            Sister Nourhan Academy reserves the right to update or modify these terms at any time.
                            Any changes will be posted on this page, and continued use of the website or services will be
                            considered acceptance of the updated terms.
                        </p>

                        <h3 class="mb-15">Contact Information</h3>
                        <p>
                            If you have any questions or concerns regarding these terms and conditions, please contact us at:
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

