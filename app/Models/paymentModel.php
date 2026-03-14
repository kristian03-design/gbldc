<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class paymentModel extends Model
{
    protected $table = "paymentinfo";

    protected $fillable = [
        'loan_number',
        'member_id',
        'last_name',
        'first_name',
        'middle_name',
        'transaction_type',
        'payment_method',
        'payment_status',
        'transaction_date',
        'transaction_handler',
        'updater_name',
        'reference_number',
        'payment_amount',
        'remarks',
        'admin_copy',
        'member_copy'
    ] ;
    protected function casts(): array{
        return [
        'last_name' => 'encrypted',
        'first_name' => 'encrypted',
        'middle_name' => 'encrypted',
        // 'payment_method' => 'encrypted',
        'payment_status' => 'encrypted',
        'transaction_date' => 'encrypted',
        'transaction_handler' => 'encrypted',
        'updater_name' => 'encrypted',
        'reference_number' => 'encrypted',
        'payment_amount' => 'encrypted',
        'remarks' => 'encrypted',
        'admin_copy' => 'encrypted',
        'member_copy' => 'encrypted',
        ];
    }

}
