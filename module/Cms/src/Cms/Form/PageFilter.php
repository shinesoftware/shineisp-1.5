<?php
namespace Cms\Form;
use Zend\InputFilter\InputFilter;

class PageFilter extends InputFilter
{

    public function __construct ()
    {
    	$this->add(array (
    			'name' => 'title',
    			'required' => true
    	));
    	$this->add(array (
    			'name' => 'content',
    			'required' => true
    	));
    }
}