<?php

namespace Jkbroot\Thawani;

use Jkbroot\Thawani\Services\CheckoutSessionsService;
use Jkbroot\Thawani\Services\CustomersService;
use Jkbroot\Thawani\Services\PaymentIntentsService;
use Jkbroot\Thawani\Services\PaymentMethodsService;
use Jkbroot\Thawani\Services\RefundsService;
use Illuminate\Container\Container;
use Exception;

/**
 * @property-read CheckoutSessionsService $checkoutSessions
 * @property-read CustomersService $customers
 * @property-read PaymentMethodsService $paymentMethods
 * @property-read PaymentIntentsService $paymentIntents
 * @property-read RefundsService $refunds
 */

class ThawaniPay
{
    /**
     * The array of resolved service instances.
     *
     * @var array
     */
    protected $services = [];

    /**
     * Create a new ThawaniPay instance and resolve dependencies.
     */
    public function __construct()
    {
        $this->resolveDependencies();
    }

    /**
     * Resolve service dependencies from the container.
     *
     * @return void
     */
    protected function resolveDependencies(): void
    {
        $container = Container::getInstance();

        // Resolve services from the container
        $this->services['checkoutSessions'] = $container->make(CheckoutSessionsService::class);
        $this->services['customers'] = $container->make(CustomersService::class);
        $this->services['paymentMethods'] = $container->make(PaymentMethodsService::class);
        $this->services['paymentIntents'] = $container->make(PaymentIntentsService::class);
        $this->services['refunds'] = $container->make(RefundsService::class);
    }

    /**
     * Magic method to get services dynamically.
     *
     * @param string $name The name of the service to get.
     * @return mixed
     *
     * @throws Exception If the service is not found.
     */
    public function __get(string $name)
    {
        if (!isset($this->services[$name])) {
            throw new Exception("Service {$name} not found.");
        }

        return $this->services[$name];
    }
}
