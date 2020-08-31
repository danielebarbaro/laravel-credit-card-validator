<?php

namespace Danielebarbaro\LaravelVatEuValidator\Tests\Rules;

use Danielebarbaro\LaravelCreditCardValidator\Rules\CreditCardNumber;
use Orchestra\Testbench\TestCase;

class CreditNumberTest extends TestCase
{
    protected $rule;

    protected $fake_card;

    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new CreditCardNumber();
        $this->fake_card = '4579880200630196';
    }

    public function testCreditCardNumber()
    {
        self::assertFalse($this->rule->passes('credit_card_number', $this->fake_card));
    }

    public function testCreditCardNumberMessage()
    {
        self::assertStringContainsString('The :attribute must be a valid Credit Card number.', $this->rule->message());
    }
}
