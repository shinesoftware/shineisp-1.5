<?php
namespace Cms\Form;
use Zend\InputFilter\InputFilter;

class PageCategoryFilter extends InputFilter
{

    public function __construct ()
    {
    	$this->add(array (
    			'name' => 'category',
    			'required' => true
    	));
    }
}