<?php

namespace Danielebarbaro\LaravelCreditCardValidator\Facades;

use Danielebarbaro\LaravelCreditCardValidator\CreditCardValidator;
use Illuminate\Support\Facades\Facade;

class CreditCardValidatorFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return CreditCardValidator::class;
    }
}
