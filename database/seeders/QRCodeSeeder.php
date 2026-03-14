<?php

namespace Database\Seeders;

use App\Models\QRCode;
use Illuminate\Database\Seeder;

class QRCodeSeeder extends Seeder
{
    /**
     * Seed the qr_codes table with one active QR (points to public/images/qr-code.png).
     * Run: php artisan db:seed --class=QRCodeSeeder
     */
    public function run(): void
    {
        // Deactivate all so only one is active
        QRCode::query()->update(['is_active' => false]);

        // Create or update the QR that points to public/images/qr-code.png
        $qr = QRCode::firstOrCreate(
            ['qr_image_path' => 'qr-code.png'],
            ['is_active' => true]
        );
        $qr->update(['is_active' => true]);
    }
}
