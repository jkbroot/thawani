<?php

namespace Jkbroot\Thawani\Api;

use Jkbroot\Thawani\Helpers\ValidationHelper;
use Jkbroot\Thawani\Services\ThawaniService;

class CheckoutSessions
{
    protected ThawaniService $thawaniService;

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

    public function list(?int $limit = null, ?int $skip = null)
    {
        $queryParams = [];

        if ($limit !== null && $limit > 0) {
            $queryParams['limit'] = $limit;
        }
        if ($skip !== null && $skip >= 0) {
            $queryParams['skip'] = $skip;
        }

        $queryString = http_build_query($queryParams);

        $url = '/checkout/session' . (!empty($queryString) ? "?{$queryString}" : '');

        return $this->thawaniService->makeRequest('get', $url);
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
