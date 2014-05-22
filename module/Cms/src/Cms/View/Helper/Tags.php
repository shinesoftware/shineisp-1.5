<?php 
namespace Cms\View\Helper;
use Zend\View\Helper\AbstractHelper;

class Tags extends AbstractHelper
{
    public function __invoke($value)
    {
    	if(!empty($value)){
	    	$tags = explode(",", $value);
	    	
	    	return $this->view->render('cms/partial/tags', array('tags' => $tags));
    	}
    }
}