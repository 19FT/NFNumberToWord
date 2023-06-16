<?php

namespace NFNumberToWord;

class NumberToWords
{
    /**
     * @var array|string[]
     */
    protected array $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'forty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    public function toWords(mixed $number, bool $titleCase = false): string|false
    {
        $dictionary = $this->dictionary;
        if ($titleCase) {
            array_walk($dictionary, static function (&$item) {
                $item = ucfirst($item);
            });
        }

        return $this->convertNumbersToWords($number, $dictionary);
    }

    /**
     * @param String[] $dictionary
     */
    private function convertNumbersToWords(mixed $number, array $dictionary): string|false
    {
        // From: http://www.karlrixon.co.uk/writing/convert-numbers-to-words-with-php/

        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';

        if (!is_numeric($number)) {
            return false;
        }

        if ($number < 0) {
            return $negative . $this->convertNumbersToWords(abs($number), $dictionary);
        }

        $fraction = null;

        if (str_contains((string)$number, '.')) {
            [$number, $fraction] = explode('.', (string)$number);
            $fraction = (int)$fraction;
        }
        $number = (int)$number;

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = (int) floor($number / 100);
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convertNumbersToWords($remainder, $dictionary);
                }
                break;
            default:
                $baseUnit = 1000 ** floor(log($number, 1000));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->convertNumbersToWords($numBaseUnits, $dictionary) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->convertNumbersToWords($remainder, $dictionary);
                }
                break;
        }

        if (is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $n) {
                $words[] = $dictionary[$n];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
}
