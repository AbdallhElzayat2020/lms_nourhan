@extends('dashboard.layouts.master')

@section('title', 'Dashboard')

@section('content')
    @if(!$user->isAdmin() && isset($availablePages) && count($availablePages) > 0)
    <!-- Available Pages Section (for non-admin users) -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="ti ti-layout-grid me-2"></i>
                        Available Pages
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($availablePages as $page)
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                <a href="{{ route($page['route']) }}" class="card h-100 text-decoration-none border hover-shadow">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="ti {{ $page['icon'] }}" style="font-size: 3rem; color: #696cff;"></i>
                                        </div>
                                        <h6 class="card-title mb-1">{{ $page['name'] }}</h6>
                                        <p class="card-text text-muted small mb-0">{{ $page['description'] }}</p>
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

    @if($user->isAdmin() || $user->hasPermission('dashboard.access'))
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- Categories -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-category text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Categories</span>
                    <h3 class="card-title mb-2">{{ $totalCategories }}</h3>
                    <small class="text-success fw-semibold">
                        <i class="ti ti-arrow-up"></i>
                        {{ $activeCategories }} Active
                    </small>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-shield-lock text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Users</span>
                    <h3 class="card-title mb-2">{{ $totalUsers }}</h3>
                    <small class="text-info fw-semibold">
                        <i class="ti ti-shield"></i>
                        {{ $adminUsers }} Admins
                    </small>
                </div>
            </div>
        </div>

        <!-- Courses -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-school text-warning" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Courses</span>
                    <h3 class="card-title mb-2">{{ $totalCourses }}</h3>
                    <small class="text-success fw-semibold">
                        <i class="ti ti-check"></i>
                        {{ $activeCourses }} Active | {{ $homepageCourses }} on Homepage
                    </small>
                </div>
            </div>
        </div>

        <!-- Blogs -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-news text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Blogs</span>
                    <h3 class="card-title mb-2">{{ $totalBlogs }}</h3>
                    <small class="text-success fw-semibold">
                        <i class="ti ti-check"></i>
                        {{ $publishedBlogs }} Published
                    </small>
                </div>
            </div>
        </div>

        <!-- Events -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-calendar-event text-danger" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Events</span>
                    <h3 class="card-title mb-2">{{ $totalEvents }}</h3>
                    <small class="text-success fw-semibold">
                        <i class="ti ti-check"></i>
                        {{ $activeEvents }} Active | {{ $upcomingEvents }} Upcoming
                    </small>
                </div>
            </div>
        </div>

        <!-- Event Bookings -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-ticket text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Event Bookings</span>
                    <h3 class="card-title mb-2">{{ $totalEventBookings }}</h3>
                    <small class="text-warning fw-semibold">
                        <i class="ti ti-clock"></i>
                        {{ $pendingEventBookings }} Pending
                    </small>
                </div>
            </div>
        </div>

        <!-- Course Bookings -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-calendar text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Course Bookings</span>
                    <h3 class="card-title mb-2">{{ $totalCourseBookings }}</h3>
                    <small class="text-warning fw-semibold">
                        <i class="ti ti-clock"></i>
                        {{ $pendingCourseBookings }} Pending
                    </small>
                </div>
            </div>
        </div>

        <!-- Course Feedbacks -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-message-circle-2 text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Course Feedbacks</span>
                    <h3 class="card-title mb-2">{{ $totalCourseFeedbacks }}</h3>
                    <small class="text-success fw-semibold">
                        <i class="ti ti-check"></i>
                        {{ $activeCourseFeedbacks }} Active
                    </small>
                </div>
            </div>
        </div>

        <!-- Teachers -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-user text-warning" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Teachers</span>
                    <h3 class="card-title mb-2">{{ $totalTeachers }}</h3>
                    <small class="text-success fw-semibold">
                        <i class="ti ti-check"></i>
                        {{ $activeTeachers }} Active
                    </small>
                </div>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-message-circle text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Testimonials</span>
                    <h3 class="card-title mb-2">{{ $totalTestimonials }}</h3>
                    <small class="text-success fw-semibold">
                        <i class="ti ti-check"></i>
                        {{ $activeTestimonials }} Active
                    </small>
                </div>
            </div>
        </div>

        <!-- Sliders -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-photo text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Sliders</span>
                    <h3 class="card-title mb-2">{{ $totalSliders }}</h3>
                    <small class="text-success fw-semibold">
                        <i class="ti ti-check"></i>
                        {{ $activeSliders }} Active
                    </small>
                </div>
            </div>
        </div>

        <!-- FAQs -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-help text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total FAQs</span>
                    <h3 class="card-title mb-2">{{ $totalFaqs }}</h3>
                    <small class="text-success fw-semibold">
                        <i class="ti ti-check"></i>
                        {{ $activeFaqs }} Active
                    </small>
                </div>
            </div>
        </div>

        <!-- Subscribers -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-mailbox text-warning" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Subscribers</span>
                    <h3 class="card-title mb-2">{{ $totalSubscribers }}</h3>
                    <small class="text-info fw-semibold">
                        <i class="ti ti-calendar"></i>
                        {{ $recentSubscribers }} This Month
                    </small>
                </div>
            </div>
        </div>

        <!-- Contacts -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-mail text-danger" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Contact Messages</span>
                    <h3 class="card-title mb-2">{{ $totalContacts }}</h3>
                    <small class="text-warning fw-semibold">
                        <i class="ti ti-bell"></i>
                        {{ $unreadContacts }} Unread
                    </small>
                </div>
            </div>
        </div>

        <!-- Redirects -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-external-link text-warning" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">URL Redirects</span>
                    <h3 class="card-title mb-2">{{ number_format($totalRedirects) }}</h3>
                    <small class="text-success fw-semibold">
                        <i class="ti ti-click me-1"></i>
                        {{ number_format($totalRedirectHits) }} total hits
                    </small>
                </div>
            </div>
        </div>

        <!-- SEO Pages -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="ti ti-seo text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">SEO Pages</span>
                    <h3 class="card-title mb-2">{{ $totalSeoPages }}</h3>
                    <small class="text-success fw-semibold">
                        <i class="ti ti-check"></i>
                        {{ $activeSeoPages }} Active
                    </small>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($user->isAdmin() || $user->hasPermission('dashboard.access'))
    <!-- Recent Items Row -->
    <div class="row">
        <!-- Recent Categories -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Categories</h5>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-label-primary">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentCategories as $category)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($category->image)
                                                    <img src="{{ asset('uploads/categories/' . $category->image) }}"
                                                        alt="{{ $category->name }}" class="rounded me-2"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $category->name }}</h6>
                                                    <small class="text-muted">{{ $category->slug }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($category->status == 'active')
                                                <span class="badge bg-label-success">Active</span>
                                            @else
                                                <span class="badge bg-label-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $category->created_at->format('Y-m-d') }}</small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No categories found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Courses -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Courses</h5>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-sm btn-label-primary">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentCourses as $course)
                                    <tr>
                                        <td>
                                            <div>
                                                <h6 class="mb-0">{{ Str::limit($course->title, 30) }}</h6>
                                                <small class="text-muted">{{ Str::limit($course->slug, 25) }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @if($course->status == 'active')
                                                <span class="badge bg-label-success">Active</span>
                                            @else
                                                <span class="badge bg-label-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $course->created_at->format('Y-m-d') }}</small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No courses found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Blogs -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Blogs</h5>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-label-primary">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBlogs as $blog)
                                    <tr>
                                        <td>
                                            <div>
                                                <h6 class="mb-0">{{ Str::limit($blog->title, 30) }}</h6>
                                                <small class="text-muted">{{ Str::limit($blog->slug, 25) }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @if($blog->status == 'published')
                                                <span class="badge bg-label-success">Published</span>
                                            @else
                                                <span class="badge bg-label-warning">Draft</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $blog->created_at->format('Y-m-d') }}</small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No blogs found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Event Bookings -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Event Bookings</h5>
                    <a href="{{ route('admin.event-bookings.index') }}" class="btn btn-sm btn-label-primary">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Event</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentEventBookings as $booking)
                                    <tr>
                                        <td>
                                            <div>
                                                <h6 class="mb-0">{{ $booking->name }}</h6>
                                                <small class="text-muted">{{ $booking->email }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <small>{{ Str::limit($booking->event->name ?? 'N/A', 20) }}</small>
                                        </td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <span class="badge bg-label-warning">Pending</span>
                                            @elseif($booking->status == 'confirmed')
                                                <span class="badge bg-label-success">Confirmed</span>
                                            @else
                                                <span class="badge bg-label-danger">Cancelled</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No bookings found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@push('js')
    <script>
        // Categories Chart
        const categoriesChartData = @json($categoriesChartData);
        const categoriesLabels = categoriesChartData.map(item => {
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            return monthNames[item.month - 1] + ' ' + item.year;
        });
        const categoriesCounts = categoriesChartData.map(item => item.count);

        const categoriesChartOptions = {
            chart: {
                type: 'bar',
                height: 300,
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    borderRadius: 5
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: categoriesLabels
            },
            yaxis: {
                title: {
                    text: 'Count'
                }
            },
            fill: {
                opacity: 1
            },
            colors: ['#696cff'],
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " category"
                    }
                }
            }
        };

        const categoriesChart = new ApexCharts(document.querySelector("#categoriesChart"), {
            ...categoriesChartOptions,
            series: [{
                name: 'Categories',
                data: categoriesCounts
            }]
        });
        categoriesChart.render();
    </script>
@endpush

@push('css')
<style>
    /* Ensure all icons are visible and properly styled */
    .card .avatar {
        width: 60px;
        height: 60px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.05);
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .card .avatar i {
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
        font-size: 2rem !important;
        line-height: 1;
    }

    /* Ensure icons have proper color */
    .card .avatar i.text-primary {
        color: #696cff !important;
    }

    .card .avatar i.text-success {
        color: #71dd37 !important;
    }

    .card .avatar i.text-warning {
        color: #ffab00 !important;
    }

    .card .avatar i.text-info {
        color: #03c3ec !important;
    }

    .card .avatar i.text-danger {
        color: #ff3e1d !important;
    }

    /* Available Pages Hover Effect */
    .hover-shadow {
        transition: all 0.3s ease;
    }

    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-5px);
    }
</style>
@endpush
