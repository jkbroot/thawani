### 0jkb/thawani
A Laravel package for integrating the Thawani payment gateway into your application, providing a simple and fluent interface for creating payment sessions, handling customers, and managing transactions.

# Features
* Easy integration with Laravel applications
* Support for creating and managing Thawani checkout sessions
* Customer management utilities
* Payment and refund handling

**Requirements**
* PHP 7.3 or higher
* Laravel 6.0 or higher

## Installation
```bash
composer require jkbroot/thawani
```
Service Provider (Optional): Laravel 5.5 and above uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider. If you're using Laravel 5.4 or below, or have disabled auto-discovery, add the service provider to the providers array in config/app.php:

```php
jkbroot\Thawani\ThawaniServiceProvider::class,
```

Facade (Optional): If you'd like to use the facade for shorter syntax, add this to your aliases array in config/app.php:

```php
'ThawaniPay', \jkbroot\Thawani\ThawaniPayFacade::class
```

**Configuration:** 

Publish the configuration file by running the following Artisan command. This will publish the Thawani configuration file to config/thawani.php, where you can customize your settings.

