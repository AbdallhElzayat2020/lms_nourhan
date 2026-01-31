@extends('frontend.layouts.master')
@section('title', $teacher->name . ' - Teacher Details')
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
                <h1 class="title">{{ $teacher->name }}</h1>
                <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                <a class="inner-page" href="{{ route('frontend.teachers') }}"> Teachers</a><span class="icon">/</span>
                <span>{{ $teacher->name }}</span>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <!-- Team Details Section -->
    <section class="team-details-section pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="team-details-sidebar">
                        <div class="team-details-img-wrapper">
                            <div class="team-details-img">
                                @if ($teacher->image)
                                   <a target="_blank"  href="{{ $teacher->video_url }}">
                                     <img src="{{ asset('uploads/teachers/' . $teacher->image) }}"
                                        alt="{{ $teacher->name }}">
                                   </a>
                                @else
                                    <img src="{{ asset('assets/frontend/img/team/team-9.png') }}"
                                        alt="{{ $teacher->name }}">
                                @endif
                            </div>
                        </div>
                        <div class="team-details-info">
                            <h3 class="teacher-name">{{ $teacher->name }}</h3>
                            @if ($teacher->short_description)
                                <span class="teacher-title">{{ $teacher->short_description }}</span>
                            @endif
                            <div class="mt-3">
                                <a href="{{ route('frontend.contact') }}" class="ed-primary-btn w-100 text-center d-inline-block">Book</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="team-details-content">
                        <h2 class="content-title">About {{ $teacher->name }}</h2>
                        @if ($teacher->description)
                            <div class="teacher-description">
                                {!! $teacher->description !!}
                            </div>
                        @elseif($teacher->short_description)
                            <div class="teacher-description">
                                <p>{{ $teacher->short_description }}</p>
                            </div>
                        @endif

                        @if ($teacher->video_url)
                            <div class="teacher-video-section">
                                <h3 class="sub-title">Introduction Video</h3>
                                <div class="video-wrapper">
                                    <div
                                        style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; background: #000;">
                                        <iframe
                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                                            src="{{ $teacher->video_url }}" title="Teacher introduction video"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($teacher->activeCertificates->count() > 0)
                            <div class="teacher-certificates-section mt-5">
                                <h3 class="sub-title">Certificates & Qualifications</h3>
                                <div class="certificates-grid">
                                    @foreach ($teacher->activeCertificates as $certificate)
                                        <div class="certificate-item">
                                            <div class="certificate-image-wrapper" data-bs-toggle="modal" data-bs-target="#certificateModal{{ $certificate->id }}">
                                                <img src="{{ $certificate->image_url }}"
                                                     alt="{{ $certificate->image_alt ?: $certificate->title }}"
                                                     class="certificate-image">
                                                <div class="certificate-overlay">
                                                    <i class="fa fa-search-plus"></i>
                                                    <span>View Certificate</span>
                                                </div>
                                            </div>
                                            <div class="certificate-info">
                                                <h5 class="certificate-title">{{ $certificate->title }}</h5>
                                                @if ($certificate->issuer)
                                                    <p class="certificate-issuer">{{ $certificate->issuer }}</p>
                                                @endif
                                                @if ($certificate->description)
                                                    <p class="certificate-description">{{ $certificate->description }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Certificate Modals -->
            @foreach ($teacher->activeCertificates as $certificate)
                <div class="modal fade" id="certificateModal{{ $certificate->id }}" tabindex="-1" aria-labelledby="certificateModalLabel{{ $certificate->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="certificateModalLabel{{ $certificate->id }}">{{ $certificate->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{ $certificate->image_url }}"
                                     alt="{{ $certificate->image_alt ?: $certificate->title }}"
                                     class="img-fluid rounded shadow">
                                @if ($certificate->issuer || $certificate->description)
                                    <div class="certificate-details mt-3">
                                        @if ($certificate->issuer)
                                            <p class="mb-1"><strong>Issued by:</strong> {{ $certificate->issuer }}</p>
                                        @endif
                                        @if ($certificate->description)
                                            <p class="mb-0">{{ $certificate->description }}</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($recentTeachers->count() > 0)
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="section-heading text-center mb-4">
                            <h4 class="sub-heading"><span class="heading-icon"><i
                                        class="fa-sharp fa-solid fa-bolt"></i></span>Other Teachers</h4>
                            <h2 class="section-title">Meet Our Other Expert Instructors</h2>
                        </div>
                        <div class="row gy-lg-0 gy-4">
                            @foreach ($recentTeachers as $recentTeacher)
                                <div class="col-lg-3 col-md-6">
                                    <div class="team-item-3">
                                        <a href="{{ route('frontend.teacher.details', $recentTeacher->slug) }}">
                                            <div class="team-thumb-wrap">
                                                <div class="team-thumb">
                                                    @if ($recentTeacher->image)
                                                        <img src="{{ asset('uploads/teachers/' . $recentTeacher->image) }}"
                                                            alt="{{ $recentTeacher->name }}">
                                                    @else
                                                        <img src="{{ asset('assets/frontend/img/team/team-9.png') }}"
                                                            alt="{{ $recentTeacher->name }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="team-content">
                                                <h3 class="title"><a
                                                        href="{{ route('frontend.teacher.details', $recentTeacher->slug) }}">{{ $recentTeacher->name }}</a>
                                                </h3>
                                                @if ($recentTeacher->short_description)
                                                    <span>{!! $recentTeacher->short_description !!}</span>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- ./ Team Details Section -->
@endsection

@push('css')
<style>
    /* Teacher Certificates Styling */
    .teacher-certificates-section {
        margin-top: 3rem;
    }

    .certificates-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .certificate-item {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .certificate-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .certificate-image-wrapper {
        position: relative;
        height: 200px;
        overflow: hidden;
        cursor: pointer;
    }

    .certificate-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .certificate-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .certificate-image-wrapper:hover .certificate-overlay {
        opacity: 1;
    }

    .certificate-image-wrapper:hover .certificate-image {
        transform: scale(1.05);
    }

    .certificate-overlay i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .certificate-overlay span {
        font-size: 0.9rem;
        font-weight: 500;
    }

    .certificate-info {
        padding: 1.5rem;
    }

    .certificate-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .certificate-issuer {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .certificate-description {
        font-size: 0.85rem;
        color: #777;
        margin-bottom: 0;
        line-height: 1.5;
    }

    /* Modal Styling */
    .modal-content {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        border-bottom: 1px solid #eee;
        padding: 1.5rem;
    }

    .modal-title {
        font-weight: 600;
        color: #333;
    }

    .modal-body {
        padding: 2rem;
    }

    .certificate-details {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        text-align: left;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .certificates-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .certificate-image-wrapper {
            height: 180px;
        }

        .certificate-info {
            padding: 1rem;
        }

        .modal-body {
            padding: 1rem;
        }
    }

    @media (max-width: 480px) {
        .teacher-certificates-section {
            margin-top: 2rem;
        }

        .certificates-grid {
            gap: 1rem;
        }

        .certificate-image-wrapper {
            height: 160px;
        }
    }
</style>
@endpush

<style>
    .team-details-section {
        background-color: #f8f9fa;
    }

    .team-details-sidebar {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        position: sticky;
        top: 100px;
        /* GPU layer to reduce scroll jank */
        transform: translateZ(0);
        will-change: transform;
    }

    .team-details-img-wrapper {
        margin-bottom: 30px;
    }

    .team-details-img {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .team-details-img img {
        width: 100%;
        height: auto;
        display: block;
    }

    .team-details-info {
        text-align: center;
    }

    .teacher-name {
        font-size: 28px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .teacher-title {
        font-size: 18px;
        color: #666;
        display: block;
        margin-bottom: 25px;
    }

    .team-social-details {
        margin-top: 30px;
        padding-top: 30px;
        border-top: 1px solid #e0e0e0;
    }

    .social-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 20px;
    }

    .team-social-details .social-list {
        display: flex;
        justify-content: center;
        gap: 15px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .team-details-content {
        background: #fff;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .content-title {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 25px;
    }

    .teacher-description {
        font-size: 16px;
        line-height: 1.8;
        color: #555;
    }

    .teacher-description p {
        margin-bottom: 15px;
    }

    .sub-title {
        font-size: 24px;
        font-weight: 600;
        color: #1a1a1a;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    .teacher-video-section {
        margin-top: 40px;
        padding-top: 40px;
        border-top: 2px solid #e0e0e0;
    }

    .video-wrapper {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 991px) {
        .team-details-sidebar {
            position: relative;
            top: 0;
            margin-bottom: 30px;
        }

        .team-details-content {
            padding: 30px 20px;
        }

        .content-title {
            font-size: 26px;
        }
    }
</style>

@push('js')
<script>
(function() {
    // Disable smooth-scroll on this page for lighter, native scroll (runs after smooth-scroll init)
    function disableSmoothScroll() {
        if (window.SmoothScroll && typeof window.SmoothScroll.destroy === 'function') {
            window.SmoothScroll.destroy();
        }
    }
    if (document.readyState === 'complete') {
        setTimeout(disableSmoothScroll, 0);
    } else {
        window.addEventListener('load', function() { setTimeout(disableSmoothScroll, 0); });
    }
})();
</script>
@endpush
