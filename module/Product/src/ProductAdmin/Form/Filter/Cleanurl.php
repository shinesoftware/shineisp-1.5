<?php 
namespace ProductAdmin\Form\Filter;

use \Base\Model\UrlRewrites as UrlRewrites;

class Cleanurl implements \Zend\Filter\FilterInterface
{
	public function filter($value)
	{
		$urlRewrite = new \Base\Model\UrlRewrites();
		
		// perform some transformation upon $value to arrive on $valueFiltered
		$value = $urlRewrite->format($value);
		return $value;
	}
}

?>