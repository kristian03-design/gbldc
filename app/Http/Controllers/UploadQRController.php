<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\QRCode;

class UploadQRController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'qr_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $existingQR = QRCode::first();

        if ($existingQR && $existingQR->qr_image_path) {
            Storage::disk('public')->delete($existingQR->qr_image_path);
        }

        $pathForDb = $request->file('qr_image')->store('qr-codes', 'public');

        if ($existingQR) {
            $existingQR->update([
                'qr_image_path' => $pathForDb,
                'is_active' => true,
            ]);
        } else {
            QRCode::create([
                'qr_image_path' => $pathForDb,
                'is_active' => true,
            ]);
        }

        return redirect()->route('Admin.dashboard')->with('success', 'QR Code uploaded successfully!');
    }
}
