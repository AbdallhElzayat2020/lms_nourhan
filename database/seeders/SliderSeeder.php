<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Discover Amazing Travel Destinations',
                'description' => 'Explore the world with our amazing travel packages. From tropical beaches to mountain adventures, we have something for everyone.',
                'image' => 'slider1.jpg',
                'status' => 'active',
                'sort_order' => 1,
                'link' => 'https://example.com/destinations',
                'button_text' => 'Explore Now',
            ],
            [
                'title' => 'Adventure Awaits You',
                'description' => 'Embark on thrilling adventures and create unforgettable memories. Our expert guides will ensure you have the experience of a lifetime.',
                'image' => 'slider2.jpg',
                'status' => 'active',
                'sort_order' => 2,
                'link' => 'https://example.com/adventures',
                'button_text' => 'Start Adventure',
            ],
            [
                'title' => 'Luxury Travel Experiences',
                'description' => 'Indulge in luxury travel experiences with our premium packages. Enjoy world-class accommodations and personalized service.',
                'image' => 'slider3.jpg',
                'status' => 'active',
                'sort_order' => 3,
                'link' => 'https://example.com/luxury',
                'button_text' => 'Book Now',
            ],
            [
                'title' => 'Cultural Tours & Heritage',
                'description' => 'Immerse yourself in rich cultures and explore historical heritage sites around the world.',
                'image' => 'slider4.jpg',
                'status' => 'inactive',
                'sort_order' => 4,
                'link' => 'https://example.com/cultural',
                'button_text' => 'Learn More',
            ],
            [
                'title' => 'Beach Paradise',
                'description' => 'Relax and unwind at the most beautiful beaches in the world. Perfect for your next vacation.',
                'image' => 'slider5.jpg',
                'status' => 'active',
                'sort_order' => 5,
                'link' => 'https://example.com/beaches',
                'button_text' => 'Book Vacation',
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }

        $this->command->info('Sliders seeded successfully!');
        $this->command->warn('Note: Please add actual images to public/uploads/sliders/ directory with the names: slider1.jpg, slider2.jpg, etc.');
    }
}
