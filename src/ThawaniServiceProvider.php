<?php

namespace Jkbroot\Thawani;

use Illuminate\Support\ServiceProvider;
use Jkbroot\Thawani\Services\CheckoutSessionsService;
use Jkbroot\Thawani\Services\CustomersService;
use Jkbroot\Thawani\Services\PaymentIntentsService;
use Jkbroot\Thawani\Services\PaymentMethodsService;
use Jkbroot\Thawani\Services\ThawaniService;
use Jkbroot\Thawani\Services\RefundsService;

class ThawaniServiceProvider extends ServiceProvider {

    public function boot()
    {
//        // Register facade alias
//        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
//        $loader->alias('ThawaniPay', \Jkbcoder\Thawani\ThawaniPayFacade::class);

        // Publish configuration file
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
//        $this->app->singleton('thawani', function ($app) {
//            return new ThawaniPay();
//        });

        // Bind ThawaniPay with all dependencies into the service container

        $this->app->singleton(ThawaniPay::class, function ($app) {
            return new ThawaniPay();
        });

        // Bind ThawaniService into the service container
        $this->app->singleton(ThawaniService::class, function ($app) {
            return new ThawaniService();
        });

        // Bind CheckoutSessionsService into the service container
        $this->app->singleton(CheckoutSessionsService::class, function ($app) {
            return new CheckoutSessionsService($app->make(ThawaniService::class));
        });

        // Bind CustomersService into the service container
        $this->app->singleton(CustomersService::class, function ($app) {
            return new CustomersService($app->make(ThawaniService::class));
        });

        // Bind PaymentMethodsService into the service container
        $this->app->singleton(PaymentMethodsService::class, function ($app) {
            return new PaymentMethodsService($app->make(ThawaniService::class));
        });

        // Bind PaymentIntentsService into the service container
        $this->app->singleton(PaymentIntentsService::class, function ($app) {
            return new PaymentIntentsService($app->make(ThawaniService::class));
        });

        // Bind RefundsService into the service container
        $this->app->singleton(RefundsService::class, function ($app) {
            return new RefundsService($app->make(ThawaniService::class));
        });
    }
}
