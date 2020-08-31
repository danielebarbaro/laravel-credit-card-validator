<?php

namespace Danielebarbaro\LaravelCreditCardValidator;

class CreditCardValidator
{
    /**
     * Regular expression patterns for credit card name
     *
     * @var array
     * @link https://gist.github.com/michaelkeevildown/9096cd3aac9029c4e6e05588448a8841
     */
    protected static $pattern_expression = [
        'AMEX' => '^3[47]\d{13}',
        'BCGLOBAL' => '^(6541|6556)\d{12}',
        'CARTE_BLANCHE' => '^389\d{11}',
        'DINERS_CLUB' => '^3(?:0[0-5]|[68][0-9])\d{11}',
        'DISCOVER' => '^65[4-9]\d{13}|64[4-9]\d{13}|6011\d{12}|(622(?:12[6-9]|1[3-9][0-9]|[2-8][0-9][0-9]|9[01][0-9]|92[0-5])\d{10})',
        'INSTA_PAYMENT' => '^63[7-9]\d{13}',
        'JCB' => '^(?:2131|1800|35\d{3})\d{11}',
        'KOREANLOCA' => '^9\d{15}',
        'LASER' => '^(6304|6706|6709|6771)\d{12,15}',
        'MAESTRO' => '^(5018|5020|5038|6304|6759|6761|6763)\d{8,15}',
        'MASTERCARD' => '^5[1-5]\d{14}',
        'SOLO' => '^(6334|6767)\d{12}|(6334|6767)\d{14}|(6334|6767)\d{15}',
        'SWITCH' => '^(4903|4905|4911|4936|6333|6759)\d{12}|(4903|4905|4911|4936|6333|6759)\d{14}|(4903|4905|4911|4936|6333|6759)\d{15}|564182\d{10}|564182\d{12}|564182\d{13}|633110\d{10}|633110\d{12}|633110\d{13}',
        'UNION_PAY' => '^(62\d{14,17})',
        'VISA' => '^4\d{12}(?:\d{3})?',
        'VISA_MASTER' => '^(?:4\d{12}(?:\d{3})?|5[1-5]\d{14})',
        'VISA_ELECTRON' => '^((4026|4405|4508|4844|4913|4917)\d{12}|^(417500)\d{10})',
    ];

    /**
     * Validate Credit Card Number
     *
     * @param  string  $number
     * @param  string|null  $type
     * @return bool
     */
    public function validate(string $number, string $type = ''): bool
    {
        $type = $this->transformType($type);

        if ($type === null) {
            $type = $this->creditCardType($number);
        }

        $card = $this->validateRegEx($number, $type);

        if ($card) {
            $result = $this->luhnCheck($card);
            return $result % 10 == 0 ? true : false;
        }

        return false;
    }

    /**
     * Use preg match pattern expression
     *
     * @param  string  $type
     * @param  int  $number
     * @return bool
     */
    private function validateRegEx(int $number, string $type): bool
    {
        return array_key_exists($type, self::$pattern_expression)
            ? preg_match('/'.self::$pattern_expression[$type].'$/', $number) > 0
            : false;
    }

    /**
     * Clean Credit Card Type string
     *
     * @param  string  $type
     * @return string
     */
    private function transformType(string $type): string
    {
        $upper_string = strtoupper($type);
        $trimmed_type = trim($upper_string);

        return str_replace(' ', '_', $trimmed_type);
    }

    /**
     * A php implementation of Luhn Algo
     *
     * @link https://en.wikipedia.org/wiki/Luhn_algorithm
     * @param  string  $vat
     * @return int
     */
    public function luhnCheck(string $vat): int
    {
        $sum = 0;
        $vat_array = str_split($vat);
        for ($index = 0; $index < count($vat_array); $index++) {
            $value = intval($vat_array[$index]);
            if ($index % 2) {
                $value = $value * 2;
                if ($value > 9) {
                    $value = 1 + ($value % 10);
                }
            }
            $sum += $value;
        }
        return $sum;
    }

    /**
     * Return Type by credit card number
     *
     * @param $number
     * @return string
     */
    public function creditCardType($number): string
    {
        foreach (self::$pattern_expression as $type => $regular_expression) {
            if ($this->validateRegEx($number, $type)) {
                return $type;
            }
        }

        return null;
    }
}
