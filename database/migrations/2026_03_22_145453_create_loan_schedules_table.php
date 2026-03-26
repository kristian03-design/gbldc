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
        Schema::create('loan_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('loan_number')->index();
            $table->string('member_id')->index();
            $table->date('due_date');
            $table->decimal('monthly_payment', 10, 2);
            $table->decimal('principal_amount', 10, 2);
            $table->decimal('interest_amount', 10, 2);
            $table->decimal('remaining_balance', 10, 2);
            $table->enum('status', ['pending', 'partial', 'paid'])->default('pending');
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->string('payment_id_reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_schedules');
    }
};
