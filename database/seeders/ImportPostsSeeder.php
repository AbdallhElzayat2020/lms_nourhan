<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ImportPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, let's create some blog categories if they don't exist
        $this->createBlogCategories();

        // Posts data from the SQL file
        $posts = [
            [
                'title' => 'How to Learn Arabic Language in best way?',
                'seo_title' => 'How to Learn Arabic Language in best way',
                'excerpt' => 'Learn how to master the Arabic language easily with these practical tips. Start with the basics, practice daily, immerse yourself, and engage with native speakers to enhance your learning journey.',
                'body' => '<p class="MsoNormal">Learning the Arabic language might seem challenging at first, but with the right approach and resources, it can be an enjoyable and rewarding experience. Whether you\'re learning for personal interest, religious studies, or professional growth, following a structured path can make the process much smoother. Here are some tips on how to learn Arabic easily:</p>
<p class="MsoNormal"><strong>1. Start with the Basics</strong></p>
<p class="MsoNormal">Begin by learning the Arabic alphabet and sounds. Arabic has 28 letters, and mastering these will lay a strong foundation for your language learning. Focus on pronunciation, as Arabic has sounds that might be unfamiliar to non-native speakers.</p>
<p class="MsoNormal"><strong>2. Practice Regularly</strong></p>
<p class="MsoNormal">Consistency is key when learning a new language. Dedicate a specific time each day to practice Arabic. Even 15-30 minutes daily can make a significant difference over time. Use flashcards, mobile apps, or language learning websites to reinforce your learning.</p>
<p class="MsoNormal"><strong>3. Immerse Yourself in the Language</strong></p>
<p class="MsoNormal">Surround yourself with the Arabic language as much as possible. Listen to Arabic music, watch Arabic TV shows, or follow Arabic social media accounts. Immersion helps in picking up new words, improving your pronunciation, and understanding the cultural context.</p>
<p class="MsoNormal"><strong>4. Use Language Learning Apps</strong></p>
<p class="MsoNormal">There are several apps designed to make language learning easier and more interactive. Apps like Duolingo, Memrise, and Rosetta Stone offer Arabic courses that are structured, engaging, and suited for beginners.</p>
<p class="MsoNormal"><strong>5. Join a Language Course</strong></p>
<p class="MsoNormal">Taking a formal language course can accelerate your learning. Look for Arabic language courses offered by universities, language schools, or online platforms. A structured course with a tutor will guide you through grammar, vocabulary, and conversational skills.</p>
<p class="MsoNormal"><strong>6. Practice Speaking with Native Speakers</strong></p>
<p class="MsoNormal">One of the most effective ways to learn a language is by speaking it. If possible, find a language partner or tutor who is a native Arabic speaker. Practicing with someone fluent will improve your confidence and conversational skills.</p>
<p class="MsoNormal"><strong>7. Be Patient and Stay Motivated</strong></p>
<p><span style="font-size: 11.0pt; line-height: 107%; font-family: \'Aptos\',sans-serif;">Learning a new language takes time and effort. Don\'t get discouraged if you find it difficult at first. Celebrate small victories, like understanding a sentence or holding a short conversation in Arabic. Staying motivated will keep you progressing toward fluency.</span></p>',
                'slug' => 'how-to-learn-arabic-language-in-best-way',
                'meta_description' => 'Learn how to master the Arabic language easily with these practical tips. Start with the basics, practice daily, immerse yourself, and engage with native speakers to enhance your learning journey.',
                'meta_keywords' => 'Arabic language, learn Arabic, Arabic learning tips, language learning',
                'category_name' => 'Arabic Learning',
                'status' => 'active',
                'featured' => false,
            ],
            [
                'title' => 'How to Find the Best Quran Tutor?',
                'seo_title' => 'How to Find the Best Quran Tutor',
                'excerpt' => 'Discover how to choose the right Quran tutor by considering qualifications, experience, teaching style, and more. Ensure your Quranic learning journey is effective and spiritually enriching with these essential tips.',
                'body' => '<p class="MsoNormal">Selecting the right Quran tutor is a crucial step in your journey to learn the Quran effectively. Whether you are just starting to explore the Quranic verses or looking to deepen your understanding, the right tutor can make a significant difference in your learning experience. Here\'s how to choose the best Quran tutor, considering key factors such as qualifications, teaching style, and experience.</p>
<p class="MsoNormal"><strong>1. Evaluate Quran Tutor Qualifications</strong></p>
<p class="MsoNormal">When searching for a Quran tutor, their qualifications should be your top priority. A qualified Quran tutor should have a strong background in Islamic studies and Quranic education. Ideally, they should have graduated from a reputable institution like Al-Azhar University or another recognized Islamic educational body.</p>
<p class="MsoNormal"><strong>2. Understand the Tutor\'s Teaching Experience</strong></p>
<p class="MsoNormal">Experience plays a significant role in a tutor\'s ability to teach Quran effectively. A seasoned Quran tutor will have the skills to tailor lessons according to the student\'s level—whether they are beginners or advanced learners.</p>
<p class="MsoNormal"><strong>3. Consider the Teaching Style</strong></p>
<p class="MsoNormal">The teaching style of a Quran tutor should match your learning needs. Some students prefer a more structured approach with a focus on memorization, while others might benefit from a tutor who emphasizes understanding the Quranic words and context.</p>
<p class="MsoNormal"><strong>Conclusion</strong></p>
<p class="MsoNormal">Choosing the right Quran tutor involves careful consideration of their qualifications, teaching style, experience, and how well they align with your learning goals. At Sister Nourhan Academy, we take pride in offering experienced and highly qualified Quran tutors who are dedicated to helping you learn the Quran in a way that is both effective and spiritually enriching.</p>',
                'slug' => 'how-to-find-the-best-quran-tutor',
                'meta_description' => 'Discover how to choose the right Quran tutor by considering qualifications, experience, teaching style, and more. Ensure your Quranic learning journey is effective and spiritually enriching with these essential tips.',
                'meta_keywords' => 'Quran Tutor, learn Quran, Quran Tutor Qualifications, Islamic study, Quran words',
                'category_name' => 'Quran Studies',
                'status' => 'active',
                'featured' => false,
            ],
            [
                'title' => 'How to Memorize the Qur\'an in the Shortest Time',
                'seo_title' => 'How to Memorize the Qur\'an in the Shortest Time',
                'excerpt' => 'Learn how to memorize the Qur\'an in the shortest time with practical tips and effective strategies. This guide covers structured planning, repetition techniques, understanding meanings, and more to help you achieve your memorization goals efficiently.',
                'body' => '<p class="MsoNormal"><strong>Introduction</strong></p>
<p class="MsoNormal">Memorizing the Qur\'an is a noble and spiritually rewarding endeavor for Muslims around the world. While it is a challenging task, with dedication, the right techniques, and consistent effort, it is possible to memorize the Qur\'an in a relatively short period.</p>
<p class="MsoNormal"><strong>Set Clear Intentions</strong></p>
<p class="MsoNormal">The first step in memorizing the Qur\'an is to set clear and sincere intentions. Understand that this is a spiritual journey and seek the pleasure of Allah in your efforts.</p>
<p class="MsoNormal"><strong>Create a Structured Plan</strong></p>
<p class="MsoNormal">Develop a structured and realistic plan. Determine how many pages or verses you will memorize each day and set a timeline for your goals.</p>
<p class="MsoNormal"><strong>Use Repetition and Consistency</strong></p>
<p class="MsoNormal">Repetition is key to memorization. Recite the verses repeatedly until they become ingrained in your memory. Consistency is crucial; make it a daily habit to review previously memorized sections.</p>
<p class="MsoNormal"><strong>Conclusion</strong></p>
<p><span style="font-size: 11.0pt; line-height: 107%; font-family: \'Aptos\',sans-serif;">Memorizing the Qur\'an in the shortest time requires a combination of dedication, strategic planning, and consistent effort. By setting clear intentions, creating a structured plan, utilizing various memorization techniques, and seeking support, you can achieve this noble goal.</span></p>',
                'slug' => 'how-to-memorize-the-qur-an-in-the-shortest-time',
                'meta_description' => 'Learn how to memorize the Qur\'an in the shortest time with practical tips and effective strategies. This guide covers structured planning, repetition techniques, understanding meanings, and more to help you achieve your memorization goals efficiently.',
                'meta_keywords' => 'how to memorize the Qur\'an, the Qur\'an, memorize the Qur\'an',
                'category_name' => 'Quran Studies',
                'status' => 'active',
                'featured' => false,
            ],
            [
                'title' => 'Why Learn Quran with Tajweed',
                'seo_title' => 'Why Learn Quran with Tajweed',
                'excerpt' => 'Discover the importance of learning the Quran with Tajweed, from preserving its authenticity to enhancing your spiritual connection. Explore the benefits of precise pronunciation and deepened understanding in this insightful article.',
                'body' => '<p class="MsoNormal"><strong>Introduction</strong></p>
<p class="MsoNormal">The Quran, the holy book of Islam, is not only a guide for personal conduct and spirituality but also a masterpiece of linguistic beauty. To fully appreciate its profound messages and intricate phonetics, it is essential to learn and recite it with Tajweed.</p>
<p class="MsoNormal"><strong>Preserving the Authenticity</strong></p>
<p class="MsoNormal">One of the primary reasons for learning Tajweed is to preserve the authenticity of the Quranic recitation. Tajweed rules were established to maintain the original pronunciation and articulation of the words as they were revealed.</p>
<p class="MsoNormal"><strong>Enhancing Spiritual Experience</strong></p>
<p class="MsoNormal">Reciting the Quran with Tajweed enhances the spiritual experience. The melodious and rhythmic recitation, when done correctly, can deeply move the reciter and the listener, creating a profound connection with the divine.</p>
<p class="MsoNormal"><strong>Conclusion</strong></p>
<p><span style="font-size: 11.0pt; line-height: 107%; font-family: \'Aptos\',sans-serif;">Learning the Quran with Tajweed is a valuable endeavor that goes beyond mere recitation. It is a means to connect deeply with the divine, understand the sacred text more profoundly, and preserve its authenticity.</span></p>',
                'slug' => 'why-learn-quran-with-tajweed',
                'meta_description' => 'Discover the importance of learning the Quran with Tajweed, from preserving its authenticity to enhancing your spiritual connection. Explore the benefits of precise pronunciation and deepened understanding in this insightful article.',
                'meta_keywords' => 'Tajweed, Learn Tajweed, Tajweed with sister Nourhan',
                'category_name' => 'Tajweed',
                'status' => 'active',
                'featured' => true,
            ],
            [
                'title' => 'What is Zakat in Islam?',
                'seo_title' => 'What is Zakat in Islam',
                'excerpt' => 'Explore the significance of Zakat in Islam, a key pillar that emphasizes charity, social justice, and community welfare. Learn how Zakat connects to Islamic studies, Quranic teachings, and the broader principles of Fiqh in Islam.',
                'body' => '<p>Zakat, one of the Five Pillars of Islam, is a fundamental aspect of the Islamic faith that emphasizes social responsibility, compassion, and community welfare. Derived from the Arabic root word "zaka," which means to purify or cleanse, Zakat represents the act of giving a portion of one\'s wealth to those in need.</p>
<h4><strong>The Importance of Zakat in Islam</strong></h4>
<p>In Islam, Zakat is not merely an act of charity; it is an obligation that every eligible Muslim must fulfill. By giving Zakat, Muslims contribute to the welfare of society, support the less fortunate, and ensure that wealth is distributed fairly.</p>
<h4><strong>Who is Eligible to Pay Zakat?</strong></h4>
<p>Zakat is obligatory for Muslims who meet certain criteria, including possessing wealth above a specific threshold known as the Nisab. The Nisab is the minimum amount of wealth that one must have before they are required to pay Zakat.</p>
<h4><strong>Conclusion</strong></h4>
<p>Zakat is a profound expression of faith and devotion in Islam, embodying the principles of charity, social justice, and compassion. By giving Zakat, Muslims fulfill a divine obligation, purify their wealth, and contribute to the well-being of the community.</p>',
                'slug' => 'what-is-zakat-in-islam',
                'meta_description' => 'Explore the significance of Zakat in Islam, a key pillar that emphasizes charity, social justice, and community welfare. Learn how Zakat connects to Islamic studies, Quranic teachings, and the broader principles of Fiqh in Islam.',
                'meta_keywords' => 'Learn about Islam, learn Arabic, Quran, Islamic studies, Fiqh in Islam, Learn Quran, Quran meanings',
                'category_name' => 'Islamic Studies',
                'status' => 'active',
                'featured' => false,
            ],
            [
                'title' => 'How to Pray in Islam: A Step-by-Step Guide',
                'seo_title' => 'How to Pray in Islam: A Step-by-Step Guide',
                'excerpt' => 'Learn how to pray in Islam with this step-by-step guide. Understand the significance of Salah, the importance of learning Arabic, and the role of Islamic studies in mastering this essential act of worship.',
                'body' => '<p class="MsoNormal">Prayer, or <strong>Salah</strong>, is one of the Five Pillars of Islam and is a fundamental act of worship that every Muslim is obligated to perform. It is a direct link between the worshipper and Allah (God), offering spiritual nourishment and a sense of peace.</p>
<p class="MsoNormal"><strong>The Importance of Prayer in Islam</strong></p>
<p class="MsoNormal">Prayer is a central practice in Islam, performed five times a day at prescribed times: Fajr (dawn), Dhuhr (midday), Asr (afternoon), Maghrib (sunset), and Isha (night).</p>
<p class="MsoNormal"><strong>Step 1: Preparation for Prayer</strong></p>
<p class="MsoNormal">Before praying, a Muslim must be in a state of ritual purity, known as <strong>Wudu</strong>. Wudu involves washing specific parts of the body, including the hands, mouth, nose, face, arms, head, and feet.</p>
<p class="MsoNormal"><strong>Conclusion</strong></p>
<p><span style="font-size: 11.0pt; line-height: 107%; font-family: \'Aptos\',sans-serif;">Praying in Islam is a deeply spiritual practice that requires understanding, dedication, and discipline. By learning how to pray correctly, Muslims fulfill one of their most important religious obligations and maintain a strong connection with Allah.</span></p>',
                'slug' => 'how-to-pray-in-islam-a-step-by-step-guide',
                'meta_description' => 'Learn how to pray in Islam with this step-by-step guide. Understand the significance of Salah, the importance of learning Arabic, and the role of Islamic studies in mastering this essential act of worship.',
                'meta_keywords' => 'Learn Arabic, Learn About Islam, Islamic studies, Learn Quran, Quran Courses, Islamic courses, teaching pray, learn how pray',
                'category_name' => 'Islamic Studies',
                'status' => 'active',
                'featured' => false,
            ],
            [
                'title' => 'Best Ways to Learn Tajweed',
                'seo_title' => 'Best Ways to Learn Tajweed',
                'excerpt' => 'Discover the best ways to learn Tajweed and perfect your Quran recitation. Explore online courses, find qualified teachers, and learn Tajweed with Sister Nourhan Academy for a comprehensive and effective learning experience.',
                'body' => '<p class="MsoNormal">Learning <strong>Tajweed</strong> is essential for anyone who wants to recite the Quran correctly and beautifully. Tajweed, the set of rules governing the pronunciation during Quranic recitation, ensures that every letter is given its due right and that the recitation is performed as it was revealed.</p>
<p class="MsoNormal"><strong>1. Enroll in a Quran Academy</strong></p>
<p class="MsoNormal">One of the most effective ways to learn Tajweed is by enrolling in a reputable <strong>Quran academy</strong>. A Quran academy offers structured courses led by experienced teachers who are experts in Tajweed.</p>
<p class="MsoNormal"><strong>2. Learn Tajweed Online</strong></p>
<p class="MsoNormal">In today\'s digital age, learning Tajweed online has become increasingly popular. Online platforms offer flexibility, allowing you to learn at your own pace and schedule.</p>
<p class="MsoNormal"><strong>Conclusion</strong></p>
<p><span style="font-size: 11.0pt; line-height: 107%; font-family: \'Aptos\',sans-serif;">Learning Tajweed is a rewarding journey that enhances your connection with the Quran and deepens your understanding of its message. <strong>Sister Nourhan Academy</strong> provides a comprehensive platform with the best Tajweed teachers and resources, making it an ideal choice for anyone looking to learn Tajweed effectively.</span></p>',
                'slug' => 'best-ways-to-learn-tajweed',
                'meta_description' => 'Discover the best ways to learn Tajweed and perfect your Quran recitation. Explore online courses, find qualified teachers, and learn Tajweed with Sister Nourhan Academy for a comprehensive and effective learning experience.',
                'meta_keywords' => 'Learn Tajweed, Tajweed ways, Quran academy, Sister Nourhan Academy, best way to learn Tajweed, Learn Quran with Tajweed',
                'category_name' => 'Tajweed',
                'status' => 'active',
                'featured' => false,
            ],
            [
                'title' => 'Best Arabic Phrases to Learn for Traveling',
                'seo_title' => 'Best Arabic Phrases to Learn for Traveling',
                'excerpt' => 'Discover the essential Arabic phrases for traveling to Arabic-speaking countries. Learn key expressions to help you navigate, ask for directions, and engage in polite conversations. Enhance your travel experience by learning Arabic online with Sister Nourhan Academy.',
                'body' => '<p class="MsoNormal">Traveling to Arabic-speaking countries can be an enriching experience, and knowing key phrases in Arabic can make your journey smoother and more enjoyable. Whether you are exploring historic sites or navigating bustling markets, these essential phrases will help you communicate effectively.</p>
<p class="MsoNormal"><strong>1. Greetings and Politeness:</strong></p>
<ul>
<li><strong>Marhaban (مرحبا)</strong> - Hello</li>
<li><strong>Shukran (شكراً)</strong> - Thank you</li>
<li><strong>Min fadlak (من فضلك)</strong> - Please</li>
<li><strong>Afwan (عفواً)</strong> - Excuse me / You\'re welcome</li>
</ul>
<p class="MsoNormal"><strong>2. Basic Questions:</strong></p>
<ul>
<li><strong>Kam al-thaman? (كم الثمن؟)</strong> - How much does it cost?</li>
<li><strong>Ayna al-Hammam? (أين الحمام؟)</strong> - Where is the bathroom?</li>
<li><strong>Hal tatakallam al-ingliziyya? (هل تتكلم الإنجليزية؟)</strong> - Do you speak English?</li>
</ul>
<p class="MsoNormal"><strong>3. Directions:</strong></p>
<ul>
<li><strong>Yasaar (يسار)</strong> - Left</li>
<li><strong>Yameen (يمين)</strong> - Right</li>
<li><strong>Tawil (طويل)</strong> - Straight</li>
</ul>
<p><span style="font-size: 11.0pt; line-height: 107%; font-family: \'Aptos\',sans-serif;">Learning these phrases with <strong>Sister Nourhan Academy</strong> can make your Arabic learning journey easier and more effective, especially if you\'re preparing for travel.</span></p>',
                'slug' => 'best-arabic-phrases-to-learn-for-traveling',
                'meta_description' => 'Discover the essential Arabic phrases for traveling to Arabic-speaking countries. Learn key expressions to help you navigate, ask for directions, and engage in polite conversations. Enhance your travel experience by learning Arabic online with Sister Nourhan Academy.',
                'meta_keywords' => 'Learn Arabic, Learn Arabic Online, Learn Arabic with Sister Nourhan, Arabic Phrases, Traveling to Arabic Countries',
                'category_name' => 'Arabic Learning',
                'status' => 'active',
                'featured' => false,
            ],
        ];

        $this->command->info('Starting to import posts...');

        foreach ($posts as $postData) {
            // Get or create blog category
            $category = BlogCategory::firstOrCreate(
                ['name' => $postData['category_name']],
                [
                    'slug' => Str::slug($postData['category_name']),
                    'description' => 'Articles about ' . $postData['category_name'],
                    'status' => 'active',
                    'sort_order' => 0,
                ]
            );

            // Create blog post
            Blog::create([
                'title' => $postData['title'],
                'slug' => $postData['slug'],
                'short_description' => $postData['excerpt'],
                'description' => $postData['body'],
                'meta_title' => $postData['seo_title'],
                'meta_description' => $postData['meta_description'],
                'meta_keywords' => $postData['meta_keywords'],
                'canonical_url' => route('frontend.blog.details', $postData['slug']),
                'author' => 'Sister Nourhan',
                'blog_category_id' => $category->id,
                'status' => $postData['status'],
                'show_on_homepage' => $postData['featured'],
                'published_at' => now(),
                'sort_order' => 0,
                'schema_block' => json_encode([
                    '@context' => 'https://schema.org',
                    '@type' => 'Article',
                    'headline' => $postData['title'],
                    'description' => $postData['excerpt'],
                    'author' => [
                        '@type' => 'Person',
                        'name' => 'Sister Nourhan'
                    ],
                    'publisher' => [
                        '@type' => 'Organization',
                        'name' => 'Nourhan Academy'
                    ],
                    'datePublished' => now()->format('Y-m-d'),
                    'dateModified' => now()->format('Y-m-d'),
                    'articleSection' => $postData['category_name'],
                    'url' => route('frontend.blog.details', $postData['slug'])
                ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
            ]);

            $this->command->info('Imported: ' . $postData['title']);
        }

        $this->command->info('Posts import completed successfully!');
    }

    private function createBlogCategories()
    {
        $categories = [
            [
                'name' => 'Arabic Learning',
                'slug' => 'arabic-learning',
                'description' => 'Tips and guides for learning Arabic language',
                'meta_title' => 'Arabic Learning Articles - Nourhan Academy',
                'meta_description' => 'Explore our comprehensive guides and tips for learning Arabic language effectively.',
                'meta_keywords' => 'Arabic learning, learn Arabic, Arabic language, Arabic courses',
            ],
            [
                'name' => 'Tajweed',
                'slug' => 'tajweed',
                'description' => 'Learn about Tajweed rules and Quran recitation',
                'meta_title' => 'Tajweed Articles - Nourhan Academy',
                'meta_description' => 'Master Tajweed rules and improve your Quran recitation with our expert guides.',
                'meta_keywords' => 'Tajweed, Quran recitation, learn Tajweed, Quran pronunciation',
            ],
            [
                'name' => 'Quran Studies',
                'slug' => 'quran-studies',
                'description' => 'Articles about Quran memorization and understanding',
                'meta_title' => 'Quran Studies Articles - Nourhan Academy',
                'meta_description' => 'Deepen your understanding of the Quran with our comprehensive study guides.',
                'meta_keywords' => 'Quran studies, Quran memorization, learn Quran, Quran understanding',
            ],
            [
                'name' => 'Islamic Studies',
                'slug' => 'islamic-studies',
                'description' => 'General Islamic knowledge and studies',
                'meta_title' => 'Islamic Studies Articles - Nourhan Academy',
                'meta_description' => 'Learn about Islamic principles, practices, and teachings with our educational articles.',
                'meta_keywords' => 'Islamic studies, learn Islam, Islamic knowledge, Islamic education',
            ],
        ];

        foreach ($categories as $categoryData) {
            BlogCategory::firstOrCreate(
                ['slug' => $categoryData['slug']],
                array_merge($categoryData, [
                    'status' => 'active',
                    'sort_order' => 0,
                    'canonical_url' => url('/blog?category=' . $categoryData['slug']),
                    'schema_block' => json_encode([
                        '@context' => 'https://schema.org',
                        '@type' => 'CollectionPage',
                        'name' => $categoryData['name'],
                        'description' => $categoryData['description'],
                        'publisher' => [
                            '@type' => 'Organization',
                            'name' => 'Nourhan Academy'
                        ],
                        'mainEntity' => [
                            '@type' => 'ItemList',
                            'name' => $categoryData['name'] . ' Articles'
                        ]
                    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                ])
            );
        }

        $this->command->info('Blog categories created successfully!');
    }
}
