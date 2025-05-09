<?php

namespace App\Services;

use App\Models\SmsLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class SmsService
{
    protected $apiKey;
    protected $senderId;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.sms.api_key');
        $this->senderId = config('services.sms.sender_id');
        $this->baseUrl = config('services.sms.base_url');
    }

    public function send($phone, $message, SmsLog $smsLog = null)
    {
        try {
            $phone = $this->formatPhoneNumber($phone);

            $response = Http::get($this->baseUrl, [
                'api_key' => $this->apiKey,
                'sender_id' => $this->senderId,
                'to' => $phone,
                'message' => $message,
            ]);

            $result = $response->json();
            $status = ($result['status'] ?? 'failed') === 'success' ? 'delivered' : 'failed';

            if ($smsLog) {
                $smsLog->update([
                    'status' => $status,
                    'response_data' => json_encode($result),
                    'message_id' => $result['message_id'] ?? null,
                    'gateway' => 'custom_sms_gateway',
                    'sent_at' => now(),
                    'delivered_at' => $status === 'delivered' ? now() : null,
                    'error_message' => $status === 'failed' ? ($result['message'] ?? 'Unknown error') : null,
                ]);
            }

            return [
                'success' => $status === 'delivered',
                'message_id' => $result['message_id'] ?? null,
                'message' => $result['message'] ?? 'No message returned',
                'data' => $result
            ];
        } catch (Exception $e) {
            Log::error('SMS sending failed: ' . $e->getMessage(), [
                'phone' => $phone,
                'message' => $message
            ]);

            if ($smsLog) {
                $smsLog->update([
                    'status' => 'failed',
                    'response_data' => json_encode(['error' => $e->getMessage()]),
                    'gateway' => 'custom_sms_gateway',
                    'error_message' => $e->getMessage(),
                    'sent_at' => now(),
                ]);
            }

            return [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    public function getBalance()
    {
        try {
            $response = Http::get($this->baseUrl . '/balance', [
                'api_key' => $this->apiKey
            ]);

            $result = $response->json();

            return [
                'success' => true,
                'balance' => $result['balance'] ?? 0,
                'data' => $result
            ];
        } catch (Exception $e) {
            Log::error('SMS balance check failed: ' . $e->getMessage());

            return [
                'success' => false,
                'balance' => 0,
                'message' => $e->getMessage()
            ];
        }
    }

    protected function formatPhoneNumber($number)
    {
        $number = preg_replace('/[^0-9]/', '', $number);

        if (substr($number, 0, 2) !== '88') {
            $number = '88' . $number;
        }

        return $number;
    }
}
