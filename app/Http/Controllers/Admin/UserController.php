<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Package;
use App\Models\Subscription;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['subscription.package'])->whereDoesntHave('roles', function($q) {
             $q->where('name', 'admin');
        });

        if ($request->filled('status')) {
            $status = $request->status;
            if ($status == 'active') {
                $query->whereHas('subscription', function($q) {
                    $q->where('status', 'active')->where('expires_at', '>', now());
                });
            } elseif ($status == 'expired') {
                $query->where(function($subQuery) {
                    $subQuery->whereHas('subscription', function($q) {
                        $q->where('expires_at', '<', now());
                    })->orWhereDoesntHave('subscription');
                });
            }
        }

        $users = $query->latest()->paginate(10);
        $packages = Package::where('is_active', true)->get();

        return view('admin.users.index', compact('users', 'packages'));
    }

    public function activateForOffline(Request $request, User $user)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id'
        ]);

        $package = Package::findOrFail($request->package_id);

        $subscription = Subscription::updateOrCreate(
            ['user_id' => $user->id],
            [
                'package_id' => $package->id,
                'starts_at' => now(),
                'expires_at' => now()->addDays($package->duration_days),
                'status' => 'active',
            ]
        );

        $payment = Payment::create([
            'user_id' => $user->id,
            'subscription_id' => $subscription->id,
            'reference_duitku' => 'MANUAL-' . strtoupper(Str::random(10)),
            'payment_method' => 'OFFLINE_MANUAL',
            'amount' => $package->price,
            'status' => 'paid',
            'checkout_url' => null,
        ]);

        \App\Jobs\SendWhatsAppPaymentJob::dispatch($user, $package, $payment);

        return back()->with('success', 'Berhasil mengaktifkan paket ' . $package->name . ' untuk user ' . $user->name);
    }
}
