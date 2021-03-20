# Laravel BigCommerce

[![Latest Version on Packagist](https://img.shields.io/packagist/v/palpalani/laravel-bigcommerce.svg?style=flat-square)](https://packagist.org/packages/palpalani/laravel-bigcommerce)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/palpalani/laravel-bigcommerce/run-tests?label=tests)](https://github.com/palpalani/laravel-bigcommerce/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/palpalani/laravel-bigcommerce/Check%20&%20fix%20styling?label=code%20style)](https://github.com/palpalani/laravel-bigcommerce/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/palpalani/laravel-bigcommerce.svg?style=flat-square)](https://packagist.org/packages/palpalani/laravel-bigcommerce)

Laravel BigCommerce is a simple package which helps to build robust integration into bigcommerce.
This package support the Version 2 and 3 of the Bigcommerce Api.

## Installation

You can install the package via composer:

```bash
composer require oseintow/laravel-bigcommerce
```

## Configuration

Laravel Bigcommerce requires connection configuration. You will need to publish vendor assets

    php artisan vendor:publish

This will create a bigcommerce.php file in the config directory. You will need to set your **auth** keys

#### OAUTH

Set **CLIENT ID** , **CLIENT SECRET** AND **REDIRECT URL**

#### BasicAuth

Set **API_KEY** , **USERNAME** AND **STORE URL**

Let's retrieve access token

```php
Route::get("process_oauth_result",function(\Illuminate\Http\Request $request)
{
    $response = Bigcommerce::getAccessToken($request->code, $request->scope, $request->context);

    dd($response);
});
```

## Usage

There are 2 ways to access resource from bigcommerce using this package.

1. Using the http verbs(ie. this gives you more flexibility and also support api v3 and also returns laravel collection)
2. Using Bigcommerce Collection (this does not support api v3 and laravel collection).

By default, the package support **API v3**

To set it to version 2 or 3 use

```php
Bigcommerce::setApiVersion('v2');
```

or

```php
Bigcommerce::setApiVersion('v3');
```

## Using Http verbs

```php
Bigcommerce::get("resource uri",["query string params"]);
Bigcommerce::post("resource uri",["post body"]);
Bigcommerce::put("resource uri",["put body"]);
Bigcommerce::delete("resource uri");
```

Let use our access token to get products from bigcommerce.

**NB:** You can use this to access any resource on bigcommerce (be it Products, Shops, Orders, etc).
And also you don't need to store hash and access token when using basic auth.

```php
$storeHash = "ecswer";
$accessToken = "xxxxxxxxxxxxxxxxxxxxx";
$products = Bigcommerce::setStoreHash($storeHash)
    ->setAccessToken($accessToken)
    ->get("products");
```

To pass query params

```php
// returns Collection
$bigcommerce = Bigcommerce::setStoreHash($storeHash)
    ->setAccessToken($accessToken);
$products = $bigcommerce->get("admin/products.json", [
        "limit"=>20,
        "page" => 1
    ]);
```

## Controller Example

If you prefer to use dependency injection over facades like me, then you can inject the Class:

```php
use Illuminate\Http\Request;
use Oseintow\Bigcommerce\Bigcommerce;

class Foo
{
    protected $bigcommerce;

    public function __construct(Bigcommerce $bigcommerce)
    {
        $this->bigcommerce = $bigcommerce;
    }

    /*
    * returns Collection
    */
    public function getProducts(Request $request)
    {
        $products = $this->bigcommerce->setStoreHash($storeHash)
            ->setAccessToken($accessToken)
            ->get('products');

        $products->each(function($product){
             \Log::info($product->title);
        });
    }
}
```

## Miscellaneous

To get Response headers

```php
Bigcommerce::getHeaders();
```

To get specific header
```php
Bigcommerce::getHeader("Content-Type");
```

To get response status code or status message
```php
Bigcommerce::getStatus(); // 200
```

## Using Bigcommerce Collection

#### Testing Configuration

Use code below To test if configuration is correct. Returns false if unsuccessful otherwise return DateTime Object.

```php
$time = Bigcommerce::getTime();
```

### Accessing Resources
```php
//  oauth
$storeHash = "afw2w";
$accessToken = "xxxxxxxxxxxxxxxxxxxxx";
$products = Bigcommerce::setStoreHash($storeHash)
    ->setAccessToken($accessToken)
    ->getProducts();

//Basic Auth
$products = Bigcommerce::getProducts();
```


## Paging and Filtering

All the default collection methods support paging, by passing the page number to the method as an integer:

$products = Bigcommerce::getProducts(3);

If you require more specific numbering and paging, you can explicitly specify a limit parameter:

```php
$filter = array("page" => 3, "limit" => 30);

$products = Bigcommerce::getProducts($filter);
```

To filter a collection, you can also pass parameters to filter by as key-value pairs:

```php
$filter = array("is_featured" => true);

$featured = Bigcommerce::getProducts($filter);
```

See the API documentation for each resource for a list of supported filter parameters.

Updating existing resources (PUT)

To update a single resource:

```php
$product = Bigcommerce::getProduct(11);

$product->name = "MacBook Air";
$product->price = 99.95;
$product->update();
```

For more info on the Bigcommerce Collection check [this](https://packagist.org/packages/bigcommerce/api)

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [palPalani](https://github.com/palpalani)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

















