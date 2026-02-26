<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $token;
    protected $apiUrl;

    public function __construct()
    {
        $this->token = config('services.fonnte.token', 'DUMMY_TOKEN_FOR_NOW');
        $this->apiUrl = 'https://api.fonnte.com/send';
    }

    public function sendMessage($target, $message)
    {
        // For local development or missing token, just log
        if ($this->token === 'DUMMY_TOKEN_FOR_NOW' || empty($this->token)) {
            Log::info("WhatsApp message to {$target}: {$message}");
            return true;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token
            ])->post($this->apiUrl, [
                'target' => $target,
                'message' => $message,
                'countryCode' => '62',
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error("Failed to send WhatsApp message: " . $e->getMessage());
            return false;
        }
    }
}
