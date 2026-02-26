<?php

use App\Models\User;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Package;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;

it('updates payment and subscription on valid duitku callback', function () {
    $user = User::factory()->create();
    $package = Package::create(['name' => 'Premium', 'price' => 100000, 'duration_days' => 30]);

    $subscription = Subscription::create([
        'user_id' => $user->id,
        'package_id' => $package->id,
        'status' => 'pending',
    ]);

    $payment = Payment::create([
        'user_id' => $user->id,
        'subscription_id' => $subscription->id,
        'reference_duitku' => 'ORD-123',
        'amount' => 100000,
        'status' => 'unpaid',
    ]);

    // Register temporary route for callback using our controller action
    Route::post('/duitku/callback', [\App\Http\Controllers\PaymentController::class, 'callback'])->name('duitku.callback');

    // Setup fake settings
    Setting::create(['key' => 'duitku_merchant_code', 'value' => 'TESTCODE']);
    Setting::create(['key' => 'duitku_merchant_key', 'value' => 'TESTKEY']);

    // Generate valid signature
    $merchantCode = 'TESTCODE';
    $amount = '100000';
    $merchantOrderId = 'ORD-123';
    $merchantKey = 'TESTKEY';
    $calcSignature = md5($merchantCode . $amount . $merchantOrderId . $merchantKey);

    $response = $this->postJson('/duitku/callback', [
        'merchantCode' => $merchantCode,
        'amount' => $amount,
        'merchantOrderId' => $merchantOrderId,
        'signature' => $calcSignature,
        'resultCode' => '00', // Success
    ]);

    $response->assertStatus(200);
    $response->assertJson(['success' => true]);

    $this->assertDatabaseHas('payments', [
        'id' => $payment->id,
        'status' => 'paid',
    ]);

    $this->assertDatabaseHas('subscriptions', [
        'id' => $subscription->id,
        'status' => 'active',
    ]);
});
