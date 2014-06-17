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
    	
    }
}