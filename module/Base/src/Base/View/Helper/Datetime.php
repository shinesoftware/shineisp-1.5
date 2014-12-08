<?php 
namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;

class Datetime extends AbstractHelper
{
    public function __invoke($value, $format = 'Y-m-d H:i:s')
    {
        $date = new \DateTime($value);
        return $date->format($format);
    }
}