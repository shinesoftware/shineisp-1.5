<?php
namespace ProductAdmin\Form;
use Zend\InputFilter\InputFilter;

class AttributesFilter extends InputFilter
{

    public function __construct ()
    {
    	$this->add(array (
    			'name' => 'code',
    			'required' => true,
    			'filters' => array(
    					array('name' => 'StringTrim'),
    			)
    	));
    	$this->add(array (
    			'name' => 'source_model',
    			'required' => false,
    			'filters' => array(
    					array('name' => 'StringTrim'),
    					array('name' => 'Null'),
    			)
    	));
    	
    }
}