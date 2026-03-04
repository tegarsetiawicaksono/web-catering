<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

// Simulate an HTTP request
$request = Illuminate\Http\Request::create(
    '/admin/payment-verifications/14/verify',
    'POST',
    [
        '_token' => csrf_token(),
        'action' => 'verify',
        'notes' => null
    ]
);

// Fake authentication
$user = App\Models\User::where('role', 'admin')->first();
if ($user) {
    auth()->login($user);
    echo "Logged in as: " . $user->name . " (role: " . $user->role . ")\n";
} else {
    echo "No admin user found!\n";
    exit;
}

echo "\n=== Simulating verification request ===\n";
echo "Order ID: 14\n";
echo "Action: verify\n\n";

try {
    $response = $kernel->handle($request);
    echo "Response Status: " . $response->getStatusCode() . "\n";
    echo "Response Headers: " . json_encode($response->headers->all(), JSON_PRETTY_PRINT) . "\n";
    
    if ($response->isRedirect()) {
        echo "Redirect to: " . $response->headers->get('Location') . "\n";
    }
    
    // Check session for flash messages
    if ($request->session()->has('success')) {
        echo "Success message: " . $request->session()->get('success') . "\n";
    }
    if ($request->session()->has('error')) {
        echo "Error message: " . $request->session()->get('error') . "\n";
    }
    
    echo "\n=== Checking verification status ===\n";
    $verification = App\Models\PaymentVerification::where('order_id', 14)->latest()->first();
    if ($verification) {
        echo "Verification ID: " . $verification->id . "\n";
        echo "Status: " . $verification->status . "\n";
        echo "Verified by: " . ($verification->verified_by ?? 'null') . "\n";
        echo "Verified at: " . ($verification->verified_at ?? 'null') . "\n";
    }
    
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

$kernel->terminate($request, $response ?? null);
