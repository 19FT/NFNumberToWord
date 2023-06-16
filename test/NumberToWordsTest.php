<?php

namespace NFNumberToWord\Test;

use NFNumberToWord\NumberToWords;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class NumberToWordsTest extends TestCase
{
    public static function toWordsProvider(): array
    {
        return [
            // number, titleCase, expected
            [0, false, 'zero'],
            [1, false, 'one'],
            [2, false, 'two'],
            [3, false, 'three'],
            [4, false, 'four'],
            [5, false, 'five'],
            [6, false, 'six'],
            [7, false, 'seven'],
            [8, false, 'eight'],
            [9, false, 'nine'],
            [10, false, 'ten'],
            [11, false, 'eleven'],
            [12, false, 'twelve'],
            [13, false, 'thirteen'],
            [14, false, 'fourteen'],
            [15, false, 'fifteen'],
            [16, false, 'sixteen'],
            [17, false, 'seventeen'],
            [18, false, 'eighteen'],
            [19, false, 'nineteen'],
            [20, false, 'twenty'],
            [30, false, 'thirty'],
            [40, false, 'forty'],
            [50, false, 'fifty'],
            [60, false, 'sixty'],
            [70, false, 'seventy'],
            [80, false, 'eighty'],
            [90, false, 'ninety'],
            [100, false, 'one hundred'],
            [2000, false, 'two thousand'],
            [3000000, false, 'three million'],
            [4000000000, false, 'four billion'],
            [5000000000000, false, 'five trillion'],
            [6000000000000000, false, 'six quadrillion'],
            [7000000000000000000, false, 'seven quintillion'],

            ['-43', true, 'negative Forty-Three'],
            [43, false, 'forty-three'],
            [43, true, 'Forty-Three'],
            [43.56, false, 'forty-three point five six'],
            [43.56, true, 'Forty-Three point Five Six'],
            [345, false, 'three hundred and forty-five'],
            [345, true, 'Three Hundred and Forty-Five'],
            [4567, false, 'four thousand, five hundred and sixty-seven'],
            [987654321, false, 'nine hundred and eighty-seven million, six hundred and fifty-four thousand,'
                . ' three hundred and twenty-one'],

            ['abc', true, false],
        ];
    }

    #[DataProvider('toWordsProvider')]
    public function testToWords(mixed $number, bool $titleCase, string|false $expected): void
    {
        $numberToWords = new NumberToWords();
        $result = $numberToWords->toWords($number, $titleCase);

        static::assertSame($expected, $result);
    }
}
