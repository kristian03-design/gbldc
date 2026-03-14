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
        Schema::create("paymentinfo", function (Blueprint $table) {
            $table->id(); // Primary key
            $table->timestamps(); // created_at & updated_at

            // Column definitions with adjusted variable names
            $table->text("loan_number")->nullable();
            $table->text("member_id"); 
            $table->text("last_name"); 
            $table->text("first_name"); 
            $table->text("middle_name"); 
            $table->text("transaction_type"); 
            $table->text("payment_method");
            $table->text("payment_status");
            $table->text("transaction_date"); 
            $table->text("transaction_handler");
            $table->text("updater_name");
            $table->text("reference_number")->unique(); 
            $table->text("payment_amount");
            $table->text("remarks")->nullable();
            $table->text("admin_copy")->nullable(); 
            $table->text("member_copy")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("paymentinfo");
    }
};
