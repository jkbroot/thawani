<?php

namespace Jkbroot\Thawani\Api;

use Jkbroot\Thawani\Services\ThawaniService;

class PaymentIntents
{
    protected ThawaniService $thawaniService;

    public function __construct(ThawaniService $thawaniService)
    {
        $this->thawaniService = $thawaniService;
    }

    public function list(?int $limit = null, ?int $skip = null)
    {
        $queryParams = [];

        if ($limit !== null && $skip !== null) {
            $queryParams = [
                'limit' => $limit,
                'skip' => $skip,
            ];
        }
        $queryString = http_build_query($queryParams);

        $url = '/payment_intents' . ($queryString ? "?{$queryString}" : '');

        return $this->thawaniService->makeRequest('get', $url);
    }

    public function create(array $data)
    {
        return $this->thawaniService->makeRequest('post', '/payment_intents', $data);
    }

    public function confirm(string $paymentIntentId)
    {
        return $this->thawaniService->makeRequest('post', "/payment_intents/{$paymentIntentId}/confirm");
    }

    public function retrieve(string $paymentIntentId)
    {
        return $this->thawaniService->makeRequest('get', "/payment_intents/{$paymentIntentId}");
    }

    public function cancel(string $paymentIntentId)
    {
        return $this->thawaniService->makeRequest('post', "/payment_intents/{$paymentIntentId}/cancel");
    }

    // Retrieve by client reference
    public function retrieveByClientReference($clientReferenceId): array
    {
        return $this->thawaniService->makeRequest('get', "/checkout/reference/{$clientReferenceId}");
    }

    // Retrieve by invoice

    public function retrieveByInvoice($invoice): array
    {
        return $this->thawaniService->makeRequest('get', "/checkout/invoice/{$invoice}");
    }
}
