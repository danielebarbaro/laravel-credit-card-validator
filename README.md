# Laravel Credit Card validator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/danielebarbaro/laravel-credit-card-validator.svg?style=flat-square)](https://packagist.org/packages/danielebarbaro/laravel-credit-card-validator)
[![Build Status](https://img.shields.io/travis/danielebarbaro/laravel-credit-card-validator/master.svg?style=flat-square)](https://travis-ci.org/danielebarbaro/laravel-credit-card-validator)
[![Total Downloads](https://img.shields.io/packagist/dt/danielebarbaro/laravel-credit-card-validator.svg?style=flat-square)](https://packagist.org/packages/danielebarbaro/laravel-credit-card-validator)

laravel-credit-card-validator is a package to validate credit card number usign [Luhn Algo](https://en.wikipedia.org/wiki/Luhn_algorithm) .

## Installation

You can install the package via composer:

```bash
composer require danielebarbaro/laravel-credit-card-validator
```

The package will automatically register itself.

## Usage

``` php
use Danielebarbaro\LaravelCreditCardValidator\Facades\CreditCardValidatorFacade as CreditCardValidator;

// Check Credit Card 
CreditCardValidator::validate('4579880200630196');
```

#### Validation

The package registers a new validation rule.

**credit_card_number**

```php
use Illuminate\Http\Request;

class Controller {

    public function foo(Request $request) 
    {
        $request->validate([
            'field' => ['credit_card_number'],
        ]);
    }
}
```

Alternatively, you can also use the `Rule` directly.

```php
use Illuminate\Http\Request;
use Danielebarbaro\LaravelCreditCardValidator\Rules;

class Controller {

    public function foo(Request $request) 
    {
        $request->validate([
            'field' => [ new Rules\CreditCardNumber() ],
        ]);
    }
}
```

### Translations
Just add and customize validation strings in `resources/lang/en/validation.php`
```
    ...
    'credit_card_number' => 'The :attribute must be a valid Credit Card number',
    ...
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email barbaro.daniele@gmail.com instead of using the issue tracker.

## Credits

- [Daniele Barbaro](https://github.com/danielebarbaro)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
