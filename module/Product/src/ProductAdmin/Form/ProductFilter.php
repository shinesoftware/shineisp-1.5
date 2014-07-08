<?php
namespace ProductAdmin\Form;
use Zend\InputFilter\InputFilter;

class ProductFilter extends InputFilter
{

    public function __construct ()
    {
    	$this->add(array (
    			'name' => 'sku',
    			'required' => true,
    			'filters' => array(
    					array('name' => 'Null'),
    					array('name' => 'StringTrim'),
    			)
    	));
    	
    	$this->add(array (
    			'name' => 'type_id',
    			'required' => true,
    	));
    	
    	$this->add(array (
    			'name' => 'group_id',
    			'required' => true,
    	));
    	
    }
}