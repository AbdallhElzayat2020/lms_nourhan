<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route(auth()->user()->isAdmin() || auth()->user()->hasPermission('dashboard.access') ? 'admin.dashboard' : 'frontend.home') }}"
            class="app-brand-link fs-4">
            Sister Nourhan
            {{-- <img src="{{ asset('assets/frontend/img/favicon.png') }}" alt=""> --}}
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.dashboard'], 'active open') }}">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div data-i18n="Home">Home</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('categories.view') || auth()->user()->hasPermission('categories.manage'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.categories.*'], 'active') }}">
                <a href="{{ route('admin.categories.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-category"></i>
                    <div data-i18n="Categories">Categories</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->isAdmin() ||
                auth()->user()->hasPermission('users.manage') ||
                auth()->user()->hasPermission('roles.manage'))
            <li
                class="menu-item {{ \App\Helpers\setSidebarActive(['admin.users.*', 'admin.roles.*'], 'active open') }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-shield-lock"></i>
                    <div data-i18n="Users & Roles">Users & Roles</div>
                </a>
                <ul class="menu-sub">
                    @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('users.manage'))
                        <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.users.*'], 'active') }}">
                            <a href="{{ route('admin.users.index') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-users"></i>
                                <div data-i18n="Users">Users</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('roles.manage'))
                        <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.roles.*'], 'active') }}">
                            <a href="{{ route('admin.roles.index') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-shield"></i>
                                <div data-i18n="Roles">Roles</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->isAdmin() ||
                auth()->user()->hasPermission('sliders.manage') ||
                auth()->user()->hasPermission('testimonials.manage') ||
                auth()->user()->hasPermission('faqs.manage') ||
                auth()->user()->hasPermission('about-sections.manage') ||
                auth()->user()->hasPermission('about-infos.manage') ||
                auth()->user()->hasPermission('dashboard.access'))
            <li
                class="menu-item {{ \App\Helpers\setSidebarActive(['admin.sliders.*', 'admin.testimonials.*', 'admin.faqs.*', 'admin.about-sections.*', 'admin.about-infos.*'], 'active open') }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-settings"></i>
                    <div data-i18n="Website Settings">Website Settings</div>
                </a>
                <ul class="menu-sub">
                    @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('sliders.manage') || auth()->user()->hasPermission('dashboard.access'))
                        <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.sliders.*'], 'active') }}">
                            <a href="{{ route('admin.sliders.index') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-photo"></i>
                                <div data-i18n="Sliders">Sliders</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('testimonials.manage') || auth()->user()->hasPermission('dashboard.access'))
                        <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.testimonials.*'], 'active') }}">
                            <a href="{{ route('admin.testimonials.index') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-message-circle"></i>
                                <div data-i18n="Testimonials">Testimonials</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('faqs.manage') || auth()->user()->hasPermission('dashboard.access'))
                        <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.faqs.*'], 'active') }}">
                            <a href="{{ route('admin.faqs.index') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-help"></i>
                                <div data-i18n="FAQs">FAQs</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('about-sections.manage') || auth()->user()->hasPermission('dashboard.access'))
                        <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.about-sections.*'], 'active') }}">
                            <a href="{{ route('admin.about-sections.index') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-info-circle"></i>
                                <div data-i18n="About Section">About Section</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('about-infos.manage') || auth()->user()->hasPermission('dashboard.access'))
                        <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.about-infos.*'], 'active') }}">
                            <a href="{{ route('admin.about-infos.index') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-book-2"></i>
                                <div data-i18n="History/Mission/Vision">History / Mission / Vision</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('settings.manage') || auth()->user()->hasPermission('dashboard.access'))
                        <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.why-choose-items.*'], 'active') }}">
                            <a href="{{ route('admin.why-choose-items.index') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-bolt"></i>
                                <div data-i18n="Why Choose Us">Why Choose Us</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('teachers.manage') || auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.teachers.*'], 'active') }}">
                <a href="{{ route('admin.teachers.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-user"></i>
                    <div data-i18n="Teachers">Teachers</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('partners.manage') || auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.partners.*'], 'active') }}">
                <a href="{{ route('admin.partners.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-building-store"></i>
                    <div data-i18n="Partners">Partners</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('courses.manage') || auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.courses.*'], 'active') }}">
                <a href="{{ route('admin.courses.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-school"></i>
                    <div data-i18n="Courses">Courses</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('settings.manage') || auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.settings.*'], 'active') }}">
                <a href="{{ route('admin.settings.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-settings"></i>
                    <div data-i18n="Settings">Settings</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('redirects.manage') || auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.redirects.*'], 'active') }}">
                <a href="{{ route('admin.redirects.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-external-link"></i>
                    <div data-i18n="Redirects">URL Redirects</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->isAdmin() ||
                auth()->user()->hasPermission('blog-categories.manage') ||
                auth()->user()->hasPermission('blogs.manage') ||
                auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.blog-categories.*', 'admin.blogs.*'], 'active open') }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-news"></i>
                    <div data-i18n="Blogs">Blogs</div>
                </a>
                <ul class="menu-sub">
                    @if (auth()->user()->isAdmin() ||
                            auth()->user()->hasPermission('blog-categories.manage') ||
                            auth()->user()->hasPermission('blogs.manage') ||
                            auth()->user()->hasPermission('dashboard.access'))
                        <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.blog-categories.*'], 'active') }}">
                            <a href="{{ route('admin.blog-categories.index') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-category"></i>
                                <div data-i18n="Blog Categories">Blog Categories</div>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->isAdmin() ||
                            auth()->user()->hasPermission('blogs.manage') ||
                            auth()->user()->hasPermission('dashboard.access'))
                        <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.blogs.*'], 'active') }}">
                            <a href="{{ route('admin.blogs.index') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-article"></i>
                                <div data-i18n="Blogs">Blogs</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('course-feedbacks.manage') || auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.course-feedbacks.*'], 'active') }}">
                <a href="{{ route('admin.course-feedbacks.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-message-circle-2"></i>
                    <div data-i18n="Course Feedbacks">Course Feedbacks</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('events.manage') || auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.events.*'], 'active') }}">
                <a href="{{ route('admin.events.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-calendar-event"></i>
                    <div data-i18n="Events">Events</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('event-bookings.manage') || auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.event-bookings.*'], 'active') }}">
                <a href="{{ route('admin.event-bookings.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-ticket"></i>
                    <div data-i18n="Event Bookings">Event Bookings</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('bookings.manage') || auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.bookings.*'], 'active') }}">
                <a href="{{ route('admin.bookings.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-calendar"></i>
                    <div data-i18n="Course Bookings">Course Bookings</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('pricing-plans.manage') || auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.pricing-plans.*'], 'active') }}">
                <a href="{{ route('admin.pricing-plans.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-currency-dollar"></i>
                    <div data-i18n="Pricing Plans">Pricing Plans</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('counters.manage') || auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.counters.*'], 'active') }}">
                <a href="{{ route('admin.counters.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-chart-bar"></i>
                    <div data-i18n="Counters">Counters</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('contacts.manage') || auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.contacts.*'], 'active') }}">
                <a href="{{ route('admin.contacts.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-mail"></i>
                    <div data-i18n="Contacts">Contacts</div>
                    @if (isset($unreadContactsCount) && $unreadContactsCount > 0)
                        <span class="badge rounded-pill bg-label-danger ms-auto">{{ $unreadContactsCount }}</span>
                    @endif
                </a>
            </li>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('subscribers.manage') || auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.subscribers.*'], 'active') }}">
                <a href="{{ route('admin.subscribers.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-mailbox"></i>
                    <div data-i18n="Subscribers">Subscribers</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->hasPermission('seo.manage') || auth()->user()->hasPermission('dashboard.access'))
            <li class="menu-item {{ \App\Helpers\setSidebarActive(['admin.seo-pages.*'], 'active') }}">
                <a href="{{ route('admin.seo-pages.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-seo"></i>
                    <div data-i18n="SEO Management">SEO Management</div>
                </a>
            </li>
        @endif

    </ul>
</aside>
