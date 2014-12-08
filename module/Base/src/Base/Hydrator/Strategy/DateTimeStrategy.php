<?php
namespace Base\Hydrator\Strategy;
use DateTime;
use Zend\Stdlib\Hydrator\Strategy\DefaultStrategy;

class DateTimeStrategy extends DefaultStrategy
{ 

    /**
     * Convert the database date field in the specific date format 
     * 
     * @see Zend\Stdlib\Hydrator\Strategy.StrategyInterface::extract()
     */
    public function extract ($value)
    {
        if(!is_string($value)){
            return $value;
        }
        
        $date = new \DateTime();

        // Check the date in this format Y-m-d H:i:s
        $validator = new \Zend\Validator\Date(array (
                'format' => 'Y-m-d H:i:s',
                'locale' => 'it'
        ));
        
        if ($validator->isValid($value)) {
            $thedate = $date->createFromFormat('Y-m-d H:i:s', $value);
            $value = $thedate->format('d/m/Y H:i');
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

    /**
     * Convert the date format from the post data array to the database format value
     * 
     * @see Zend\Stdlib\Hydrator\Strategy.StrategyInterface::hydrate()
     */
    public function hydrate ($value)
    {
        if (is_string($value) && "" === $value) {
            $value = null;
        } elseif (is_string($value)) {
            $date = new \DateTime();
            $validator = new \Zend\Validator\Date(array ( 
                    'format' => 'd/m/Y H:i:s', 
                    'locale' => 'it'
            ));
            if ($validator->isValid($value)) {
                $thedate = $date->createFromFormat('d/m/Y H:i:s', $value);
                $value = $thedate->format('Y-m-d H:i:s');
            }
            
            if(strlen($value) > 10){
                $thedate = $date->createFromFormat('d/m/Y H:i', $value);
                if($thedate){
                	$value = $thedate->format('Y-m-d H:i');
                }
            }
        }
        
        if (is_string($value)) {
            $value = new DateTime($value);
        }
        
        return $value;
    }
}