<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Package;
use App\Models\Payment;
use App\Services\WhatsAppService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWhatsAppPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $package;
    public $payment;

    public function __construct(User $user, Package $package, Payment $payment)
    {
        $this->user = $user;
        $this->package = $package;
        $this->payment = $payment;
    }

    public function handle(WhatsAppService $waService): void
    {
        $adminPhone = env('ADMIN_WHATSAPP', '081234567890');
        
        $message = "✅ Transaksi Berhasil!\n\n";
        $message .= "User: {$this->user->name}\n";
        $message .= "Paket: {$this->package->name}\n";
        $message .= "Nominal: Rp " . number_format($this->payment->amount, 0, ',', '.') . "\n";
        $message .= "Status: PAID\n";

        $waService->sendMessage($adminPhone, $message);
    }
}
