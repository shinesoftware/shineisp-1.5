<?php 
namespace ProductAdmin\View\Helper;
use Zend\View\Helper\AbstractHelper;

class FilemanagerHelper extends AbstractHelper
{
    public function __invoke($productId, $attribute)
    {
        $files = array();
        
        if(!empty($attribute)){
            var_dump($productId);
            var_dump($attribute->getFiletarget());
        }
        
        return $this->view->render('product-admin/partial/filemanager', array('files' => $files));
    }
}