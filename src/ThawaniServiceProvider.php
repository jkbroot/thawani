<?php

namespace Jkbroot\Thawani;

use Illuminate\Support\ServiceProvider;
use Jkbroot\Thawani\Api\CheckoutSessions;
use Jkbroot\Thawani\Api\Customers;
use Jkbroot\Thawani\Api\PaymentIntents;
use Jkbroot\Thawani\Api\PaymentMethods;
use Jkbroot\Thawani\Api\Refunds;
use Jkbroot\Thawani\Services\ThawaniService;

class ThawaniServiceProvider extends ServiceProvider {

    public function boot()
    {

        // Publish configuration file
        $this->publishes([
            __DIR__ . '/../config/thawani.php' => config_path('thawani.php'),
        ], 'config');

        // Merge config
        $this->mergeConfigFrom(
            __DIR__ . '/../config/thawani.php', 'thawani'
        );
    }


    public function register()
    {


        // Bind ThawaniPay with all dependencies into the service container

        $this->app->singleton(ThawaniPay::class, function ($app) {
            return new ThawaniPay();
        });

        // Bind ThawaniService into the service container
        $this->app->singleton(ThawaniService::class, function ($app) {
            return new ThawaniService();
        });

        // Bind CheckoutSessionsService into the service container
        $this->app->singleton(CheckoutSessions::class, function ($app) {
            return new CheckoutSessions($app->make(ThawaniService::class));
        });

        // Bind CustomersService into the service container
        $this->app->singleton(Customers::class, function ($app) {
            return new Customers($app->make(ThawaniService::class));
        });

        // Bind PaymentMethodsService into the service container
        $this->app->singleton(PaymentMethods::class, function ($app) {
            return new PaymentMethods($app->make(ThawaniService::class));
        });

        // Bind PaymentIntentsService into the service container
        $this->app->singleton(PaymentIntents::class, function ($app) {
            return new PaymentIntents($app->make(ThawaniService::class));
        });

        // Bind RefundsService into the service container
        $this->app->singleton(Refunds::class, function ($app) {
            return new Refunds($app->make(ThawaniService::class));
        });
    }
}
