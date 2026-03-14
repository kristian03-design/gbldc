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
        Schema::create("sharedcapitalrecords", function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->timestamps(); // created_at and updated_at

            // Personal Information
            $table->text('last_name');
            $table->text('first_name');
            $table->text('middle_name');

            // Address
            $table->text('street_address');
            $table->text('barangay');
            $table->text('city');
            $table->text('province');

            // Contact Information
            $table->text('phone');
            $table->text('email');

            // Membership Details
            $table->text('shared_capital_amount');
            $table->text('shared_capital_amount_balance');
            $table->text('date_of_membership');

            // Admin Fields
            $table->text('member_id')->unique();
            $table->text('encoded_by');
            $table->text('remarks')->nullable();
            $table->text('record_creation_date')->nullable();

            // Payment Schedule Fields
            $table->text('payment_frequency');
            $table->text('payment_amount_per_schedule');
            $table->text('payment_start_date');
            $table->text('number_of_payments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("sharedcapitalrecords");
    }
};
