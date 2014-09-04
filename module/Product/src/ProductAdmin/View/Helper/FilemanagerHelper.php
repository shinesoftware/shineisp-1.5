<?php 
namespace ProductAdmin\View\Helper;
use Zend\View\Helper\AbstractHelper;

class FilemanagerHelper extends AbstractHelper
{
    public function __invoke($product, $attribute)
    {
        $files = array();
        
        if(!empty($attribute)){

        	// get all the attribute values of the product selected
        	$attributes = $product->getAttributes();
        	
        	// get the target directory where the files have been saved
        	$path = $attribute->getFiletarget();
        	
        	// get the name of the file attribute
        	$fileAttr = $attribute->getName();
        	
        	if(!empty($attributes[$fileAttr])){
        		$files = json_decode($attributes[$fileAttr], true);
        	}
        }
        
        return $this->view->render('product-admin/partial/filemanager', array('product' => $product, 'attribute' => $attribute, 'files' => $files, 'path' => $path));
    }
}