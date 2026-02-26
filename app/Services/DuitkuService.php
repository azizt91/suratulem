<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DuitkuService
{
    protected $merchantCode;
    protected $merchantKey;
    protected $isSandbox;
    protected $baseUrl;

    public function __construct()
    {
        $this->merchantCode = Setting::getVal('duitku_merchant_code', env('DUITKU_MERCHANT_CODE', ''));
        $this->merchantKey = Setting::getVal('duitku_merchant_key', env('DUITKU_MERCHANT_KEY', ''));
        $this->isSandbox = Setting::getVal('duitku_sandbox', env('DUITKU_SANDBOX', true));
        
        $this->baseUrl = $this->isSandbox 
            ? 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry' 
            : 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry';
    }

    public function createInvoice($payment, $user, $package)
    {
        $timestamp = round(microtime(true) * 1000);
        $merchantOrderId = $payment->reference_duitku;
        $paymentAmount = $payment->amount;

        $signature = hash('sha256', $this->merchantCode . $timestamp . $this->merchantKey);

        $params = [
            'merchantCode' => $this->merchantCode,
            'paymentAmount' => $paymentAmount,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => 'Payment for Package: ' . $package->name,
            'email' => $user->email,
            'customerVaName' => $user->name,
            'callbackUrl' => route('duitku.callback'),
            'returnUrl' => route('dashboard'),
            'signature' => $signature,
            'timestamp' => $timestamp,
        ];

        try {
            $response = Http::post($this->baseUrl, $params);
            $result = $response->json();

            if (isset($result['statusCode']) && $result['statusCode'] == '00') {
                return $result['paymentUrl'];
            }

            Log::error('Duitku Create Invoice Error', ['response' => $result]);
            return null;
        } catch (\Exception $e) {
            Log::error('Duitku Exception: ' . $e->getMessage());
            return null;
        }
    }

    public function handleCallback($request)
    {
        $merchantCode = $request->merchantCode;
        $amount = $request->amount;
        $merchantOrderId = $request->merchantOrderId;
        $signature = $request->signature;
        $resultCode = $request->resultCode;

        // Verify signature (MD5) -> Duitku usually uses MD5 for callback: merchantCode + amount + merchantOrderId + merchantKey
        $calcSignature = md5($this->merchantCode . $amount . $merchantOrderId . $this->merchantKey);

        if ($signature !== $calcSignature) {
            Log::warning("Duitku Callback Invalid Signature!", $request->all());
            return false;
        }

        if ($resultCode === '00') {
            return true; // Success
        }

        return false;
    }
}
