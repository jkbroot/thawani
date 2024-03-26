<?php

namespace Jkbroot\Thawani\Api;

use Jkbroot\Thawani\Services\ThawaniService;

class Customers
{
    protected ThawaniService $thawaniService;

    /**
     * Create a new instance of the service.
     *
     * @param ThawaniService $thawaniService
     */
    public function __construct(ThawaniService $thawaniService)
    {
        $this->thawaniService = $thawaniService;
    }

    /**
     * Create a new customer.
     *
     * @param array $data The customer data.
     * @return array The response from the Thawani API.
     * @throws \Exception If the request fails or the API returns an error.
     */

    public function create(array $data): array
    {
        return $this->thawaniService->makeRequest('post', '/customers', $data);
    }

    /**
     * Update a customer.
     *
     * @param string $customerId The ID of the customer to update.
     * @param array $data The customer data.
     * @return array The response from the Thawani API.
     * @throws \Exception If the request fails or the API returns an error.
     */

    public function retrieve(string $customerId): array
    {
        return $this->thawaniService->makeRequest('get', "/customers/{$customerId}/");
    }

    // List all customers
    public function list(?int $limit = null, ?int $skip = null): array
    {
        $queryParams = [];

        if ($limit !== null) {
            $queryParams['limit'] = $limit;
        }
        if ($skip !== null) {
            $queryParams['skip'] = $skip;
        }

        $queryString = http_build_query($queryParams);

        $url = '/customers' . (!empty($queryString) ? "?{$queryString}" : '');

        return $this->thawaniService->makeRequest('get', $url);
    }

    public function delete(string $customerId): array
    {
        return $this->thawaniService->makeRequest('delete', "/customers/{$customerId}");
    }



}
