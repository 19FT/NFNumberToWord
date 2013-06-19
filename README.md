NFNumberToWord
==============

This ZF2 module provides a view helper called *numberToWord* which will
format a numberic number (e.g. 1023) as a word (e.g. one thousand and twenty three).


##Installation with Composer

1. Add `"nineteenfeet/nf-number-to-word": "1.*"` to your `composer.json` file and run `php composer.phar update`.
2. Add `'NFNumberToWord'` to your list of modules in `application.config.php`.


## Usage

In your view script:

    <?php echo $this->numberToWord(1234, $titleCase = true); ?>
