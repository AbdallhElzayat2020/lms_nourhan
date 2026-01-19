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
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('description');
            $table->longText('meta_description')->nullable()->after('meta_title');
            $table->longText('meta_keywords')->nullable()->after('meta_description');
            $table->longText('schema_block')->nullable()->after('meta_keywords');
            $table->string('image_alt')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description', 'meta_keywords', 'schema_block', 'image_alt']);
        });
    }
};
