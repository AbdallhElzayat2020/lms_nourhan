<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Blog;

echo "Checking blog images...\n\n";

$blogs = Blog::all();

$withImages = 0;
$withoutImages = 0;
$missingFiles = 0;

foreach ($blogs as $blog) {
    if ($blog->cover_image) {
        $withImages++;
        $imagePath = public_path('uploads/blogs/' . $blog->cover_image);

        if (!file_exists($imagePath)) {
            $missingFiles++;
            echo "❌ Missing: {$blog->title}\n";
            echo "   Image: {$blog->cover_image}\n";
            echo "   Path: {$imagePath}\n\n";
        } else {
            echo "✅ Found: {$blog->title} - {$blog->cover_image}\n";
        }
    } else {
        $withoutImages++;
        echo "⚠️  No image: {$blog->title}\n";
    }
}

echo "\n=== Summary ===\n";
echo "Total blogs: " . $blogs->count() . "\n";
echo "With images in DB: {$withImages}\n";
echo "Without images: {$withoutImages}\n";
echo "Missing files: {$missingFiles}\n";
