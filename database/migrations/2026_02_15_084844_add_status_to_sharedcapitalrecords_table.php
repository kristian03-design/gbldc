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
        Schema::table('sharedcapitalrecords', function (Blueprint $table) {
$table->string('status')->default('ongoing')->after('shared_capital_amount_balance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sharedcapitalrecords', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
