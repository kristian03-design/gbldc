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
        Schema::table('loanlist', function (Blueprint $table) {
            // Add missing personal information columns
            if (!Schema::hasColumn('loanlist', 'place_of_birth')) {
                $table->string('place_of_birth')->nullable()->after('middle_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loanlist', function (Blueprint $table) {
            $table->dropColumn('place_of_birth');
        });
    }
};
