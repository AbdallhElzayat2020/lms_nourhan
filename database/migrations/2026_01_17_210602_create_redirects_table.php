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
        Schema::create('redirects', function (Blueprint $table) {
            $table->id();
            $table->string('old_url', 500);
            $table->string('new_url', 500);
            $table->enum('status_code', ['301', '302'])->default('301');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('hit_count')->default(0);
            $table->timestamp('last_hit_at')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['old_url', 'status']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redirects');
    }
};
