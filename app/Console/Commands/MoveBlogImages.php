<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class MoveBlogImages extends Command
{
    protected $signature = 'blog:move-images {--source=}';
    protected $description = 'Move blog images from old location to public/uploads/blogs/';

    public function handle()
    {
        $this->info('Starting to search and move blog images...');

        $targetLocation = public_path('uploads/blogs');

        if (!File::exists($targetLocation)) {
            File::makeDirectory($targetLocation, 0755, true);
        }

        // If source is provided, use it
        if ($source = $this->option('source')) {
            $this->moveFromSource($source, $targetLocation);
            return;
        }

        // Otherwise search in common locations
        $sourceLocations = [
            storage_path('app/public/posts'),
            storage_path('app/public'),
            public_path('posts'),
            public_path('storage/posts'),
            base_path('storage/app/public/posts'),
        ];

        $movedCount = 0;
        $skippedCount = 0;

        foreach ($sourceLocations as $sourceLocation) {
            if (File::exists($sourceLocation)) {
                $this->info("Searching in: {$sourceLocation}");
                $result = $this->moveFromSource($sourceLocation, $targetLocation);
                $movedCount += $result['moved'];
                $skippedCount += $result['skipped'];
            }
        }

        // Also search recursively in storage/app/public
        $storagePublic = storage_path('app/public');
        if (File::exists($storagePublic)) {
            $this->info("Searching recursively in: {$storagePublic}");
            $result = $this->searchRecursively($storagePublic, $targetLocation);
            $movedCount += $result['moved'];
            $skippedCount += $result['skipped'];
        }

        $this->info("✅ Image migration completed!");
        $this->info("Moved: {$movedCount} images");
        $this->info("Skipped: {$skippedCount} images (already exist)");
    }

    private function moveFromSource($sourceLocation, $targetLocation)
    {
        $movedCount = 0;
        $skippedCount = 0;

        if (!File::exists($sourceLocation)) {
            return ['moved' => 0, 'skipped' => 0];
        }

        // Get all image files
        $images = File::allFiles($sourceLocation);

        foreach ($images as $image) {
            $extension = strtolower($image->getExtension());
            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'jfif'])) {
                continue;
            }

            $filename = $image->getFilename();
            $targetPath = $targetLocation . '/' . $filename;

            if (File::exists($targetPath)) {
                $skippedCount++;
                continue;
            }

            try {
                File::copy($image->getPathname(), $targetPath);
                $this->info("✅ Moved: {$filename}");
                $movedCount++;
            } catch (\Exception $e) {
                $this->error("❌ Failed to move {$filename}: " . $e->getMessage());
            }
        }

        return ['moved' => $movedCount, 'skipped' => $skippedCount];
    }

    private function searchRecursively($directory, $targetLocation, &$movedCount = 0, &$skippedCount = 0)
    {
        if (!File::exists($directory) || !File::isDirectory($directory)) {
            return ['moved' => 0, 'skipped' => 0];
        }

        $moved = 0;
        $skipped = 0;

        // Get all files in current directory
        $files = File::files($directory);
        foreach ($files as $file) {
            $extension = strtolower($file->getExtension());
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'jfif'])) {
                $filename = $file->getFilename();
                $targetPath = $targetLocation . '/' . $filename;

                if (!File::exists($targetPath)) {
                    try {
                        File::copy($file->getPathname(), $targetPath);
                        $this->info("✅ Moved from recursive search: {$filename}");
                        $moved++;
                    } catch (\Exception $e) {
                        $this->error("❌ Failed to move {$filename}: " . $e->getMessage());
                    }
                } else {
                    $skipped++;
                }
            }
        }

        // Recursively search subdirectories
        $directories = File::directories($directory);
        foreach ($directories as $subDir) {
            $result = $this->searchRecursively($subDir, $targetLocation);
            $moved += $result['moved'];
            $skipped += $result['skipped'];
        }

        return ['moved' => $moved, 'skipped' => $skipped];
    }
}
