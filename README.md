![alt tag](https://thawani.om/wp-content/uploads/2022/12/Logo-Thawani.png)

# jkbroot/thawani
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

[//]: # (_**Facade &#40;Optional&#41;:**_)

[//]: # ()
[//]: # (If you'd like to use the facade for shorter syntax, add this to your aliases array in config/app.php:)

[//]: # ()
[//]: # (```php)

[//]: # ('ThawaniPay', \jkbroot\Thawani\ThawaniPayFacade::class)

[//]: # (```)

**Configuration:** 

Publish the configuration file by running the following Artisan command. This will publish the Thawani configuration file to config/thawani.php, where you can customize your settings.

```bash
php artisan vendor:publish --tag=config
```
_Copy the Thawani Pay configuration snippet you provided and paste it into your .env file. However,The THAWANI_MODE should be set to live instead of test for a production environment :_
```
#Thawani Pay Configuration for Production Environment
THAWANI_LIVE_SECRET_KEY=your_thawani_live_secret_key
THAWANI_LIVE_PUBLISHABLE_KEY=your_thawani_live_publishable_key
#Thawani mode change to (live) for production.
THAWANI_MODE=test
```
Replace your_thawani_live_secret_key and your_thawani_live_publishable_key with your actual Thawani live secret and publishable keys.

## Instantiating ThawaniPay Class

To begin using the Thawani payment functionality, you need to instantiate the `ThawaniPay` class. Follow these steps:

### Step 1: Import ThawaniPay Class

Before you can create an instance of the `ThawaniPay` class, ensure that you import it into your PHP file using the `use` statement:

```php
use Jkbroot\Thawani\ThawaniPay;
```

### Step 2: Instantiate ThawaniPay Class
Once the class is imported, you can instantiate it using the following code:
```php
$thawani = new ThawaniPay();
```
This creates an instance of the ThawaniPay class, allowing you to utilize its methods and properties for handling Thawani payments within your Laravel application.

**Additional Notes**
* Ensure that you have installed the jkbroot/thawani package via Composer before attempting to use it.
* Review the package documentation for any specific configurations, requirements, or additional functionality provided by the package.


# How to use :
## 1 - checkout & session

- Create session :
```php
$thawani = new ThawaniPay();


$data = [
    "client_reference_id" => "123412",
    "mode" => "payment",
    "products" => [
        [
            "name" => "product 1",
            "quantity" => 1,
            "unit_amount" => 100,
        ],
    ],
    "success_url" => "https://company.com/success",
    "cancel_url" => "https://company.com/cancel",
    "metadata" => [
        "Customer name" => "somename",
        "order id" => 0,
    ],
];

$session = $thawani->checkoutSessions->create($data);

```
Create session Response : 

```php
[
    "success" => true
    "code" => 2004
    "description" => "Session generated successfully"
    "data" => array:16 [
        "mode" => "payment"
        "session_id" => "checkout_0Cp4idrQaNFMws8YFJH020FJA3I4ITwkvmk2RxUc9Les5kY3ym"
        "client_reference_id" => "123412"
        "customer_id" => null
        "products" => [
          0 => [
            "name" => "product 1"
            "unit_amount" => 100
            "quantity" => 1
          ]
        ]
        "total_amount" => 100
        "currency" => "OMR"
        "success_url" => "https://company.com/success"
        "cancel_url" => "https://company.com/cancel"
        "return_url" => null
        "payment_status" => "unpaid"
        "invoice" => "20240228270008"
        "save_card_on_success" => false
        "metadata" => [
          "Customer name" => "somename"
          "order id" => "0"
        ]
        "created_at" => "2024-02-28T15:19:35.2937785Z"
        "expire_at" => "2024-02-29T15:19:35.2204113Z"
    ]
]
```


- Retrieve session :
```php
$session_id = "checkout_0Cp4idrQaNFMws8YFJH020FJA3I4ITwkvmk2RxUc9Les5kY3ym";
$session = $thawani->checkoutSessions->retrieve($session_id);
```
Retrieve session Response : 
```php
[
  "success" => true
  "code" => 2000
  "description" => "session retrieved successfully"
  "data" =>  [
    "mode" => "payment"
    "session_id" => "checkout_0Cp4idrQaNFMws8YFJH020FJA3I4ITwkvmk2RxUc9Les5kY3ym"
    "client_reference_id" => "123412"
    "customer_id" => null
    "products" => [
      0 => [
        "name" => "product 1"
        "unit_amount" => 100
        "quantity" => 1
      ]
    ]
    "total_amount" => 100
    "currency" => "OMR"
    "success_url" => "https://company.com/success"
    "cancel_url" => "https://company.com/cancel"
    "return_url" => null
    "payment_status" => "unpaid"
    "invoice" => "20240228270008"
    "save_card_on_success" => false
    "metadata" =>[
      "Customer name" => "somename"
      "order id" => "0"
    ]
    "created_at" => "2024-02-28T15:19:35.2937785"
    "expire_at" => "2024-02-29T15:19:35.2204113"
  ]
]
```

- Cancel session :

```php
$session_id = "checkout_0Cp4idrQaNFMws8YFJH020FJA3I4ITwkvmk2RxUc9Les5kY3ym";
$session = $thawani->checkoutSessions->cancel($session_id);
```
Cancel session Response : 
```php
[
  "success" => true
  "code" => 2105
  "description" => "Checkout session cancelled successfully"
]
```
- Get all Sessions :

```php
$sessions = $thawani->checkoutSessions->getAll();
```

Get all Sessions Response : 
```php
[
  "success" => true
  "code" => 2000
  "description" => "sessions retrieved successfully"
  "data" => [/*'array off Sessions'*/]
]
```

- create Checkout Url :

```php
$data = [
    "client_reference_id" => "123412",
    "mode" => "payment",
    "products" => [
        [
            "name" => "product 1",
            "quantity" => 1,
            "unit_amount" => 100,
        ],
    ],
    "success_url" => "https://company.com/success",
    "cancel_url" => "https://company.com/cancel",
    "metadata" => [
        "Customer name" => "somename",
        "order id" => 0,
    ],
];

$checkoutUrl = $thawani->checkoutSessions->createCheckoutUrl($data);

```
- create Checkout Url Response:

```php
[
  "session_id" => "checkout_5Q3IPYhiWaOIDotTqHJMjtaklHoHeWTjT6iTPaT0kQSTSZF3Za"
  "redirect_url" => "https://uatcheckout.thawani.om/pay/checkout_5Q3IPYhiWaOIDotTqHJMjtaklHoHeWTjT6iTPaT0kQSTSZF3Za?key=HGvTMLDssJghr9tlN9gr4DVYt0qyBy"
]
```
- session_id: A unique identifier for the created checkout session.
- redirect_url: The URL to which you should redirect your customers to complete the payment process. This URL leads to Thawani's payment gateway, where the customer can enter their payment details securely.



