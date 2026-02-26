<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\WhatsAppService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWhatsAppRegistrationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(WhatsAppService $waService): void
    {
        $adminPhone = env('ADMIN_WHATSAPP', '081234567890');
        
        $message = "Halo Admin! Ada pendaftaran user baru:\n\n";
        $message .= "Nama: {$this->user->name}\n";
        $message .= "Email: {$this->user->email}\n";
        $message .= "Waktu: " . now()->format('Y-m-d H:i:s') . "\n\n";
        $message .= "Silakan pantau di Dashboard Admin.";

        $waService->sendMessage($adminPhone, $message);
    }
}
