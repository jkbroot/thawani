<?php

namespace Jkbroot\Thawani;

use Exception;
use Illuminate\Container\Container;
use Jkbroot\Thawani\Api\CheckoutSessions;
use Jkbroot\Thawani\Api\Customers;
use Jkbroot\Thawani\Api\PaymentIntents;
use Jkbroot\Thawani\Api\PaymentMethods;
use Jkbroot\Thawani\Api\Refunds;

/**
 * @property-read CheckoutSessions $checkoutSessions
 * @property-read Customers $customers
 * @property-read PaymentMethods $paymentMethods
 * @property-read PaymentIntents $paymentIntents
 * @property-read Refunds $refunds
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
     * Create a new ThawaniPay instance.
     *
     * @param Container|null $container Dependency injection container instance.
     */
    public function __construct(Container $container = null)
    {
        $container = $container ?: Container::getInstance();
        $this->resolveDependencies($container);
    }

    /**
     * Resolve service dependencies.
     *
     * @param Container $container Dependency injection container.
     * @return void
     */
    protected function resolveDependencies(Container $container): void
    {
        $this->services['checkoutSessions'] = $container->make(CheckoutSessions::class);
        $this->services['customers'] = $container->make(Customers::class);
        $this->services['paymentMethods'] = $container->make(PaymentMethods::class);
        $this->services['paymentIntents'] = $container->make(PaymentIntents::class);
        $this->services['refunds'] = $container->make(Refunds::class);
    }
    /**
     * Magic method to get services dynamically.
     *
     * @param string $name The name of the service to get.
     * @return mixed The requested service object.
     *
     * @throws Exception If the service is not found.
     */
    public function __get(string $name)
    {
        if (!isset($this->services[$name])) {
            throw new Exception("Service '{$name}' not found.");
        }

        return $this->services[$name];
    }
}
