<?php 
namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;

class CleanTags extends AbstractHelper
{
    public function __invoke($content)
    {
        
        preg_match_all("/\[([^\]]*)\]/", $content, $matches);
         
        if(!empty($matches[0])){
            foreach ($matches[0] as $item){
                $content = str_replace($item, "", $content);
            }
        }
        
        return $content;
    }
    
}