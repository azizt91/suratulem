<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Payment;
use App\Models\Subscription;
use App\Services\DuitkuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function checkout(Package $package, DuitkuService $duitku)
    {
        $user = auth()->user();

        $subscription = Subscription::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'status' => 'pending',
        ]);

        $payment = Payment::create([
            'user_id' => $user->id,
            'subscription_id' => $subscription->id,
            'reference_duitku' => 'ORD-' . time() . '-' . rand(100, 999),
            'amount' => $package->price,
            'status' => 'unpaid',
        ]);

        $checkoutUrl = $duitku->createInvoice($payment, $user, $package);

        if ($checkoutUrl) {
            $payment->update(['checkout_url' => $checkoutUrl]);
            return redirect($checkoutUrl);
        }

        return back()->with('error', 'Gagal membuat tagihan Duitku.');
    }

    public function callback(Request $request, DuitkuService $duitku)
    {
        Log::info('Duitku Callback hit', $request->all());

        $merchantOrderId = $request->merchantOrderId;
        $payment = Payment::where('reference_duitku', $merchantOrderId)->first();

        if (!$payment) {
            return response()->json(['success' => false, 'message' => 'Payment not found'], 404);
        }

        if ($duitku->handleCallback($request)) {
            $payment->update(['status' => 'paid']);

            $subscription = $payment->subscription;
            $package = $subscription->package;

            $subscription->update([
                'status' => 'active',
                'starts_at' => now(),
                'expires_at' => now()->addDays($package->duration_days),
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}
