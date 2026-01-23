<?php

namespace Database\Seeders;

use App\Models\WhyChooseItem;
use Illuminate\Database\Seeder;

class WhyChooseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'title' => 'Expert Instructors',
                'subtitle' => 'Learn from certified teachers',
                'description' => 'Our courses are led by qualified, experienced instructors who are passionate about teaching Qur\'an, Arabic, and Islamic studies with clarity, patience, and care.',
                'video_url' => 'https://www.youtube.com/watch?v=qjxDcU4m2FQ',
                'icon_class' => 'fa-solid fa-chalkboard-user',
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'title' => 'Structured Curriculum',
                'subtitle' => 'Step-by-step learning journey',
                'description' => 'Every program is designed with a clear roadmap, from beginner to advanced, so you always know what you are learning next and how it fits your bigger goals.',
                'icon_class' => 'fa-solid fa-layer-group',
                'status' => 'active',
                'sort_order' => 2,
            ],
            [
                'title' => 'Flexible Online Learning',
                'subtitle' => 'Anytime, anywhere',
                'description' => 'Study from the comfort of your home with flexible schedules, recorded sessions, and supportive instructors who work around your life and time zone.',
                'icon_class' => 'fa-solid fa-clock',
                'status' => 'active',
                'sort_order' => 3,
            ],
        ];

        foreach ($items as $item) {
            WhyChooseItem::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }

        // Delete any items that are not in the seeder list (to keep only 3 items)
        $allowedTitles = array_column($items, 'title');
        WhyChooseItem::whereNotIn('title', $allowedTitles)->delete();
    }
}
