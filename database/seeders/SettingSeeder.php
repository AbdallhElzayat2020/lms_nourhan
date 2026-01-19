<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'author_name',
                'value' => 'Sister Nourhan',
                'type' => 'text',
                'group' => 'author',
                'label' => 'Author Name',
                'description' => 'Full name of the author'
            ],
            [
                'key' => 'author_title',
                'value' => 'EDUCATION EXPERT & CONTENT CREATOR',
                'type' => 'text',
                'group' => 'author',
                'label' => 'Author Title',
                'description' => 'Professional title of the author'
            ],
            [
                'key' => 'author_bio',
                'value' => 'Passionate educator with years of experience in teaching and content creation. Dedicated to providing quality education and inspiring students to achieve their goals.',
                'type' => 'textarea',
                'group' => 'author',
                'label' => 'Author Bio',
                'description' => 'Biography of the author'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
