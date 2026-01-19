<?php

namespace Database\Seeders;

use App\Models\AboutInfo;
use Illuminate\Database\Seeder;

class AboutInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'title' => 'OUR HISTORY',
                'slug' => 'history',
                'description' => 'Founded in 2014, Nourhan Academy began as a small initiative to provide quality online education. Over the years, we have grown into a leading educational platform, serving thousands of students worldwide. Our journey has been marked by continuous innovation, dedication to excellence, and a commitment to making education accessible to everyone.',
                'icon_class' => 'fa-sharp fa-solid fa-clock-rotate-left',
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'title' => 'OUR MISSION',
                'slug' => 'mission',
                'description' => 'Our mission is to empower learners of all ages and backgrounds by providing high-quality, accessible, and engaging educational experiences. We strive to break down barriers to education, foster lifelong learning, and help individuals achieve their personal and professional goals through innovative teaching methods and cutting-edge technology.',
                'icon_class' => 'fa-sharp fa-solid fa-bullseye',
                'status' => 'active',
                'sort_order' => 2,
            ],
            [
                'title' => 'OUR VISION',
                'slug' => 'vision',
                'description' => 'We envision a world where quality education is accessible to everyone, regardless of geographical location or socioeconomic status. Our vision is to become a global leader in online education, transforming how people learn and grow. We aim to create a learning ecosystem that inspires curiosity, nurtures talent, and builds a brighter future for generations to come.',
                'icon_class' => 'fa-sharp fa-solid fa-eye',
                'status' => 'active',
                'sort_order' => 3,
            ],
        ];

        foreach ($items as $item) {
            AboutInfo::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}

