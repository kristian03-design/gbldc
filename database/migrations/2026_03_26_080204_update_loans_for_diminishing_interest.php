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
            $table->integer('grace_period')->default(3)->after('due_amount');
            $table->string('penalty_type')->default('fixed')->after('grace_period');
            $table->decimal('penalty_value', 10, 2)->default(50.00)->after('penalty_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loanlist', function (Blueprint $table) {
            //
        });
    }
};
