<?php

namespace Danielebarbaro\LaravelCreditCardValidator;

use Danielebarbaro\LaravelCreditCardValidator\Rules\CreditCardNumber;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Container\Container;

class CreditCardValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /**
         * Register the "credit_card_number" validation rule.
         */
        Validator::extend('credit_card_number', function ($attribute, $value, $parameters, $validator) {
            $rule = new CreditCardNumber();
            return $rule->passes($attribute, $value);
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(CreditCardValidator::class, function (Container $app) {
            return new CreditCardValidator();
        });;
    }
}
