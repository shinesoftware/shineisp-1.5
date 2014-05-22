<?php 
namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;

class Datetime extends AbstractHelper
{
    public function __invoke($value)
    {
        $date = new \DateTime();
        
        // Check the date in this format Y-m-d H:i:s
        $validator = new \Zend\Validator\Date(array (
                'format' => 'Y-m-d H:i:s',
                'locale' => 'it'
        ));
        
        if ($validator->isValid($value)) {
            $thedate = $date->createFromFormat('Y-m-d H:i:s', $value);
            $value = $thedate->format('d/m/Y H:i:s');
        }
        
        // Check the date in this format Y-m-d
        $validator = new \Zend\Validator\Date(array (
                'format' => 'Y-m-d',
                'locale' => 'it'
        ));
        
        if ($validator->isValid($value)) {
            $thedate = $date->createFromFormat('Y-m-d', $value);
            $value = $thedate->format('d/m/Y');
        }
        
        $pos = strpos($value, "-00");
        
        if($pos !== false){
            $thedate = $date->createFromFormat('Y-m-00', $value);
            $value = $thedate->format('m/Y');
        }
        return $value;
    }
}