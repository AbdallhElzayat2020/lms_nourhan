<?php

namespace Database\Seeders;

use App\Models\SeoPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeoPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seoPages = [
            [
                'page_name' => 'home',
                'page_title' => 'Home Page',
                'meta_title' => 'Nourhan Academy - Learn English & Travel Services',
                'meta_description' => 'Nourhan Academy for English language learning and travel services. Specialized training courses with the best certified instructors.',
                'meta_keywords' => 'English learning, English courses, travel, Nourhan Academy, language training',
                'canonical_url' => url('/'),
                'schema_markup' => json_encode([
                    '@context' => 'https://schema.org',
                    '@type' => 'EducationalOrganization',
                    'name' => 'Nourhan Academy',
                    'description' => 'English language learning and travel services academy',
                    'url' => url('/'),
                    'logo' => asset('assets/frontend/img/logo_horezntal.webp'),
                    'sameAs' => [
                        'https://facebook.com/nourhanacademy',
                        'https://instagram.com/nourhanacademy'
                    ],
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressCountry' => 'EG'
                    ],
                    'contactPoint' => [
                        '@type' => 'ContactPoint',
                        'telephone' => '+20-000-000-0000',
                        'contactType' => 'customer service'
                    ]
                ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
                'status' => 'active',
            ],
            [
                'page_name' => 'about',
                'page_title' => 'About Us',
                'meta_title' => 'About Nourhan Academy - Our Story & Mission',
                'meta_description' => 'Learn about Nourhan Academy\'s mission, vision, and commitment to excellence in English language education and travel services.',
                'meta_keywords' => 'about us, Nourhan Academy story, mission, vision, English education',
                'status' => 'active',
            ],
            [
                'page_name' => 'courses',
                'page_title' => 'Courses',
                'meta_title' => 'English Language Courses - Nourhan Academy',
                'meta_description' => 'Discover our diverse English language training courses with the best certified instructors.',
                'meta_keywords' => 'English courses, language learning, training courses, English classes',
                'status' => 'active',
            ],
            [
                'page_name' => 'teachers',
                'page_title' => 'Teachers',
                'meta_title' => 'Our Teaching Team - Nourhan Academy',
                'meta_description' => 'Meet our certified teaching team at Nourhan Academy and their expertise in English language education.',
                'meta_keywords' => 'teachers, English instructors, teaching team, certified teachers',
                'status' => 'active',
            ],
            [
                'page_name' => 'blog',
                'page_title' => 'Blog',
                'meta_title' => 'Nourhan Academy Blog - Tips & Educational Articles',
                'meta_description' => 'Read the latest articles and tips on English learning and travel from Nourhan Academy experts.',
                'meta_keywords' => 'blog, educational articles, English learning tips, language tips',
                'status' => 'active',
            ],
            [
                'page_name' => 'contact',
                'page_title' => 'Contact Us',
                'meta_title' => 'Contact Us - Nourhan Academy',
                'meta_description' => 'Get in touch with Nourhan Academy for inquiries about training courses and travel services.',
                'meta_keywords' => 'contact us, get in touch, inquiries, contact information',
                'status' => 'active',
            ],
            [
                'page_name' => 'book',
                'page_title' => 'Book Session',
                'meta_title' => 'Book Your Training Session - Nourhan Academy',
                'meta_description' => 'Book a personalized training session with the best instructors at Nourhan Academy.',
                'meta_keywords' => 'book session, training session, book appointment, schedule class',
                'status' => 'active',
            ],
            [
                'page_name' => 'about',
                'page_title' => 'About Us',
                'meta_title' => 'About Nourhan Academy - Our Story & Mission',
                'meta_description' => 'Learn about Nourhan Academy\'s mission, vision, and commitment to excellence in English language education and travel services.',
                'meta_keywords' => 'about us, Nourhan Academy story, mission, vision, English education',
                'status' => 'active',
            ],
            [
                'page_name' => 'pricing',
                'page_title' => 'Pricing Plans',
                'meta_title' => 'Course Pricing & Plans - Nourhan Academy',
                'meta_description' => 'Explore our affordable pricing plans for English language courses and training programs at Nourhan Academy.',
                'meta_keywords' => 'pricing, course fees, training costs, English course prices, plans',
                'status' => 'active',
            ],
            [
                'page_name' => 'events',
                'page_title' => 'Events',
                'meta_title' => 'Upcoming Events & Workshops - Nourhan Academy',
                'meta_description' => 'Join our upcoming events, workshops, and seminars for English language learning and professional development.',
                'meta_keywords' => 'events, workshops, seminars, English events, learning events',
                'status' => 'active',
            ],
            [
                'page_name' => 'course-feedbacks',
                'page_title' => 'Course Feedbacks',
                'meta_title' => 'Student Reviews & Course Feedback - Nourhan Academy',
                'meta_description' => 'Read authentic reviews and feedback from our students about their learning experience at Nourhan Academy.',
                'meta_keywords' => 'student reviews, course feedback, testimonials, student experience',
                'status' => 'active',
            ],
        ];

        foreach ($seoPages as $seoPageData) {
            SeoPage::updateOrCreate(
                ['page_name' => $seoPageData['page_name']],
                $seoPageData
            );
        }

        $this->command->info('SEO pages seeded successfully!');
    }
}
