<?php

namespace Danielebarbaro\LaravelCreditCardValidator\Rules;

use Danielebarbaro\LaravelCreditCardValidator\Facades\CreditCardValidatorFacade as CreditCardValidator;

use Illuminate\Contracts\Validation\Rule;

class CreditCardNumber implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return CreditCardValidator::validate($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('The :attribute must be a valid Credit Card number.');
    }
}
