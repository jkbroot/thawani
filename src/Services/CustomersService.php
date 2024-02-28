<?php

namespace Jkbroot\Thawani\Services;

class CustomersService
{
    protected $thawaniService;

    public function __construct(ThawaniService $thawaniService)
    {
        $this->thawaniService = $thawaniService;
    }

    public function create(array $data)
    {
        return $this->thawaniService->makeRequest('post', '/customers', $data);
    }

    public function retrieve(string $customerId)
    {
        return $this->thawaniService->makeRequest('get', "/customers/{$customerId}/");
    }

    public function list(?int $limit = null, ?int $skip = null)
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

    public function delete(string $customerId)
    {
        return $this->thawaniService->makeRequest('delete', "/customers/{$customerId}");
    }
}
