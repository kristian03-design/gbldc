<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QRCode extends Model
{
    protected $table = 'qr_codes';
    
    protected $fillable = [
        'qr_image_path',
        'is_active',
    ];
}
