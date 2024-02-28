<?php

namespace Jkbroot\Thawani\Services;

class PaymentMethodsService
{
    protected $thawaniService;

    public function __construct(ThawaniService $thawaniService)
    {
        $this->thawaniService = $thawaniService;
    }

    public function forCustomer(string $customerId)
    {
        return $this->thawaniService->makeRequest('get', "/payment_methods?customer_id={$customerId}");
    }

    public function delete(string $cardId)
    {
        return $this->thawaniService->makeRequest('delete', "/payment_methods/{$cardId}");
    }
}
