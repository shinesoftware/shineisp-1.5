<?php
namespace Base\Form;
use Zend\InputFilter\InputFilter;

class LanguagesFilter extends InputFilter
{

    public function __construct ()
    {
    	$this->add(array (
    			'name' => 'language',
    			'required' => true
    	));
    	$this->add(array (
    			'name' => 'locale',
    			'required' => true
    	));
    	$this->add(array (
    			'name' => 'code',
    			'required' => true
    	));
    }
}