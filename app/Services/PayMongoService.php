<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PayMongoService
{
    protected $baseUrl;
    protected $secretKey;

    public function __construct()
    {
        $this->baseUrl = config('services.paymongo.base_url');
        $this->secretKey = config('services.paymongo.secret_key');
        $this->publicKey = config('services.paymongo.public_key');
    }

    public function createSource($amount, $successUrl, $failedUrl, $type = 'gcash')
    {
        $payload = [
            'data' => [
                'attributes' => [
                    'amount' => $amount,
                    'redirect' => [
                        'success' => $successUrl,
                        'failed' => $failedUrl
                    ],
                    'type' => $type,
                    'currency' => 'PHP'
                ]
            ]
        ];

        $response = Http::withBasicAuth($this->publicKey, '')
            ->post("{$this->baseUrl}/sources", $payload);

        return $response->json();
    }

    public function getSource($sourceId)
    {
        $response = Http::withBasicAuth($this->secretKey, '')
            ->get("{$this->baseUrl}/sources/{$sourceId}");

        return $response->json();
    }

    public function createPaymentIntent($amount, $sourceId)
    {
        $payload = [
            'data' => [
                'attributes' => [
                    'amount' => $amount,
                    'payment_method_allowed' => ['gcash'],
                    'payment_method_options' => [
                        'gcash' => [
                            'source' => [
                                'id' => $sourceId,
                                'type' => 'source'
                            ]
                        ]
                    ],
                    'currency' => 'PHP',
                    'capture_type' => 'automatic'
                ]
            ]
        ];

        $response = Http::withBasicAuth($this->secretKey, '')
            ->post("{$this->baseUrl}/payment_intents", $payload);

        return $response->json();
    }
}
