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
        // Add all missing columns with nullable
        $missingColumns = [
            'interest_rate' => 'TEXT NULL',
            'loan_term_months' => 'TEXT NULL',
            'monthly_payment' => 'TEXT NULL',
            'total_amount_due' => 'TEXT NULL',
            'outstanding_balance' => 'TEXT NULL',
            'amount_paid' => 'TEXT NULL',
            'loan_release_date' => 'DATE NULL',
            'payment_end_date' => 'DATE NULL',
            'purpose' => 'TEXT NULL',
            'remarks' => 'TEXT NULL',
        ];
        
        foreach ($missingColumns as $column => $definition) {
            try {
                DB::statement("ALTER TABLE loanlist ADD COLUMN IF NOT EXISTS {$column} {$definition}");
            } catch (\Exception $e) {
                // Column might already exist
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to drop columns
    }
};
