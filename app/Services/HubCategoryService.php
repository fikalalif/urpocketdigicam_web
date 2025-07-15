<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class HubCategoryService
{
    protected $client;
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $this->baseUrl = rtrim(env('HUB_API_URL'), '/') . '/'; // pastikan hanya 1 slash di akhir
        $this->clientId = env('HUB_CLIENT_ID');
        $this->clientSecret = env('HUB_CLIENT_SECRET');

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => ['Accept' => 'application/json'],
            'verify' => false, // bisa true kalau SSL-nya trusted
        ]);
    }

    public function createCategory($data)
    {
        try {
            $response = $this->client->post('product-category/sync', [
                'json' => array_merge([
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                ], $data),
            ]);

            return json_decode((string) $response->getBody(), true);
        } catch (\Throwable $e) {
            Log::error('Gagal sinkron kategori ke Hub: ' . $e->getMessage());
            throw $e;
        }
    }
}
