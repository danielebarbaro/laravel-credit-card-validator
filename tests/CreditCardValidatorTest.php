<?php

namespace Danielebarbaro\LaravelCreditCardValidator\Tests;

use Danielebarbaro\LaravelCreditCardValidator\CreditCardValidator;
use Orchestra\Testbench\TestCase;

class CreditCardValidatorTest extends TestCase
{
    protected $validator;

    protected $fake_cards;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = new CreditCardValidator();
        $this->fake_cards = [
            'AMEX' => '373287477444774',
            'BCGLOBAL' => '6556255124050535',
            'CARTE_BLANCHE' => '38903578751393',
            'DINERS_CLUB' => '36521330404477',
            'DISCOVER' => '6011956406814193',
            'INSTA_PAYMENT' => '6381376530509240',
            'JCB' => '213183778104827',
            'KOREANLOCA' => '9836582266772928',
            'LASER' => '6709161259384008',
            'MAESTRO' => '50380944871562405',
            'MASTERCARD' => '5181052779845488',
            'SOLO' => '6767569415445858',
            'SWITCH' => '4903000461314112801',
            'UNION_PAY' => '6284228043820409320',
            'VISA' => '4579880200630196',
            'VISA_MASTER' => '5231861275420796',
            'VISA_ELECTRON' => '4175001714779964',
        ];
    }

    public function testValidCreditCart(): void
    {
        foreach ($this->fake_cards as $type => $number) {
            self::assertFalse($this->validator->validate($number, $type));
        }
    }

    public function testLuhnCheck(): void
    {
        self::assertIsInt($this->validator->luhnCheck($this->fake_cards['VISA']));
        self::assertNotEquals($this->validator->luhnCheck($this->fake_cards['VISA']), 0);
    }

    public function testCreditCardType(): void
    {
        self::assertEquals($this->validator->creditCardType($this->fake_cards['AMEX']), 'AMEX');
    }


}
