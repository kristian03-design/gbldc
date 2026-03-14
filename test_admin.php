<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Hash;
use App\Models\adminlist;

$admin = adminlist::first();

if ($admin) {
    echo "Email: " . $admin->email . "\n";
    echo "Password Hash: " . substr($admin->password, 0, 60) . "...\n";
    echo "Password Check (12345): " . (Hash::check('12345', $admin->password) ? 'CORRECT' : 'WRONG') . "\n";
    
    // Also try resetting the password
    $admin->password = Hash::make('12345');
    $admin->save();
    echo "Password reset and saved again!\n";
} else {
    echo "No admin found!\n";
}
