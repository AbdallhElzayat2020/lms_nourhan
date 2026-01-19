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
        // Add canonical_url to teachers table
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('canonical_url')->nullable()->after('schema_block');
        });

        // Add canonical_url to categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->string('canonical_url')->nullable()->after('schema_block');
        });

        // Add canonical_url to courses table
        Schema::table('courses', function (Blueprint $table) {
            $table->string('canonical_url')->nullable()->after('schema_block');
        });

        // Add canonical_url to events table
        Schema::table('events', function (Blueprint $table) {
            $table->string('canonical_url')->nullable()->after('schema_block');
        });

        // Add canonical_url to pricing_plans table
        Schema::table('pricing_plans', function (Blueprint $table) {
            $table->string('canonical_url')->nullable()->after('schema_block');
        });

        // Add canonical_url to blogs table
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('canonical_url')->nullable()->after('schema_block');
        });

        // Add canonical_url to blog_categories table
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->string('canonical_url')->nullable()->after('schema_block');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('canonical_url');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('canonical_url');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('canonical_url');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('canonical_url');
        });

        Schema::table('pricing_plans', function (Blueprint $table) {
            $table->dropColumn('canonical_url');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('canonical_url');
        });

        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropColumn('canonical_url');
        });
    }
};
