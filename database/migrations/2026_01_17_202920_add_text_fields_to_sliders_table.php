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
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('text_line_1')->nullable()->after('description');
            $table->string('text_line_2')->nullable()->after('text_line_1');
            $table->string('text_line_3')->nullable()->after('text_line_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn(['text_line_1', 'text_line_2', 'text_line_3']);
        });
    }
};
