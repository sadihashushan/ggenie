<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('supermarkets', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name'); // Add slug column, allow NULL initially
        });

        // Generate unique slugs for existing records
        DB::table('supermarkets')->get()->each(function ($supermarket) {
            $uniqueSlug = \Illuminate\Support\Str::slug($supermarket->name) . '-' . $supermarket->id;
            DB::table('supermarkets')->where('id', $supermarket->id)->update(['slug' => $uniqueSlug]);
        });

        // Now enforce uniqueness
        Schema::table('supermarkets', function (Blueprint $table) {
            $table->string('slug')->unique()->change(); // Add UNIQUE constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supermarkets', function (Blueprint $table) {
            $table->dropColumn('slug'); // Remove slug column
        });
    }
};
