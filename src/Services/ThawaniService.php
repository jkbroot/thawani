<?php

namespace Jkbroot\Thawani\Services;

use Illuminate\Support\Facades\Http;

class ThawaniService
{
    protected $baseUrl;
    protected $secretKey;
    protected $publishableKey;
    protected $checkoutBaseUrl;

    /**
     * Initialize Thawani service with configuration.
     */

    public function __construct()
    {
        $config = config('thawani.' . config('thawani.mode'));
        $this->baseUrl = $config['base_url'];
        $this->secretKey = $config['secret_key'];
        $this->publishableKey = $config['publishable_key'];
        $this->checkoutBaseUrl = $config['checkout_base_url'];
    }

    /**
     * Get the publishable key.
     *
     * @return string
     */

    public function getPublishableKey()
    {
        return $this->publishableKey;
    }

    /**
     * Get the checkout base URL.
     *
     * @return string
     */
    public function getCheckoutBaseUrl()
    {
        return $this->checkoutBaseUrl;
    }

    /**
     * Make an API request to Thawani.
     *
     * @param  string  $method  The HTTP method to use for the request.
     * @param  string  $uri  The API endpoint to request.
     * @param  array  $data  The data to send with the request.
     * @return array
     *
     * @throws \Exception If the API request fails.
     */
    public function makeRequest($method, $uri, array $data = [])
    {
        $response = Http::baseUrl($this->baseUrl)
            ->withHeaders(['thawani-api-key' => $this->secretKey])
            ->asJson()
            ->$method($uri, $data);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception(
            $response->json()['description'] ?? 'Unknown error',
            $response->json()['code'] ?? 0
        );
    }
}
