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
        Schema::table('contacts', function (Blueprint $table) {
            // Check if 'name' column exists and rename it to 'fullname'
            if (Schema::hasColumn('contacts', 'name')) {
                $table->renameColumn('name', 'fullname');
            } else {
                // If 'name' doesn't exist, add 'fullname' column
                $table->string('fullname')->after('id');
            }

            // Make 'message' column nullable if it exists and is required
            if (Schema::hasColumn('contacts', 'message')) {
                $table->text('message')->nullable()->change();
            }

            // Add missing columns if they don't exist
            if (!Schema::hasColumn('contacts', 'timezone')) {
                $table->string('timezone')->nullable()->after('email');
            }

            if (!Schema::hasColumn('contacts', 'country')) {
                $table->string('country')->nullable()->after('timezone');
            }

            if (!Schema::hasColumn('contacts', 'notes')) {
                $table->text('notes')->nullable()->after('country');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Rename back to 'name' if 'fullname' exists
            if (Schema::hasColumn('contacts', 'fullname')) {
                $table->renameColumn('fullname', 'name');
            }

            // Revert 'message' column back to required if it exists
            if (Schema::hasColumn('contacts', 'message')) {
                $table->text('message')->change();
            }

            // Drop added columns
            if (Schema::hasColumn('contacts', 'timezone')) {
                $table->dropColumn('timezone');
            }

            if (Schema::hasColumn('contacts', 'country')) {
                $table->dropColumn('country');
            }

            if (Schema::hasColumn('contacts', 'notes')) {
                $table->dropColumn('notes');
            }
        });
    }
};
