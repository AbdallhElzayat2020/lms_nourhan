<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MoveBlogImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * This seeder will search for blog images in various locations
     * and move them to public/uploads/blogs/
     */
    public function run(): void
    {
        $this->command->info('Starting to search and move blog images...');

        // Possible source locations
        $sourceLocations = [
            storage_path('app/public/posts'),
            storage_path('app/public'),
            public_path('posts'),
            public_path('storage/posts'),
            storage_path('app/public/posts/August2024'),
            storage_path('app/public/posts/November2025'),
            storage_path('app/public/posts/December2025'),
            // Add any other locations where images might be
        ];

        $targetLocation = public_path('uploads/blogs');

        // Ensure target directory exists
        if (!File::exists($targetLocation)) {
            File::makeDirectory($targetLocation, 0755, true);
            $this->command->info("Created target directory: {$targetLocation}");
        }

        $movedCount = 0;
        $skippedCount = 0;

        // Search in each source location
        foreach ($sourceLocations as $sourceLocation) {
            if (!File::exists($sourceLocation)) {
                $this->command->warn("Source location not found: {$sourceLocation}");
                continue;
            }

            $this->command->info("Searching in: {$sourceLocation}");

            // Find all image files recursively
            $images = File::allFiles($sourceLocation);

            foreach ($images as $image) {
                $filename = $image->getFilename();
                $targetPath = $targetLocation . '/' . $filename;

                // Skip if already exists in target
                if (File::exists($targetPath)) {
                    $this->command->info("Skipping (already exists): {$filename}");
                    $skippedCount++;
                    continue;
                }

                // Copy the file
                try {
                    File::copy($image->getPathname(), $targetPath);
                    $this->command->info("Moved: {$filename}");
                    $movedCount++;
                } catch (\Exception $e) {
                    $this->command->error("Failed to move {$filename}: " . $e->getMessage());
                }
            }
        }

        // Also check for images in subdirectories like posts/August2024/, posts/November2025/, etc.
        $this->searchInSubdirectories($sourceLocations, $targetLocation, $movedCount, $skippedCount);

        $this->command->info("Image migration completed!");
        $this->command->info("Moved: {$movedCount} images");
        $this->command->info("Skipped: {$skippedCount} images (already exist)");
    }

    private function searchInSubdirectories($sourceLocations, $targetLocation, &$movedCount, &$skippedCount)
    {
        // Also search in storage/app/public recursively for posts folders
        $storagePublic = storage_path('app/public');
        if (File::exists($storagePublic)) {
            $this->command->info("Searching recursively in: {$storagePublic}");
            $this->searchRecursively($storagePublic, $targetLocation, $movedCount, $skippedCount);
        }

        foreach ($sourceLocations as $sourceLocation) {
            if (!File::exists($sourceLocation)) {
                continue;
            }

            // Look for subdirectories like posts/August2024/, posts/November2025/, etc.
            if (File::isDirectory($sourceLocation)) {
                $directories = File::directories($sourceLocation);

                foreach ($directories as $directory) {
                    $this->command->info("Searching in subdirectory: {$directory}");

                    $images = File::allFiles($directory);

                    foreach ($images as $image) {
                        $filename = $image->getFilename();
                        $targetPath = $targetLocation . '/' . $filename;

                        // Skip if already exists in target
                        if (File::exists($targetPath)) {
                            $this->command->info("Skipping (already exists): {$filename}");
                            $skippedCount++;
                            continue;
                        }

                        // Copy the file
                        try {
                            File::copy($image->getPathname(), $targetPath);
                            $this->command->info("Moved: {$filename}");
                            $movedCount++;
                        } catch (\Exception $e) {
                            $this->command->error("Failed to move {$filename}: " . $e->getMessage());
                        }
                    }
                }
            }
        }
    }

    private function searchRecursively($directory, $targetLocation, &$movedCount, &$skippedCount)
    {
        if (!File::exists($directory) || !File::isDirectory($directory)) {
            return;
        }

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
                        $this->command->info("Moved from recursive search: {$filename}");
                        $movedCount++;
                    } catch (\Exception $e) {
                        $this->command->error("Failed to move {$filename}: " . $e->getMessage());
                    }
                }
            }
        }

        // Recursively search subdirectories
        $directories = File::directories($directory);
        foreach ($directories as $subDir) {
            $this->searchRecursively($subDir, $targetLocation, $movedCount, $skippedCount);
        }
    }
}
