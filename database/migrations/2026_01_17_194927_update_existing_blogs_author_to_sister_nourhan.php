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
        // Update all existing blogs that have null or empty author to 'Sister Nourhan'
        DB::table('blogs')
            ->whereNull('author')
            ->orWhere('author', '')
            ->update(['author' => 'Sister Nourhan']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optionally, you can revert the changes if needed
        // DB::table('blogs')
        //     ->where('author', 'Sister Nourhan')
        //     ->update(['author' => null]);
    }
};
