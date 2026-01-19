<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DirectSqlImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting direct SQL import...');

        // Create blog categories first
        $this->createBlogCategories();

        // Create temporary table and import data
        $this->createTempTableAndImport();

        // Transform and import to blogs table
        $this->transformAndImportBlogs();

        // Clean up
        $this->cleanUp();

        $this->command->info('Direct SQL import completed!');
    }

    private function createBlogCategories()
    {
        $categories = [
            1 => ['name' => 'Arabic Learning', 'slug' => 'arabic-learning'],
            2 => ['name' => 'Tajweed', 'slug' => 'tajweed'],
            3 => ['name' => 'Quran Studies', 'slug' => 'quran-studies'],
            4 => ['name' => 'Islamic Studies', 'slug' => 'islamic-studies'],
        ];

        foreach ($categories as $oldId => $categoryData) {
            BlogCategory::firstOrCreate(
                ['slug' => $categoryData['slug']],
                [
                    'name' => $categoryData['name'],
                    'description' => 'Articles about ' . $categoryData['name'],
                    'status' => 'active',
                    'sort_order' => 0,
                    'meta_title' => $categoryData['name'] . ' Articles - Nourhan Academy',
                    'meta_description' => 'Explore our ' . strtolower($categoryData['name']) . ' articles and guides.',
                    'meta_keywords' => strtolower($categoryData['name']) . ', articles, guides, Nourhan Academy',
                    'canonical_url' => url('/blog?category=' . $categoryData['slug']),
                    'schema_block' => json_encode([
                        '@context' => 'https://schema.org',
                        '@type' => 'CollectionPage',
                        'name' => $categoryData['name'],
                        'description' => 'Articles about ' . $categoryData['name'],
                        'publisher' => [
                            '@type' => 'Organization',
                            'name' => 'Nourhan Academy'
                        ]
                    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                ]
            );
        }

        $this->command->info('Blog categories created!');
    }

    private function createTempTableAndImport()
    {
        // Create temporary posts table
        DB::statement('DROP TABLE IF EXISTS temp_posts');

        DB::statement('
            CREATE TABLE temp_posts (
                id int(10) UNSIGNED NOT NULL,
                author_id int(11) NOT NULL,
                category_id int(11) DEFAULT NULL,
                title varchar(191) NOT NULL,
                seo_title varchar(191) DEFAULT NULL,
                excerpt text DEFAULT NULL,
                body longtext NOT NULL,
                image varchar(191) DEFAULT NULL,
                slug varchar(191) NOT NULL,
                meta_description text DEFAULT NULL,
                meta_keywords text DEFAULT NULL,
                status enum("PUBLISHED","DRAFT","PENDING") NOT NULL DEFAULT "DRAFT",
                featured tinyint(1) NOT NULL DEFAULT 0,
                created_at timestamp NULL DEFAULT NULL,
                updated_at timestamp NULL DEFAULT NULL,
                schema_block longtext DEFAULT NULL,
                image_alt varchar(255) DEFAULT NULL
            )
        ');

        // Read and execute the SQL file
        $sqlFilePath = 'C:\Users\user\Downloads\posts.sql';
        $sqlContent = file_get_contents($sqlFilePath);

        // Replace posts table name with temp_posts
        $sqlContent = str_replace('INSERT INTO `posts`', 'INSERT INTO temp_posts', $sqlContent);

        // Remove table creation and other statements, keep only inserts
        $lines = explode("\n", $sqlContent);
        $insertLines = [];
        $inInsert = false;

        foreach ($lines as $line) {
            if (strpos($line, 'INSERT INTO temp_posts') !== false) {
                $inInsert = true;
            }

            if ($inInsert) {
                $insertLines[] = $line;
                if (strpos($line, ');') !== false) {
                    $inInsert = false;
                }
            }
        }

        $insertSql = implode("\n", $insertLines);

        try {
            DB::unprepared($insertSql);
            $this->command->info('Temporary data imported successfully!');
        } catch (\Exception $e) {
            $this->command->error('Error importing SQL: ' . $e->getMessage());
        }
    }

    private function transformAndImportBlogs()
    {
        // Get category mapping
        $categoryMapping = [
            1 => BlogCategory::where('slug', 'arabic-learning')->first()->id,
            2 => BlogCategory::where('slug', 'tajweed')->first()->id,
            3 => BlogCategory::where('slug', 'quran-studies')->first()->id,
            4 => BlogCategory::where('slug', 'islamic-studies')->first()->id,
        ];

        // Get all posts from temp table
        $posts = DB::table('temp_posts')->get();

        $importedCount = 0;

        foreach ($posts as $post) {
            try {
                // Generate unique slug
                $slug = $this->generateUniqueSlug($post->slug);

                // Get category ID
                $categoryId = $categoryMapping[$post->category_id] ?? $categoryMapping[1];

                Blog::create([
                    'title' => $post->title,
                    'slug' => $slug,
                    'short_description' => $post->excerpt ?: Str::limit(strip_tags($post->body), 200),
                    'description' => $post->body,
                    'cover_image' => $this->processImagePath($post->image),
                    'meta_title' => $post->seo_title ?: $post->title,
                    'meta_description' => $post->meta_description ?: Str::limit(strip_tags($post->body), 160),
                    'meta_keywords' => $post->meta_keywords,
                    'schema_block' => $post->schema_block ?: $this->generateSchemaBlock($post, $slug),
                    'canonical_url' => route('frontend.blog.details', $slug),
                    'author' => 'Sister Nourhan',
                    'blog_category_id' => $categoryId,
                    'status' => $post->status === 'PUBLISHED' ? 'active' : 'inactive',
                    'show_on_homepage' => (bool) $post->featured,
                    'published_at' => $post->created_at ?: now(),
                    'sort_order' => 0,
                ]);

                $importedCount++;
                $this->command->info("Imported: {$post->title}");

            } catch (\Exception $e) {
                $this->command->error("Failed to import: {$post->title} - Error: " . $e->getMessage());
            }
        }

        $this->command->info("Total blogs imported: {$importedCount}");
    }

    private function generateUniqueSlug($originalSlug)
    {
        $slug = Str::slug($originalSlug);
        $originalSlugBase = $slug;
        $counter = 1;

        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlugBase . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function processImagePath($imagePath)
    {
        if (!$imagePath || $imagePath === 'NULL' || $imagePath === 'null') {
            return null;
        }

        // Extract just the filename from paths like 'posts/August2024/filename.jpg'
        $filename = basename($imagePath);

        // Check if image exists in public/uploads/blogs/
        $publicPath = public_path('uploads/blogs/' . $filename);

        if (file_exists($publicPath)) {
            // Image exists in the correct location, return just the filename
            return $filename;
        }

        // Try to find the image with different extensions or case variations
        $possibleExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'JPG', 'JPEG', 'PNG', 'GIF', 'WEBP'];
        $baseNameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);

        foreach ($possibleExtensions as $ext) {
            $testPath = public_path('uploads/blogs/' . $baseNameWithoutExt . '.' . $ext);
            if (file_exists($testPath)) {
                return $baseNameWithoutExt . '.' . $ext;
            }
        }

        // If image not found, log a warning but continue
        $this->command->warn("Image not found: {$filename} (original path: {$imagePath})");

        // Return null if image doesn't exist
        return null;
    }

    private function generateSchemaBlock($post, $slug)
    {
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $post->title,
            'description' => $post->excerpt ?: Str::limit(strip_tags($post->body), 160),
            'author' => [
                '@type' => 'Person',
                'name' => 'Sister Nourhan'
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Nourhan Academy'
            ],
            'datePublished' => $post->created_at ?: now()->format('Y-m-d'),
            'dateModified' => $post->updated_at ?: now()->format('Y-m-d'),
            'url' => route('frontend.blog.details', $slug)
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    private function cleanUp()
    {
        DB::statement('DROP TABLE IF EXISTS temp_posts');
        $this->command->info('Temporary table cleaned up!');
    }
}
