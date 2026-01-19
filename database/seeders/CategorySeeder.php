<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Adventure Tours',
                'slug' => 'adventure-tours',
                'description' => 'Exciting adventure tours and activities',
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'name' => 'Beach Holidays',
                'slug' => 'beach-holidays',
                'description' => 'Relaxing beach destinations',
                'status' => 'active',
                'sort_order' => 2,
            ],
            [
                'name' => 'Cultural Tours',
                'slug' => 'cultural-tours',
                'description' => 'Explore rich cultural heritage',
                'status' => 'active',
                'sort_order' => 3,
            ],
            [
                'name' => 'Mountain Expeditions',
                'slug' => 'mountain-expeditions',
                'description' => 'Mountain climbing and hiking tours',
                'status' => 'active',
                'sort_order' => 4,
            ],
            [
                'name' => 'City Breaks',
                'slug' => 'city-breaks',
                'description' => 'Urban exploration and city tours',
                'status' => 'active',
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        $this->command->info('Categories seeded successfully!');
    }
}
