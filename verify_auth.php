<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$admin = User::where('role', 'admin')->first();
$user = User::where('role', 'user')->first();

if (!$admin || !$user) {
    echo "Admin or User not found\n";
    exit(1);
}

$adminProduct = Product::where('user_id', $admin->id)->first();
$userProduct = Product::where('user_id', $user->id)->first();

echo "--- Policy: Product update (Admin hold highest authority + Owner can manage) ---\n";
echo "Admin on Own Product: " . (Gate::forUser($admin)->allows('update', $adminProduct) ? "YES" : "NO") . "\n";
echo "Admin on User Product: " . (Gate::forUser($admin)->allows('update', $userProduct) ? "YES" : "NO") . "\n";
echo "User on Own Product: " . (Gate::forUser($user)->allows('update', $userProduct) ? "YES" : "NO") . "\n";
echo "User on Other Product: " . (Gate::forUser($user)->allows('update', $adminProduct) ? "YES" : "NO") . "\n";
