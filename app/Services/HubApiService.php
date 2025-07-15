<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HubApiService
{
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $this->baseUrl = rtrim(env('HUB_API_URL'), '/');
        $this->clientId = env('HUB_CLIENT_ID');
        $this->clientSecret = env('HUB_CLIENT_SECRET');
    }

    public function createProduct(array $data)
    {
        try {
            $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
                ->post($this->baseUrl . '/product/sync', $data);

            return $response->json();
        } catch (\Exception $e) {
            Log::error('Error create product to Hub: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateProductVisibility($hubProductId, array $data)
    {
        try {
            $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
                ->put($this->baseUrl . "/products/{$hubProductId}/visibility", $data);

            return $response->json();
        } catch (\Exception $e) {
            Log::error('Error update visibility: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deleteProduct($hubProductId)
    {
        try {
            $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
                ->delete($this->baseUrl . "/products/{$hubProductId}");

            return $response->json();
        } catch (\Exception $e) {
            Log::error('Error delete product from Hub: ' . $e->getMessage());
            throw $e;
        }
    }
}
