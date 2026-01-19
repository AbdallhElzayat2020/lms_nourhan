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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('slug')->unique();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->string('banner_image')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // Course Details
            $table->string('lessons_count')->default(0);
            $table->enum('course_type', ['private', 'live', 'both'])->default('both');
            $table->integer('duration_hours')->default(0);
            $table->string('language')->nullable();

            // Sections
            $table->longText('about_program_text')->nullable();
            $table->string('about_program_image')->nullable();
            $table->longText('how_course_works_text')->nullable();
            $table->string('how_course_works_image')->nullable();
            $table->longText('what_you_achieve_text')->nullable();
            $table->string('what_you_achieve_image')->nullable();

            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
