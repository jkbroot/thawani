<?php

namespace Jkbroot\Thawani\Services;

use Jkbroot\Thawani\Helpers\ValidationHelper;

class CheckoutSessionsService
{
    protected $thawaniService;

    private const REQUIRED_FIELDS = ['client_reference_id', 'mode', 'products', 'success_url', 'cancel_url', 'metadata'];
    private const PRODUCT_FIELDS = ['name', 'quantity', 'unit_amount'];

    public function __construct(ThawaniService $thawaniService)
    {
        $this->thawaniService = $thawaniService;
    }

    public function create(array $data)
    {
        return $this->thawaniService->makeRequest('post', '/checkout/session', $data);
    }

    public function retrieve(string $sessionId)
    {
        return $this->thawaniService->makeRequest('get', "/checkout/session/{$sessionId}");
    }

    public function getAll()
    {
        return $this->thawaniService->makeRequest('get', "/checkout/session/");
    }

    public function cancel(string $sessionId)
    {
        return $this->thawaniService->makeRequest('post', "/checkout/{$sessionId}/cancel");
    }

    public function createCheckoutUrl(array $data)
    {
        $this->validateSessionData($data);
        $response = $this->create($data);

        if (!isset($response['data']['session_id'])) {
            throw new \Exception('Session creation failed or session_id not returned from API');
        }

        $sessionId = $response['data']['session_id'];
        return [
            'session_id' => $sessionId,
            'redirect_url' => $this->constructRedirectUrl($sessionId),
        ];
    }

    protected function constructRedirectUrl($sessionId)
    {
        return "{$this->thawaniService->getCheckoutBaseUrl()}/{$sessionId}?key={$this->thawaniService->getPublishableKey()}";
    }

    protected function validateSessionData(array $data)
    {
        ValidationHelper::validateSessionData($data, self::REQUIRED_FIELDS, self::PRODUCT_FIELDS);
    }
}
