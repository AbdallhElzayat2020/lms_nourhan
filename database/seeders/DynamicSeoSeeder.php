<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\Category;
use App\Models\Course;
use App\Models\Event;
use App\Models\PricingPlan;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DynamicSeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedTeachersSeo();
        $this->seedCategoriesSeo();
        $this->seedCoursesSeo();
        $this->seedEventsSeo();
        $this->seedPricingPlansSeo();
        $this->seedBlogsSeo();
        $this->seedBlogCategoriesSeo();

        $this->command->info('Dynamic SEO data seeded successfully!');
    }

    private function seedTeachersSeo()
    {
        $teachers = Teacher::all();

        foreach ($teachers as $teacher) {
            if (!$teacher->meta_title) {
                $teacher->update([
                    'meta_title' => $teacher->name . ' - English Teacher at Nourhan Academy',
                    'meta_description' => 'Meet ' . $teacher->name . ', an experienced English teacher at Nourhan Academy. ' .
                                        ($teacher->short_description ? Str::limit($teacher->short_description, 100) : 'Learn English with our certified instructor.'),
                    'meta_keywords' => 'English teacher, ' . $teacher->name . ', Nourhan Academy, English learning, language instructor',
                    'canonical_url' => route('frontend.teacher.details', $teacher->slug ?: $teacher->id),
                    'schema_block' => json_encode([
                        '@context' => 'https://schema.org',
                        '@type' => 'Person',
                        'name' => $teacher->name,
                        'jobTitle' => 'English Teacher',
                        'worksFor' => [
                            '@type' => 'Organization',
                            'name' => 'Nourhan Academy'
                        ],
                        'description' => $teacher->short_description ?: 'English teacher at Nourhan Academy',
                        'url' => route('frontend.teacher.details', $teacher->slug ?: $teacher->id)
                    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                ]);
            }
        }

        $this->command->info('Teachers SEO data seeded: ' . $teachers->count() . ' records');
    }

    private function seedCategoriesSeo()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            if (!$category->meta_title) {
                $category->update([
                    'meta_title' => $category->name . ' Courses - Nourhan Academy',
                    'meta_description' => 'Explore our ' . $category->name . ' courses at Nourhan Academy. ' .
                                        ($category->description ? Str::limit(strip_tags($category->description), 100) : 'Quality English learning programs.'),
                    'meta_keywords' => $category->name . ', courses, Nourhan Academy, English learning, training programs',
                    'canonical_url' => route('frontend.category.details', $category->slug),
                    'schema_block' => json_encode([
                        '@context' => 'https://schema.org',
                        '@type' => 'CourseCategory',
                        'name' => $category->name,
                        'description' => $category->description ? strip_tags($category->description) : $category->name . ' courses',
                        'provider' => [
                            '@type' => 'Organization',
                            'name' => 'Nourhan Academy'
                        ],
                        'url' => route('frontend.category.details', $category->slug)
                    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                ]);
            }
        }

        $this->command->info('Categories SEO data seeded: ' . $categories->count() . ' records');
    }

    private function seedCoursesSeo()
    {
        $courses = Course::with('category')->get();

        foreach ($courses as $course) {
            if (!$course->schema_block) {
                $course->update([
                    'canonical_url' => route('frontend.course.details', $course->slug),
                    'schema_block' => json_encode([
                        '@context' => 'https://schema.org',
                        '@type' => 'Course',
                        'name' => $course->title,
                        'description' => $course->short_description ?: $course->title,
                        'provider' => [
                            '@type' => 'Organization',
                            'name' => 'Nourhan Academy'
                        ],
                        'courseCategory' => $course->category->name ?? 'English Learning',
                        'educationalLevel' => 'Beginner to Advanced',
                        'teaches' => 'English Language Skills',
                        'url' => route('frontend.course.details', $course->slug),
                        'offers' => [
                            '@type' => 'Offer',
                            'category' => $course->course_type === 'free' ? 'Free' : 'Paid',
                            'availability' => 'InStock'
                        ]
                    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                ]);
            }
        }

        $this->command->info('Courses SEO data seeded: ' . $courses->count() . ' records');
    }

    private function seedEventsSeo()
    {
        $events = Event::all();

        foreach ($events as $event) {
            if (!$event->meta_title) {
                $event->update([
                    'meta_title' => $event->name . ' - Nourhan Academy Event',
                    'meta_description' => 'Join us for ' . $event->name . ' at Nourhan Academy. ' .
                                        ($event->short_description ? Str::limit($event->short_description, 100) : 'Educational event for English learners.'),
                    'meta_keywords' => 'event, ' . $event->name . ', Nourhan Academy, English learning, workshop',
                    'canonical_url' => route('frontend.event.details', $event->slug),
                    'schema_block' => json_encode([
                        '@context' => 'https://schema.org',
                        '@type' => 'Event',
                        'name' => $event->name,
                        'description' => $event->short_description ?: $event->name,
                        'startDate' => $event->start_date->format('Y-m-d'),
                        'endDate' => $event->end_date ? $event->end_date->format('Y-m-d') : $event->start_date->format('Y-m-d'),
                        'organizer' => [
                            '@type' => 'Organization',
                            'name' => 'Nourhan Academy'
                        ],
                        'location' => [
                            '@type' => 'Place',
                            'name' => $event->location ?: 'Nourhan Academy'
                        ],
                        'url' => route('frontend.event.details', $event->slug)
                    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                ]);
            }
        }

        $this->command->info('Events SEO data seeded: ' . $events->count() . ' records');
    }

    private function seedPricingPlansSeo()
    {
        $pricingPlans = PricingPlan::all();

        foreach ($pricingPlans as $plan) {
            if (!$plan->meta_title) {
                $plan->update([
                    'meta_title' => $plan->name . ' - Nourhan Academy Pricing',
                    'meta_description' => 'Choose our ' . $plan->name . ' plan for English learning at Nourhan Academy. ' .
                                        ($plan->description ? Str::limit(strip_tags($plan->description), 100) : 'Affordable pricing for quality education.'),
                    'meta_keywords' => 'pricing, ' . $plan->name . ', Nourhan Academy, English courses, fees',
                    'schema_block' => json_encode([
                        '@context' => 'https://schema.org',
                        '@type' => 'Offer',
                        'name' => $plan->name,
                        'description' => $plan->description ? strip_tags($plan->description) : $plan->name . ' pricing plan',
                        'price' => $plan->price,
                        'priceCurrency' => 'USD',
                        'priceValidUntil' => date('Y-m-d', strtotime('+1 year')),
                        'availability' => 'InStock',
                        'seller' => [
                            '@type' => 'Organization',
                            'name' => 'Nourhan Academy'
                        ]
                    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                ]);
            }
        }

        $this->command->info('Pricing Plans SEO data seeded: ' . $pricingPlans->count() . ' records');
    }

    private function seedBlogsSeo()
    {
        $blogs = Blog::with('blogCategory')->get();

        foreach ($blogs as $blog) {
            if (!$blog->schema_block) {
                $blog->update([
                    'canonical_url' => route('frontend.blog.details', $blog->slug),
                    'schema_block' => json_encode([
                        '@context' => 'https://schema.org',
                        '@type' => 'Article',
                        'headline' => $blog->title,
                        'description' => $blog->short_description ?: $blog->title,
                        'author' => [
                            '@type' => 'Person',
                            'name' => $blog->author ?: 'Sister Nourhan'
                        ],
                        'publisher' => [
                            '@type' => 'Organization',
                            'name' => 'Nourhan Academy'
                        ],
                        'datePublished' => $blog->published_at ? $blog->published_at->format('Y-m-d') : $blog->created_at->format('Y-m-d'),
                        'dateModified' => $blog->updated_at->format('Y-m-d'),
                        'articleSection' => $blog->blogCategory->name ?? 'English Learning',
                        'url' => route('frontend.blog.details', $blog->slug)
                    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                ]);
            }
        }

        $this->command->info('Blogs SEO data seeded: ' . $blogs->count() . ' records');
    }

    private function seedBlogCategoriesSeo()
    {
        $blogCategories = BlogCategory::all();

        foreach ($blogCategories as $category) {
            // Blog categories already have SEO fields, just update schema if missing
            if (!$category->schema_block) {
                $category->update([
                    'schema_block' => json_encode([
                        '@context' => 'https://schema.org',
                        '@type' => 'CollectionPage',
                        'name' => $category->name,
                        'description' => $category->description ? strip_tags($category->description) : $category->name . ' articles',
                        'publisher' => [
                            '@type' => 'Organization',
                            'name' => 'Nourhan Academy'
                        ],
                        'mainEntity' => [
                            '@type' => 'ItemList',
                            'name' => $category->name . ' Articles'
                        ]
                    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                ]);
            }
        }

        $this->command->info('Blog Categories SEO data seeded: ' . $blogCategories->count() . ' records');
    }
}
