<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        try {
            DB::statement("ALTER TABLE loanlist MODIFY COLUMN loan_status VARCHAR(50) NOT NULL");
        } catch (\Exception $e) {
            // Ignore error
        }
    }

    public function down(): void
    {
        //
    }
};
