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
        // Fix columns to allow NULL values
        $columns = [
            'interest_rate',
            'loan_term_months',
            'monthly_payment',
            'total_amount_due',
            'outstanding_balance',
            'amount_paid',
            'loan_release_date',
            'payment_end_date',
            'purpose',
            'remarks',
        ];
        
        foreach ($columns as $column) {
            try {
                DB::statement("ALTER TABLE loanlist MODIFY COLUMN {$column} TEXT NULL");
            } catch (\Exception $e) {
                // Column might have issues, continue
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
