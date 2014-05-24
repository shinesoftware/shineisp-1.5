<?php
namespace Cms\Form;
use Zend\InputFilter\InputFilter;

class BlockFilter extends InputFilter
{

    public function __construct ()
    {
    	$this->add(array (
    			'name' => 'title',
    			'required' => true
    	));
    	$this->add(array (
    			'name' => 'language_id',
    			'required' => true
    	));
    	$this->add(array (
    			'name' => 'content',
    			'required' => true
    	));
    }
}