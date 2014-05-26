<?php 
namespace Cms\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Blocks extends AbstractHelper implements ServiceLocatorAwareInterface {
	
	protected $serviceLocator;
	 
	/**
	 * Set the service locator.
	 *
	 * @param $serviceLocator ServiceLocatorInterface       	
	 * @return CustomHelper
	 */
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
		return $this;
	}
	/**
	 * Get the service locator.
	 *
	 * @return \Zend\ServiceManager\ServiceLocatorInterface
	 */
	public function getServiceLocator() {
		return $this->serviceLocator;
	}

    public function __invoke(\Cms\Entity\Page $page, $side)
    {
    	$strBlocks = null;
    	
    	if(is_object($page) && !empty($page)){
    		
	    	$layout = new \Cms\Model\Layout($page);
	    	
	    	$serviceLocator = $this->getServiceLocator()->getServiceLocator();
	    	$theblock = $serviceLocator->get('BlockService');
			$translator = $serviceLocator->get('translator');
			$this->getNestedBlockItems($page);
			
	    	if(!empty($side)){
		    	$blocks = $layout->getBlocks();
				foreach ($blocks as $block){
					if(!empty($block['side']) && $side == $block['side']){
						$theBlock = $theblock->findByPlaceholder($block['block']['name']);
						if(!empty($theBlock)){
							$strBlocks .= $theBlock->getContent();
						}else{
							$strBlocks .= "<div class=\"alert alert-danger\">" . sprintf($translator->translate("Block %s%s%s doesn't found!"), "<strong>",$block['block']['name'], "</strong>") . "</div>";
						}
					}
				}
	    	}
    	}
    	return $strBlocks;
    }
    
    /**
     * Get the block nested items in the body of the page
     * 
     * @param \Cms\Entity\Page $page
     * @return null
     */
    private function getNestedBlockItems(\Cms\Entity\Page $page) {
    	$serviceLocator = $this->getServiceLocator()->getServiceLocator();
    	$block = $serviceLocator->get('BlockService');
    	$translator = $serviceLocator->get('translator');
    	$value = $page->getContent();
    	if(!empty($value)){
    		$placeHolders = array();
    		if(preg_match_all('/\{([^{}}]+)\}/', $value, $matches)) {
    			$placeHolders = $matches[1];
    		}
    			
    		foreach ($placeHolders as $placeHolder){
    			$theBlock = $block->findByPlaceholder($placeHolder);
    			if(!empty($theBlock)){
    				$value = str_replace("{" . $placeHolder . "}", $theBlock->getContent(), $value);
    			}else{
					$notfound = "<div class=\"alert alert-danger\">" . sprintf($translator->translate("Block %s%s%s doesn't found!"), "<strong>",$placeHolder, "</strong>") . "</div>";
					$value = str_replace("{" . $placeHolder . "}", $notfound, $value);
				}
    		}
    		$page->setContent($value);
    		
    		return true;
    	}
    	
    	return false;
    }
}