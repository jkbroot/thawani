<?php

namespace Jkbroot\Thawani\Api;

use Jkbroot\Thawani\Services\ThawaniService;

class PaymentMethods
{
    protected ThawaniService $thawaniService;

    public function __construct(ThawaniService $thawaniService)
    {
        $this->thawaniService = $thawaniService;
    }

    /**
     * List a customer's payment methods.
     *
     * @param string $customerId The ID of the customer to list payment methods for.
     * @return array The response from the Thawani API.
     * @throws \Exception If the request fails or the API returns an error.
     */

    public function list(string $customerId): array
    {
        return $this->thawaniService->makeRequest('get', "/payment_methods?customer_id={$customerId}");
    }


    /**
     * delete a customer's payment method.
     * @param string $cardId The ID of the card to delete.
     * @return array The response from the Thawani API.
     * @throws \Exception If the request fails or the API returns an error.
     */
    public function delete(string $cardId)
    {
        return $this->thawaniService->makeRequest('delete', "/payment_methods/{$cardId}");
    }
}
