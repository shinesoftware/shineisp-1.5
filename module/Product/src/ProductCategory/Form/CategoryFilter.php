<?php
namespace ProductCategory\Form;
use Zend\InputFilter\InputFilter;

class CategoryFilter extends InputFilter
{

    public function __construct ()
    {
    	$this->add(array (
    			'name' => 'name',
    			'required' => true,
    			'filters' => array(
    					array('name' => 'StringTrim'),
    			)
    	));

        $this->add(array (
            'name' => 'slug',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
            )
        ));

        $this->add(array (
            'name' => 'enabled',
            'required' => false,
        ));

        $this->add(array (
            'name' => 'slug',
            'required' => false,
        ));

        $this->add(array (
            'name' => 'parent_id',
            'required' => false,
        ));

    }
}