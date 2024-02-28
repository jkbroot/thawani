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
}
