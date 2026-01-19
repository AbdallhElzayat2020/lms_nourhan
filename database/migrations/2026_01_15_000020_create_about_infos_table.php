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
        Schema::create('about_infos', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g. OUR HISTORY
            $table->string('slug')->unique(); // e.g. history, mission, vision
            $table->text('description');
            $table->string('icon_class')->nullable(); // fontawesome class
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_infos');
    }
};

