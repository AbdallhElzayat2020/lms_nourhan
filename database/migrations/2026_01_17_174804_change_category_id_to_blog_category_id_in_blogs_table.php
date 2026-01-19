<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Drop the old foreign key and column
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });

        Schema::table('blogs', function (Blueprint $table) {
            // Add the new column with foreign key to blog_categories
            $table->foreignId('blog_category_id')->nullable()->after('author')->constrained('blog_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Drop the new foreign key and column
            $table->dropForeign(['blog_category_id']);
            $table->dropColumn('blog_category_id');
        });

        Schema::table('blogs', function (Blueprint $table) {
            // Restore the old column with foreign key to categories
            $table->foreignId('category_id')->nullable()->after('author')->constrained('categories')->onDelete('set null');
        });
    }
};
