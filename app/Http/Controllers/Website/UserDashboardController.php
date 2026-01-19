<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        // Get user permissions
        $permissions = $user->getPermissions();

        // Define available pages based on permissions
        $availablePages = [];

        // Dashboard access
        if ($user->isAdmin() || $user->hasPermission('dashboard.access')) {
            $availablePages[] = [
                'name' => 'Admin Dashboard',
                'route' => 'admin.dashboard',
                'icon' => 'fa-dashboard',
                'description' => 'Access admin panel'
            ];
        }

        // Categories
        if ($user->isAdmin() || $user->hasPermission('categories.view') || $user->hasPermission('categories.manage')) {
            $availablePages[] = [
                'name' => 'Categories',
                'route' => 'admin.categories.index',
                'icon' => 'fa-category',
                'description' => 'Manage categories'
            ];
        }

        // Courses
        if ($user->isAdmin() || $user->hasPermission('courses.manage') || $user->hasPermission('dashboard.access')) {
            $availablePages[] = [
                'name' => 'Courses',
                'route' => 'admin.courses.index',
                'icon' => 'fa-school',
                'description' => 'Manage courses'
            ];
        }

        // Blogs
        if ($user->isAdmin() || $user->hasPermission('blogs.manage') || $user->hasPermission('dashboard.access')) {
            $availablePages[] = [
                'name' => 'Blogs',
                'route' => 'admin.blogs.index',
                'icon' => 'fa-article',
                'description' => 'Manage blogs'
            ];
        }

        // Blog Categories
        if ($user->isAdmin() || $user->hasPermission('blog-categories.manage') || $user->hasPermission('blogs.manage') || $user->hasPermission('dashboard.access')) {
            $availablePages[] = [
                'name' => 'Blog Categories',
                'route' => 'admin.blog-categories.index',
                'icon' => 'fa-category',
                'description' => 'Manage blog categories'
            ];
        }

        // Events
        if ($user->isAdmin() || $user->hasPermission('events.manage') || $user->hasPermission('dashboard.access')) {
            $availablePages[] = [
                'name' => 'Events',
                'route' => 'admin.events.index',
                'icon' => 'fa-calendar-event',
                'description' => 'Manage events'
            ];
        }

        // Teachers
        if ($user->isAdmin() || $user->hasPermission('teachers.manage') || $user->hasPermission('dashboard.access')) {
            $availablePages[] = [
                'name' => 'Teachers',
                'route' => 'admin.teachers.index',
                'icon' => 'fa-user',
                'description' => 'Manage teachers'
            ];
        }

        // Contacts
        if ($user->isAdmin() || $user->hasPermission('contacts.manage') || $user->hasPermission('dashboard.access')) {
            $availablePages[] = [
                'name' => 'Contacts',
                'route' => 'admin.contacts.index',
                'icon' => 'fa-mail',
                'description' => 'View contact messages'
            ];
        }

        // Bookings
        if ($user->isAdmin() || $user->hasPermission('bookings.manage') || $user->hasPermission('dashboard.access')) {
            $availablePages[] = [
                'name' => 'Course Bookings',
                'route' => 'admin.bookings.index',
                'icon' => 'fa-calendar',
                'description' => 'View course bookings'
            ];
        }

        // Event Bookings
        if ($user->isAdmin() || $user->hasPermission('event-bookings.manage') || $user->hasPermission('dashboard.access')) {
            $availablePages[] = [
                'name' => 'Event Bookings',
                'route' => 'admin.event-bookings.index',
                'icon' => 'fa-ticket',
                'description' => 'View event bookings'
            ];
        }

        return view('frontend.pages.user-dashboard', compact('user', 'availablePages', 'permissions'));
    }
}
