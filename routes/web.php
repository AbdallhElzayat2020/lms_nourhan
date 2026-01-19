<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\{
    HomeController,
    AboutController,
    CoursesController,
    PricingController,
    BlogController,
    ContactController,
    TeachersController,
    EventsController,
    BookController,
    SuccessSendController,
    TestimonialController as WebsiteTestimonialController,
    SubscriberController,
    BookingController,
    EventBookingController,
    CourseFeedbackController,
    CourseController,
    CategoryController,
};

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::prefix('')->name('frontend.')->group(function () {
    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Test Error Pages (only in development)
    if (app()->environment('local')) {
        Route::get('/test-404', function () {
            abort(404);
        });
        Route::get('/test-403', function () {
            abort(403);
        });
        Route::get('/test-500', function () {
            abort(500);
        });
        Route::get('/test-419', function () {
            abort(419);
        });
        Route::get('/test-503', function () {
            abort(503);
        });

    }

    // About
    Route::get('/about', [AboutController::class, 'index'])->name('about');

    // Courses (Old - keep for backward compatibility if needed)
    // Route::get('/courses', [CoursesController::class, 'index'])->name('courses');
    // Route::get('/course-details', [CoursesController::class, 'show'])->name('course.details');

    // New Courses Routes
    Route::get('/courses', [CourseController::class, 'index'])->name('courses');
    Route::get('/course/{slug}', [CourseController::class, 'show'])->name('course.details');

    // Categories
    Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.details');

    // Pricing
    Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');

    // Blog
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.details');

    // Teachers
    Route::get('/teachers', [TeachersController::class, 'index'])->name('teachers');
    Route::get('/teachers/{slug}', [TeachersController::class, 'show'])->name('teacher.details');

    // Events
    Route::get('/events', [EventsController::class, 'index'])->name('events');
    Route::get('/event-details/{slug}', [EventsController::class, 'show'])->name('event.details');

    // Course Feedbacks
    Route::get('/course-feedbacks', [CourseFeedbackController::class, 'index'])->name('course-feedbacks');
    Route::get('/event-booking/{slug}', [EventBookingController::class, 'create'])->name('event.booking');
    Route::post('/event-booking/{slug}', [EventBookingController::class, 'store'])->name('event.booking.store');

    // Contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    // Book
    Route::get('/book', [BookController::class, 'index'])->name('book');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

    // Success Send
    Route::get('/success-send', [SuccessSendController::class, 'index'])->name('success.send');

    // Public Testimonials (feedback form)
    Route::get('/testimonials/share', [WebsiteTestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials/share', [WebsiteTestimonialController::class, 'store'])->name('testimonials.store');

    // Subscribe Newsletter
    Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('')->name('frontend.')->group(function () {
    // User Dashboard - for non-admin users
    Route::get('/user/dashboard', [\App\Http\Controllers\Website\UserDashboardController::class, 'index'])
        ->name('user.dashboard');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
