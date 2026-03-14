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
        Schema::table('loanapplications', function (Blueprint $table) {
            $table->text('g1_email')->nullable()->after('g1_contact_number');
            $table->text('g2_email')->nullable()->after('g2_contact_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loanapplications', function (Blueprint $table) {
            $table->dropColumn(['g1_email', 'g2_email']);
        });
    }
};
