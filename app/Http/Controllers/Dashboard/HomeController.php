<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\Course;
use App\Models\Blog;
use App\Models\Event;
use App\Models\EventBooking;
use App\Models\CourseFeedback;
use App\Models\Teacher;
use App\Models\Testimonial;
use App\Models\Slider;
use App\Models\Faq;
use App\Models\Subscriber;
use App\Models\Contact;
use App\Models\Booking;
use App\Models\Redirect;
use App\Models\SeoPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Check if user has any permissions or is admin
        if (!$user->isAdmin() && !$user->hasAnyPermissions()) {
            abort(403, 'Unauthorized action.');
        }

        // Get available pages based on user permissions
        $availablePages = $this->getAvailablePages($user);

        // Statistics - Categories
        $totalCategories = Category::count();
        $activeCategories = Category::where('status', 'active')->count();

        // Statistics - Users
        $totalUsers = User::count();
        $adminUsers = User::where(function($q) {
            $q->whereHas('role', function($query) {
                $query->where('slug', 'admin');
            })->orWhere('email', 'admin@gmail.com');
        })->count();

        // Statistics - Courses
        $totalCourses = Course::count();
        $activeCourses = Course::where('status', 'active')->count();
        $homepageCourses = Course::where('show_on_homepage', true)->count();

        // Statistics - Blogs
        $totalBlogs = Blog::count();
        $publishedBlogs = Blog::where('status', 'published')->count();

        // Statistics - Events
        $totalEvents = Event::count();
        $activeEvents = Event::where('status', 'active')->count();
        $upcomingEvents = Event::where('start_date', '>=', now())->count();

        // Statistics - Bookings
        $totalEventBookings = EventBooking::count();
        $pendingEventBookings = EventBooking::where('status', 'pending')->count();
        $totalCourseBookings = Booking::count();
        $pendingCourseBookings = Booking::where('status', 'pending')->count();

        // Statistics - Course Feedbacks
        $totalCourseFeedbacks = CourseFeedback::count();
        $activeCourseFeedbacks = CourseFeedback::where('status', 'active')->count();

        // Statistics - Teachers
        $totalTeachers = Teacher::count();
        $activeTeachers = Teacher::where('status', 'active')->count();

        // Statistics - Testimonials
        $totalTestimonials = Testimonial::count();
        $activeTestimonials = Testimonial::where('status', 'active')->count();

        // Statistics - Sliders
        $totalSliders = Slider::count();
        $activeSliders = Slider::where('status', 'active')->count();

        // Statistics - FAQs
        $totalFaqs = Faq::count();
        $activeFaqs = Faq::where('status', 'active')->count();

        // Statistics - Subscribers
        $totalSubscribers = Subscriber::count();
        $recentSubscribers = Subscriber::where('created_at', '>=', now()->subDays(30))->count();

        // Statistics - Contacts
        $totalContacts = Contact::count();
        $unreadContacts = Contact::where('is_read', false)->count();

        // Statistics - Redirects
        $totalRedirects = Redirect::count();
        $activeRedirects = Redirect::where('status', 'active')->count();
        $totalRedirectHits = Redirect::sum('hit_count');

        // Statistics - SEO Pages
        $totalSeoPages = SeoPage::count();
        $activeSeoPages = SeoPage::where('status', 'active')->count();

        // Recent Items
        $recentCategories = Category::latest()->take(5)->get();
        $recentCourses = Course::latest()->take(5)->get();
        $recentBlogs = Blog::latest()->take(5)->get();
        $recentEventBookings = EventBooking::with('event')->latest()->take(5)->get();

        // Chart data - Categories created per month (last 6 months)
        $categoriesChartData = Category::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        return view('dashboard.pages.index', compact(
            'totalCategories',
            'activeCategories',
            'totalUsers',
            'adminUsers',
            'totalCourses',
            'activeCourses',
            'homepageCourses',
            'totalBlogs',
            'publishedBlogs',
            'totalEvents',
            'activeEvents',
            'upcomingEvents',
            'totalEventBookings',
            'pendingEventBookings',
            'totalCourseBookings',
            'pendingCourseBookings',
            'totalCourseFeedbacks',
            'activeCourseFeedbacks',
            'totalTeachers',
            'activeTeachers',
            'totalTestimonials',
            'activeTestimonials',
            'totalSliders',
            'activeSliders',
            'totalFaqs',
            'activeFaqs',
            'totalSubscribers',
            'recentSubscribers',
            'totalContacts',
            'unreadContacts',
            'totalRedirects',
            'activeRedirects',
            'totalRedirectHits',
            'totalSeoPages',
            'activeSeoPages',
            'recentCategories',
            'recentCourses',
            'recentBlogs',
            'recentEventBookings',
            'categoriesChartData',
            'availablePages',
            'user'
        ));
    }

    /**
     * Get available pages based on user permissions
     */
    private function getAvailablePages($user)
    {
        $pages = [];

        // Dashboard access
        if ($user->isAdmin() || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Dashboard',
                'route' => 'admin.dashboard',
                'icon' => 'ti-smart-home',
                'description' => 'View dashboard statistics'
            ];
        }

        // Categories
        if ($user->isAdmin() || $user->hasPermission('categories.view') || $user->hasPermission('categories.manage')) {
            $pages[] = [
                'name' => 'Categories',
                'route' => 'admin.categories.index',
                'icon' => 'ti-category',
                'description' => 'Manage categories'
            ];
        }

        // Courses
        if ($user->isAdmin() || $user->hasPermission('courses.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Courses',
                'route' => 'admin.courses.index',
                'icon' => 'ti-school',
                'description' => 'Manage courses'
            ];
        }

        // Blog Categories
        if ($user->isAdmin() || $user->hasPermission('blog-categories.manage') || $user->hasPermission('blogs.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Blog Categories',
                'route' => 'admin.blog-categories.index',
                'icon' => 'ti-category',
                'description' => 'Manage blog categories'
            ];
        }

        // Blogs
        if ($user->isAdmin() || $user->hasPermission('blogs.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Blogs',
                'route' => 'admin.blogs.index',
                'icon' => 'ti-article',
                'description' => 'Manage blogs'
            ];
        }

        // Events
        if ($user->isAdmin() || $user->hasPermission('events.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Events',
                'route' => 'admin.events.index',
                'icon' => 'ti-calendar-event',
                'description' => 'Manage events'
            ];
        }

        // Event Bookings
        if ($user->isAdmin() || $user->hasPermission('event-bookings.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Event Bookings',
                'route' => 'admin.event-bookings.index',
                'icon' => 'ti-ticket',
                'description' => 'View event bookings'
            ];
        }

        // Course Bookings
        if ($user->isAdmin() || $user->hasPermission('bookings.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Course Bookings',
                'route' => 'admin.bookings.index',
                'icon' => 'ti-calendar',
                'description' => 'View course bookings'
            ];
        }

        // Teachers
        if ($user->isAdmin() || $user->hasPermission('teachers.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Teachers',
                'route' => 'admin.teachers.index',
                'icon' => 'ti-user',
                'description' => 'Manage teachers'
            ];
        }

        // Testimonials
        if ($user->isAdmin() || $user->hasPermission('testimonials.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Testimonials',
                'route' => 'admin.testimonials.index',
                'icon' => 'ti-message-circle',
                'description' => 'Manage testimonials'
            ];
        }

        // Sliders
        if ($user->isAdmin() || $user->hasPermission('sliders.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Sliders',
                'route' => 'admin.sliders.index',
                'icon' => 'ti-photo',
                'description' => 'Manage sliders'
            ];
        }

        // FAQs
        if ($user->isAdmin() || $user->hasPermission('faqs.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'FAQs',
                'route' => 'admin.faqs.index',
                'icon' => 'ti-help',
                'description' => 'Manage FAQs'
            ];
        }

        // About Sections
        if ($user->isAdmin() || $user->hasPermission('about-sections.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'About Sections',
                'route' => 'admin.about-sections.index',
                'icon' => 'ti-info-circle',
                'description' => 'Manage about sections'
            ];
        }

        // About Infos
        if ($user->isAdmin() || $user->hasPermission('about-infos.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'About Infos',
                'route' => 'admin.about-infos.index',
                'icon' => 'ti-book-2',
                'description' => 'Manage about infos'
            ];
        }

        // Partners
        if ($user->isAdmin() || $user->hasPermission('partners.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Partners',
                'route' => 'admin.partners.index',
                'icon' => 'ti-building-store',
                'description' => 'Manage partners'
            ];
        }

        // Pricing Plans
        if ($user->isAdmin() || $user->hasPermission('pricing-plans.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Pricing Plans',
                'route' => 'admin.pricing-plans.index',
                'icon' => 'ti-currency-dollar',
                'description' => 'Manage pricing plans'
            ];
        }

        // Course Feedbacks
        if ($user->isAdmin() || $user->hasPermission('course-feedbacks.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Course Feedbacks',
                'route' => 'admin.course-feedbacks.index',
                'icon' => 'ti-message-circle-2',
                'description' => 'Manage course feedbacks'
            ];
        }

        // Counters
        if ($user->isAdmin() || $user->hasPermission('counters.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Counters',
                'route' => 'admin.counters.index',
                'icon' => 'ti-chart-bar',
                'description' => 'Manage counters'
            ];
        }

        // Contacts
        if ($user->isAdmin() || $user->hasPermission('contacts.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Contacts',
                'route' => 'admin.contacts.index',
                'icon' => 'ti-mail',
                'description' => 'View contact messages'
            ];
        }

        // Subscribers
        if ($user->isAdmin() || $user->hasPermission('subscribers.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Subscribers',
                'route' => 'admin.subscribers.index',
                'icon' => 'ti-mailbox',
                'description' => 'View subscribers'
            ];
        }

        // Redirects
        if ($user->isAdmin() || $user->hasPermission('redirects.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'URL Redirects',
                'route' => 'admin.redirects.index',
                'icon' => 'ti-external-link',
                'description' => 'Manage URL redirects'
            ];
        }

        // SEO Management
        if ($user->isAdmin() || $user->hasPermission('seo.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'SEO Management',
                'route' => 'admin.seo-pages.index',
                'icon' => 'ti-seo',
                'description' => 'Manage SEO settings for pages'
            ];
        }

        // Settings
        if ($user->isAdmin() || $user->hasPermission('settings.manage') || $user->hasPermission('dashboard.access')) {
            $pages[] = [
                'name' => 'Settings',
                'route' => 'admin.settings.index',
                'icon' => 'ti-settings',
                'description' => 'Manage website settings'
            ];
        }

        // Users & Roles (only for admin or users with these permissions)
        if ($user->isAdmin() || $user->hasPermission('users.manage') || $user->hasPermission('roles.manage')) {
            if ($user->isAdmin() || $user->hasPermission('users.manage')) {
                $pages[] = [
                    'name' => 'Users',
                    'route' => 'admin.users.index',
                    'icon' => 'ti-users',
                    'description' => 'Manage users'
                ];
            }
            if ($user->isAdmin() || $user->hasPermission('roles.manage')) {
                $pages[] = [
                    'name' => 'Roles',
                    'route' => 'admin.roles.index',
                    'icon' => 'ti-shield',
                    'description' => 'Manage roles'
                ];
            }
        }

        return $pages;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
