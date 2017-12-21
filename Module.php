<?php
namespace NFNumberToWord;

use Zend\View\Helper\AbstractHelper;
use Exception;

class Module extends AbstractHelper
{
    public function getViewHelperConfig()
    {
        return array('services' => array('numberToWord' => $this));
    }

    public function __invoke($number, $titleCase = false)
    {
        $numberToWords = new NumberToWords();
        return $numberToWords->toWords($number, $titleCase);
    }
}
