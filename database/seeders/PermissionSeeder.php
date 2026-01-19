<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'Dashboard Access',
                'slug' => 'dashboard.access',
                'description' => 'Access to dashboard',
                'status' => 'active',
            ],
            [
                'name' => 'Categories Management',
                'slug' => 'categories.manage',
                'description' => 'Full access to categories management',
                'status' => 'active',
            ],
            [
                'name' => 'Categories View',
                'slug' => 'categories.view',
                'description' => 'View categories',
                'status' => 'active',
            ],
            [
                'name' => 'Categories Create',
                'slug' => 'categories.create',
                'description' => 'Create new categories',
                'status' => 'active',
            ],
            [
                'name' => 'Categories Edit',
                'slug' => 'categories.edit',
                'description' => 'Edit existing categories',
                'status' => 'active',
            ],
            [
                'name' => 'Categories Delete',
                'slug' => 'categories.delete',
                'description' => 'Delete categories',
                'status' => 'active',
            ],
            [
                'name' => 'Sub Categories Management',
                'slug' => 'sub-categories.manage',
                'description' => 'Full access to sub categories management',
                'status' => 'active',
            ],
            [
                'name' => 'Sub Categories View',
                'slug' => 'sub-categories.view',
                'description' => 'View sub categories',
                'status' => 'active',
            ],
            [
                'name' => 'Sub Categories Create',
                'slug' => 'sub-categories.create',
                'description' => 'Create new sub categories',
                'status' => 'active',
            ],
            [
                'name' => 'Sub Categories Edit',
                'slug' => 'sub-categories.edit',
                'description' => 'Edit existing sub categories',
                'status' => 'active',
            ],
            [
                'name' => 'Sub Categories Delete',
                'slug' => 'sub-categories.delete',
                'description' => 'Delete sub categories',
                'status' => 'active',
            ],
            [
                'name' => 'Users Management',
                'slug' => 'users.manage',
                'description' => 'Full access to users management',
                'status' => 'active',
            ],
            [
                'name' => 'Roles Management',
                'slug' => 'roles.manage',
                'description' => 'Full access to roles management',
                'status' => 'active',
            ],
            [
                'name' => 'Permissions Management',
                'slug' => 'permissions.manage',
                'description' => 'Full access to permissions management',
                'status' => 'active',
            ],
            [
                'name' => 'Courses Management',
                'slug' => 'courses.manage',
                'description' => 'Full access to courses management',
                'status' => 'active',
            ],
            [
                'name' => 'Blog Categories Management',
                'slug' => 'blog-categories.manage',
                'description' => 'Full access to blog categories management',
                'status' => 'active',
            ],
            [
                    'name' => 'Settings Management',
                'slug' => 'settings.manage',
                'description' => 'Full access to website settings management',
                'status' => 'active',
            ],
            [
                'name' => 'Blogs Management',
                'slug' => 'blogs.manage',
                'description' => 'Full access to blogs management',
                'status' => 'active',
            ],
            [
                'name' => 'Events Management',
                'slug' => 'events.manage',
                'description' => 'Full access to events management',
                'status' => 'active',
            ],
            [
                'name' => 'Event Bookings Management',
                'slug' => 'event-bookings.manage',
                'description' => 'Full access to event bookings management',
                'status' => 'active',
            ],
            [
                'name' => 'Course Bookings Management',
                'slug' => 'bookings.manage',
                'description' => 'Full access to course bookings management',
                'status' => 'active',
            ],
            [
                'name' => 'Course Feedbacks Management',
                'slug' => 'course-feedbacks.manage',
                'description' => 'Full access to course feedbacks management',
                'status' => 'active',
            ],
            [
                'name' => 'Teachers Management',
                'slug' => 'teachers.manage',
                'description' => 'Full access to teachers management',
                'status' => 'active',
            ],
            [
                'name' => 'Testimonials Management',
                'slug' => 'testimonials.manage',
                'description' => 'Full access to testimonials management',
                'status' => 'active',
            ],
            [
                'name' => 'Sliders Management',
                'slug' => 'sliders.manage',
                'description' => 'Full access to sliders management',
                'status' => 'active',
            ],
            [
                'name' => 'FAQs Management',
                'slug' => 'faqs.manage',
                'description' => 'Full access to FAQs management',
                'status' => 'active',
            ],
            [
                'name' => 'About Sections Management',
                'slug' => 'about-sections.manage',
                'description' => 'Full access to about sections management',
                'status' => 'active',
            ],
            [
                'name' => 'About Infos Management',
                'slug' => 'about-infos.manage',
                'description' => 'Full access to about infos management',
                'status' => 'active',
            ],
            [
                'name' => 'Pricing Plans Management',
                'slug' => 'pricing-plans.manage',
                'description' => 'Full access to pricing plans management',
                'status' => 'active',
            ],
            [
                'name' => 'Partners Management',
                'slug' => 'partners.manage',
                'description' => 'Full access to partners management',
                'status' => 'active',
            ],
            [
                'name' => 'Counters Management',
                'slug' => 'counters.manage',
                'description' => 'Full access to counters management',
                'status' => 'active',
            ],
            [
                'name' => 'Contacts Management',
                'slug' => 'contacts.manage',
                'description' => 'Full access to contacts management',
                'status' => 'active',
            ],
            [
                'name' => 'Subscribers Management',
                'slug' => 'subscribers.manage',
                'description' => 'Full access to subscribers management',
                'status' => 'active',
            ],
            [
                'name' => 'Redirects Management',
                'slug' => 'redirects.manage',
                'description' => 'Full access to URL redirects management',
                'status' => 'active',
            ],
            [
                'name' => 'SEO Management',
                'slug' => 'seo.manage',
                'description' => 'Full access to SEO pages management',
                'status' => 'active',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['slug' => $permission['slug']],
                $permission
            );
        }

        $this->command->info('Permissions seeded successfully!');
    }
}
