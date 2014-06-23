<?php
namespace Customer\Form;
use Zend\InputFilter\InputFilter;

class CustomerFilter extends InputFilter
{

    public function __construct ()
    {
    	$this->add(array (
    			'name' => 'firstname',
    			'required' => true
    	));
    	
    	$this->add(array (
    			'name' => 'legalform_id',
    			'required' => false
    	));
    	
    	$this->add(array (
    			'name' => 'type_id',
    			'required' => false
    	));
    	
    }
}