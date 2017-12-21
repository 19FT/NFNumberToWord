NFNumberToWord
==============

This component provides a means to convert  numberic number (e.g. `1023`) to a string of works (e.g. `one thousand and twenty three`). It also provides a zend-view helper called *numberToWord*.


## Installation with Composer

    $ composer require "nineteenfeet/nf-number-to-word"


## Usage

```php
use NFNumberToWord\NumberToWords;

$number = 1999;

$numberToWords = new NumberToWords();
$string = $numberToWords->toWords($number);
```

