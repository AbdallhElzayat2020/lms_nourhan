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
        Schema::create('teacher_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
            $table->string('title'); // Certificate title/name
            $table->string('issuer')->nullable(); // Who issued the certificate
            $table->string('image'); // Certificate image path
            $table->string('image_alt')->nullable(); // Alt text for image
            $table->text('description')->nullable(); // Additional details
            $table->integer('sort_order')->default(0); // For ordering certificates
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_certificates');
    }
};
