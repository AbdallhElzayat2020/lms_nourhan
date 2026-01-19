<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ImportPostsFromSqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting to parse and import posts from SQL file...');

        // Read the SQL file
        $sqlFilePath = 'C:\Users\user\Downloads\posts.sql';

        if (!file_exists($sqlFilePath)) {
            $this->command->error('SQL file not found at: ' . $sqlFilePath);
            return;
        }

        $sqlContent = file_get_contents($sqlFilePath);

        // Extract INSERT statements
        preg_match_all('/INSERT INTO `posts`.*?VALUES\s*\((.*?)\);/s', $sqlContent, $matches);

        if (empty($matches[1])) {
            $this->command->error('No INSERT statements found in SQL file');
            return;
        }

        // Create blog categories mapping
        $categoryMapping = $this->createCategoryMapping();

        $importedCount = 0;

        foreach ($matches[1] as $valuesString) {
            // Parse the values - this is a simplified parser
            $posts = $this->parseInsertValues($valuesString);

            foreach ($posts as $postData) {
                try {
                    // Get or create category
                    $categoryId = $this->getCategoryId($postData['category_id'], $categoryMapping);

                    // Create the blog post
                    Blog::create([
                        'title' => $postData['title'],
                        'slug' => $this->generateUniqueSlug($postData['slug']),
                        'short_description' => $postData['excerpt'] ?: Str::limit(strip_tags($postData['body']), 200),
                        'description' => $postData['body'],
                        'cover_image' => $postData['image'],
                        'meta_title' => $postData['seo_title'] ?: $postData['title'],
                        'meta_description' => $postData['meta_description'] ?: Str::limit(strip_tags($postData['body']), 160),
                        'meta_keywords' => $postData['meta_keywords'],
                        'schema_block' => $postData['schema_block'] ?: $this->generateSchemaBlock($postData),
                        'canonical_url' => route('frontend.blog.details', $this->generateUniqueSlug($postData['slug'])),
                        'author' => 'Sister Nourhan',
                        'blog_category_id' => $categoryId,
                        'status' => $postData['status'] === 'PUBLISHED' ? 'active' : 'inactive',
                        'show_on_homepage' => (bool) $postData['featured'],
                        'published_at' => $postData['created_at'] ?: now(),
                        'sort_order' => 0,
                    ]);

                    $importedCount++;
                    $this->command->info("Imported: {$postData['title']}");

                } catch (\Exception $e) {
                    $this->command->error("Failed to import post: {$postData['title']} - Error: " . $e->getMessage());
                }
            }
        }

        $this->command->info("Import completed! Total posts imported: {$importedCount}");
    }

    private function parseInsertValues($valuesString)
    {
        $posts = [];

        // Split by '),(' to get individual records
        $records = preg_split('/\),\s*\(/', $valuesString);

        foreach ($records as $record) {
            // Clean up the record
            $record = trim($record, '(),');

            // Parse the values - this is a simplified approach
            $values = $this->parseRecordValues($record);

            if (count($values) >= 17) { // Ensure we have all required fields
                $posts[] = [
                    'id' => $values[0],
                    'author_id' => $values[1],
                    'category_id' => $values[2],
                    'title' => $this->cleanValue($values[3]),
                    'seo_title' => $this->cleanValue($values[4]),
                    'excerpt' => $this->cleanValue($values[5]),
                    'body' => $this->cleanValue($values[6]),
                    'image' => $this->cleanValue($values[7]),
                    'slug' => $this->cleanValue($values[8]),
                    'meta_description' => $this->cleanValue($values[9]),
                    'meta_keywords' => $this->cleanValue($values[10]),
                    'status' => $this->cleanValue($values[11]),
                    'featured' => $values[12],
                    'created_at' => $this->cleanValue($values[13]),
                    'updated_at' => $this->cleanValue($values[14]),
                    'schema_block' => $this->cleanValue($values[15]),
                    'image_alt' => isset($values[16]) ? $this->cleanValue($values[16]) : null,
                ];
            }
        }

        return $posts;
    }

    private function parseRecordValues($record)
    {
        $values = [];
        $current = '';
        $inQuotes = false;
        $quoteChar = '';
        $i = 0;

        while ($i < strlen($record)) {
            $char = $record[$i];

            if (!$inQuotes && ($char === '"' || $char === "'")) {
                $inQuotes = true;
                $quoteChar = $char;
                $i++;
                continue;
            }

            if ($inQuotes && $char === $quoteChar) {
                // Check for escaped quote
                if ($i + 1 < strlen($record) && $record[$i + 1] === $quoteChar) {
                    $current .= $char;
                    $i += 2;
                    continue;
                } else {
                    $inQuotes = false;
                    $quoteChar = '';
                    $i++;
                    continue;
                }
            }

            if (!$inQuotes && $char === ',') {
                $values[] = trim($current);
                $current = '';
                $i++;
                continue;
            }

            $current .= $char;
            $i++;
        }

        // Add the last value
        if ($current !== '') {
            $values[] = trim($current);
        }

        return $values;
    }

    private function cleanValue($value)
    {
        if ($value === 'NULL' || $value === null) {
            return null;
        }

        // Remove quotes and unescape
        $value = trim($value, '"\'');
        $value = str_replace(['\\\'', '\\"', '\\\\'], ["'", '"', '\\'], $value);

        return $value;
    }

    private function createCategoryMapping()
    {
        $categories = [
            1 => ['name' => 'Arabic Learning', 'slug' => 'arabic-learning'],
            2 => ['name' => 'Tajweed', 'slug' => 'tajweed'],
            3 => ['name' => 'Quran Studies', 'slug' => 'quran-studies'],
            4 => ['name' => 'Islamic Studies', 'slug' => 'islamic-studies'],
        ];

        $mapping = [];

        foreach ($categories as $oldId => $categoryData) {
            $category = BlogCategory::firstOrCreate(
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

            $mapping[$oldId] = $category->id;
        }

        return $mapping;
    }

    private function getCategoryId($oldCategoryId, $mapping)
    {
        return $mapping[$oldCategoryId] ?? $mapping[1]; // Default to Arabic Learning
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

    private function generateSchemaBlock($postData)
    {
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $postData['title'],
            'description' => $postData['excerpt'] ?: Str::limit(strip_tags($postData['body']), 160),
            'author' => [
                '@type' => 'Person',
                'name' => 'Sister Nourhan'
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Nourhan Academy'
            ],
            'datePublished' => $postData['created_at'] ?: now()->format('Y-m-d'),
            'dateModified' => $postData['updated_at'] ?: now()->format('Y-m-d'),
            'url' => route('frontend.blog.details', $this->generateUniqueSlug($postData['slug']))
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
