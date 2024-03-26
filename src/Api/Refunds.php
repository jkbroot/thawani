<?php

namespace Jkbroot\Thawani\Api;

use Jkbroot\Thawani\Services\ThawaniService;

class Refunds
{
    protected ThawaniService $thawaniService;

    public function __construct(ThawaniService $thawaniService)
    {
        $this->thawaniService = $thawaniService;
    }

    /**
     * Create a refund for a given payment.
     *
     * @param string $paymentId The ID of the payment to refund.
     * @param array $data The data for the refund creation.
     * @return array The response from the Thawani API.
     * @throws \Exception If the request fails or the API returns an error.
     */
    public function create(array $data)
    {
        return $this->thawaniService->makeRequest('post', "/refunds", $data);
    }

    /**
     * List all refunds.
     *
     * @return array The list of refunds from the Thawani API.
     * @throws \Exception If the request fails or the API returns an error.
     */
    public function list()
    {
        return $this->thawaniService->makeRequest('get', '/refunds');
    }

    /**
     * Retrieve a refund by its ID.
     *
     * @param string $refundId The ID of the refund to retrieve.
     * @return array The response from the Thawani API.
     */
    public function retrieve(string $refundId)
    {
        return $this->thawaniService->makeRequest('get', "/refunds/{$refundId}");
    }

}
