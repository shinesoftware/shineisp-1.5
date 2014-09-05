<?php 
namespace ProductAdmin\Form\Filter;

class Cleanurl implements \Zend\Filter\FilterInterface
{
	public function filter($value)
	{
		// perform some transformation upon $value to arrive on $valueFiltered
		$value .= " - test";
		return $value;
	}
}

?>