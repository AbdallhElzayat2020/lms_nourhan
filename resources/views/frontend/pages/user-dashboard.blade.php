@extends('frontend.layouts.master')
@section('title', 'My Dashboard')

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
                <h1 class="title">My Dashboard</h1>
                <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                <a class="inner-page" href="{{ route('frontend.user.dashboard') }}"> My Dashboard</a>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="feature-section bg-white pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0" style="border-radius: 15px;">
                        <div class="card-body p-4">
                            <div class="row align-items-center mb-4">
                                <div class="col-md-8">
                                    <h3 class="mb-2">Welcome, {{ $user->name }}!</h3>
                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="{{ route('frontend.home') }}" class="btn btn-primary">
                                        <i class="fa-light fa-home me-2"></i>Go to Home
                                    </a>
                                </div>
                            </div>

                            <hr>

                            <div class="row mt-4">
                                <div class="col-md-6 mb-4">
                                    <div class="card border-0 bg-light h-100">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-box bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                                    <i class="fa-light fa-user fs-4"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h5 class="mb-1">Profile Information</h5>
                                                    <p class="text-muted mb-0 small">Manage your account details</p>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <p class="mb-1"><strong>Name:</strong> {{ $user->name }}</p>
                                                <p class="mb-1"><strong>Email:</strong> {{ $user->email }}</p>
                                                <p class="mb-0"><strong>Role:</strong> {{ $user->role ? $user->role->name : 'No Role Assigned' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="card border-0 bg-light h-100">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-box bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                                    <i class="fa-light fa-shield-check fs-4"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h5 class="mb-1">Permissions</h5>
                                                    <p class="text-muted mb-0 small">{{ isset($permissions) ? $permissions->count() : 0 }} permission(s)</p>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                @if(isset($permissions) && $permissions->count() > 0)
                                                    <div class="d-flex flex-wrap gap-1">
                                                        @foreach($permissions->take(6) as $permission)
                                                            <span class="badge bg-label-primary">{{ $permission->name }}</span>
                                                        @endforeach
                                                        @if($permissions->count() > 6)
                                                            <span class="badge bg-label-secondary">+{{ $permissions->count() - 6 }} more</span>
                                                        @endif
                                                    </div>
                                                @else
                                                    <p class="text-muted mb-0 small">No permissions assigned</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(isset($availablePages) && count($availablePages) > 0)
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body p-4">
                                            <h5 class="mb-3">
                                                <i class="fa-light fa-list me-2 text-primary"></i>
                                                Available Pages (Based on Your Permissions)
                                            </h5>
                                            <div class="row">
                                                @foreach($availablePages as $page)
                                                    <div class="col-md-4 mb-3">
                                                        <a href="{{ route($page['route']) }}" class="text-decoration-none">
                                                            <div class="card border h-100 hover-shadow" style="transition: all 0.3s ease;">
                                                                <div class="card-body p-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="icon-box bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                                            <i class="fa-light {{ $page['icon'] }}"></i>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="mb-1 text-dark">{{ $page['name'] }}</h6>
                                                                            <p class="text-muted mb-0 small">{{ $page['description'] }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body p-4">
                                            <h5 class="mb-3">
                                                <i class="fa-light fa-calendar-check me-2 text-success"></i>
                                                Quick Actions (Public Pages)
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-3 mb-2">
                                                    <a href="{{ route('frontend.book') }}" class="btn btn-sm btn-outline-primary w-100">
                                                        <i class="fa-light fa-calendar me-2"></i>Book a Session
                                                    </a>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <a href="{{ route('frontend.contact') }}" class="btn btn-sm btn-outline-primary w-100">
                                                        <i class="fa-light fa-envelope me-2"></i>Contact Us
                                                    </a>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <a href="{{ route('frontend.courses') }}" class="btn btn-sm btn-outline-primary w-100">
                                                        <i class="fa-light fa-graduation-cap me-2"></i>Browse Courses
                                                    </a>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <a href="{{ route('frontend.events') }}" class="btn btn-sm btn-outline-primary w-100">
                                                        <i class="fa-light fa-calendar-event me-2"></i>View Events
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body p-4">
                                            <h5 class="mb-3">
                                                <i class="fa-light fa-info-circle me-2 text-primary"></i>
                                                Account Information
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-2"><strong>Account Created:</strong> {{ $user->created_at->format('F d, Y') }}</p>
                                                    <p class="mb-2"><strong>Last Updated:</strong> {{ $user->updated_at->format('F d, Y') }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    @if($user->email_verified_at)
                                                        <p class="mb-2">
                                                            <strong>Email Status:</strong>
                                                            <span class="badge bg-success">Verified</span>
                                                        </p>
                                                    @else
                                                        <p class="mb-2">
                                                            <strong>Email Status:</strong>
                                                            <span class="badge bg-warning">Not Verified</span>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ feature-section -->
@endsection

@push('css')
<style>
    .icon-box {
        flex-shrink: 0;
    }
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    .hover-shadow:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
        transform: translateY(-3px);
    }
</style>
@endpush
