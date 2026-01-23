<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\{
    HomeController,
    CategoryController,
    ProfileController as DashboardProfileController,
    UserController,
    RoleController,
    ContactController,
    SubscriberController,
    SliderController,
    TestimonialController,
    FaqController,
    CountryController,
    StateController,
    BlogController,
    BlogCategoryController,
    AboutSectionController,
    TeacherController,
    PartnerController,
    CounterController,
    AboutInfoController,
    PricingPlanController,
    BookingController,
    EventController,
    EventBookingController,
    CourseFeedbackController,
    CourseController,
    SettingController,
    WhyChooseItemController,
    RedirectController,
    SeoPageController,
};

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard - accessible to admin or users with any permissions
    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('dashboard');

    // Categories Routes - requires categories permissions
    Route::middleware('permission:categories.view')->group(function () {
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('categories/create', [CategoryController::class, 'create'])->middleware('permission:categories.create')->name('categories.create');
        Route::post('categories', [CategoryController::class, 'store'])->middleware('permission:categories.create')->name('categories.store');
        Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->middleware('permission:categories.edit')->name('categories.edit');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->middleware('permission:categories.edit')->name('categories.update');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->middleware('permission:categories.delete')->name('categories.destroy');
    });

    // Profile Routes - accessible to all authenticated users
    Route::get('/profile', [DashboardProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [DashboardProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [DashboardProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Users Routes - requires users.manage permission
    Route::middleware('permission:users.manage')->group(function () {
        Route::resource('users', UserController::class);
    });

    // Roles Routes - requires roles.manage permission
    Route::middleware('permission:roles.manage')->group(function () {
        Route::resource('roles', RoleController::class);
    });

    // Contacts Routes - requires contacts.manage or dashboard.access permission
    Route::middleware('permission:contacts.manage|dashboard.access')->group(function () {
        Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
        Route::post('contacts/{id}/mark-read', [ContactController::class, 'markAsRead'])->name('contacts.mark-read');
        Route::post('contacts/{id}/mark-unread', [ContactController::class, 'markAsUnread'])->name('contacts.mark-unread');
    });

    // Subscribers Routes - requires subscribers.manage or dashboard.access permission
    Route::middleware('permission:subscribers.manage|dashboard.access')->group(function () {
        Route::resource('subscribers', SubscriberController::class)->only(['index', 'destroy']);
        Route::patch('subscribers/{subscriber}/toggle-status', [SubscriberController::class, 'toggleStatus'])->name('subscribers.toggle-status');
    });

    // Sliders Routes - requires sliders.manage or dashboard.access permission
    Route::middleware('permission:sliders.manage|dashboard.access')->group(function () {
        Route::resource('sliders', SliderController::class);
    });

    // Testimonials Routes - requires testimonials.manage or dashboard.access permission
    Route::middleware('permission:testimonials.manage|dashboard.access')->group(function () {
        Route::resource('testimonials', TestimonialController::class);
    });

    // FAQs Routes - requires faqs.manage or dashboard.access permission
    Route::middleware('permission:faqs.manage|dashboard.access')->group(function () {
        Route::resource('faqs', FaqController::class);
    });

    // Blog Categories Routes - requires blog-categories.manage or blogs.manage or dashboard.access permission
    Route::middleware('permission:blog-categories.manage|blogs.manage|dashboard.access')->group(function () {
        Route::resource('blog-categories', BlogCategoryController::class);
    });

    // Blogs Routes - requires blogs.manage or dashboard.access permission
    Route::middleware('permission:blogs.manage|dashboard.access')->group(function () {
        Route::resource('blogs', BlogController::class);
    });

    // Counters Routes - requires counters.manage or dashboard.access permission
    Route::middleware('permission:counters.manage|dashboard.access')->group(function () {
        Route::resource('counters', CounterController::class)->except(['show']);
    });

    // About Infos Routes - requires about-infos.manage or dashboard.access permission
    Route::middleware('permission:about-infos.manage|dashboard.access')->group(function () {
        Route::resource('about-infos', AboutInfoController::class)->except(['show']);
    });

    // About Section Routes - requires about-sections.manage or dashboard.access permission
    Route::middleware('permission:about-sections.manage|dashboard.access')->group(function () {
        Route::get('about-sections', [AboutSectionController::class, 'index'])->name('about-sections.index');
        Route::get('about-sections/{aboutSection}/edit', [AboutSectionController::class, 'edit'])->name('about-sections.edit');
        Route::put('about-sections/{aboutSection}', [AboutSectionController::class, 'update'])->name('about-sections.update');
    });

    // Teachers Routes - requires teachers.manage or dashboard.access permission
    Route::middleware('permission:teachers.manage|dashboard.access')->group(function () {
        Route::resource('teachers', TeacherController::class);
    });

    // Partners Routes - requires partners.manage or dashboard.access permission
    Route::middleware('permission:partners.manage|dashboard.access')->group(function () {
        Route::resource('partners', PartnerController::class);
    });

    // Pricing Plans Routes - requires pricing-plans.manage or dashboard.access permission
    Route::middleware('permission:pricing-plans.manage|dashboard.access')->group(function () {
        Route::resource('pricing-plans', PricingPlanController::class);
    });

    // Bookings Routes - requires bookings.manage or dashboard.access permission
    Route::middleware('permission:bookings.manage|dashboard.access')->group(function () {
        Route::resource('bookings', BookingController::class)->except(['create', 'edit']);
    });

    // Events Routes - requires events.manage or dashboard.access permission
    Route::middleware('permission:events.manage|dashboard.access')->group(function () {
        Route::resource('events', EventController::class);
    });

    // Event Bookings Routes - requires event-bookings.manage or dashboard.access permission
    Route::middleware('permission:event-bookings.manage|dashboard.access')->group(function () {
        Route::resource('event-bookings', EventBookingController::class)->except(['create', 'edit', 'update']);
        Route::post('event-bookings/{eventBooking}/update-status', [EventBookingController::class, 'updateStatus'])->name('event-bookings.update-status');
    });

    // Course Feedbacks Routes - requires course-feedbacks.manage or dashboard.access permission
    Route::middleware('permission:course-feedbacks.manage|dashboard.access')->group(function () {
        Route::resource('course-feedbacks', CourseFeedbackController::class);
    });

    // Courses Routes - requires courses.manage or dashboard.access permission
    Route::middleware('permission:courses.manage|dashboard.access')->group(function () {
        Route::resource('courses', CourseController::class);
    });

    // Settings Routes - requires settings.manage or dashboard.access permission
    Route::middleware('permission:settings.manage|dashboard.access')->group(function () {
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

        // Why Choose Us (part of Website Settings) - Edit only, no create/delete
        Route::get('why-choose-items', [WhyChooseItemController::class, 'index'])->name('why-choose-items.index');
        Route::get('why-choose-items/{whyChooseItem}/edit', [WhyChooseItemController::class, 'edit'])->name('why-choose-items.edit');
        Route::put('why-choose-items/{whyChooseItem}', [WhyChooseItemController::class, 'update'])->name('why-choose-items.update');
    });

    // Redirects Routes - requires redirects.manage or dashboard.access permission
    Route::middleware('permission:redirects.manage|dashboard.access')->group(function () {
        Route::resource('redirects', RedirectController::class);
    });

    // SEO Pages Routes - requires seo.manage or dashboard.access permission
    Route::middleware('permission:seo.manage|dashboard.access')->group(function () {
        Route::resource('seo-pages', SeoPageController::class);
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
