<?php
namespace ProductAdmin\Form;
use Zend\InputFilter\InputFilter;

class ProductFilter extends InputFilter
{

    public function __construct ()
    {
    	return array(
    			'name' => "webspace",
    			'required' => true,
    	);
    }
}