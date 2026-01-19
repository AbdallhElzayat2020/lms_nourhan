<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seo_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_name'); // e.g., 'home', 'about', 'contact', 'courses', 'teachers'
            $table->string('page_title'); // Display name for admin (e.g., "الصفحة الرئيسية")

            // Basic SEO Meta Tags
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            // Advanced SEO
            $table->longText('schema_markup')->nullable(); // JSON-LD structured data
            $table->string('canonical_url')->nullable(); // Canonical URL

            // Status
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Indexes
            $table->unique('page_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_pages');
    }
};
