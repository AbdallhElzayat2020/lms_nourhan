<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixBlogImages extends Command
{
    protected $signature = 'blog:fix-images';
    protected $description = 'Fix blog image paths by checking if images exist and updating database';

    public function handle()
    {
        $this->info('Checking blog images...');

        $blogs = Blog::whereNotNull('cover_image')->get();
        $fixedCount = 0;
        $missingCount = 0;
        $imagesPath = public_path('uploads/blogs');

        // Get all existing image files
        $existingImages = [];
        if (File::exists($imagesPath)) {
            $files = File::files($imagesPath);
            foreach ($files as $file) {
                $existingImages[strtolower($file->getFilename())] = $file->getFilename();
            }
        }

        foreach ($blogs as $blog) {
            $imageName = $blog->cover_image;
            $imagePath = $imagesPath . '/' . $imageName;

            // Check if image exists with exact name
            if (File::exists($imagePath)) {
                $this->info("✅ {$blog->title}: Image exists - {$imageName}");
                continue;
            }

            // Try to find image with case-insensitive search
            $found = false;
            $lowerImageName = strtolower($imageName);

            if (isset($existingImages[$lowerImageName])) {
                // Found with different case
                $blog->cover_image = $existingImages[$lowerImageName];
                $blog->save();
                $this->info("✅ Fixed case: {$blog->title} -> {$existingImages[$lowerImageName]}");
                $fixedCount++;
                $found = true;
            } else {
                // Try to find by partial match (filename without extension)
                $baseName = pathinfo($imageName, PATHINFO_FILENAME);
                foreach ($existingImages as $lowerKey => $actualName) {
                    $existingBase = strtolower(pathinfo($actualName, PATHINFO_FILENAME));
                    if ($existingBase === strtolower($baseName)) {
                        $blog->cover_image = $actualName;
                        $blog->save();
                        $this->info("✅ Fixed extension: {$blog->title} -> {$actualName}");
                        $fixedCount++;
                        $found = true;
                        break;
                    }
                }
            }

            if (!$found) {
                $this->warn("❌ Missing: {$blog->title} - {$imageName}");
                $missingCount++;
            }
        }

        $this->info("\n=== Summary ===");
        $this->info("Total blogs checked: " . $blogs->count());
        $this->info("Fixed: {$fixedCount}");
        $this->info("Missing: {$missingCount}");

        if ($missingCount > 0) {
            $this->warn("\n⚠️  Some images are missing. Make sure to copy them to: public/uploads/blogs/");
        }
    }
}
