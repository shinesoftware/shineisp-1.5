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
    		
	    	$serviceLocator = $this->getServiceLocator()->getServiceLocator();
	    	$theblock = $serviceLocator->get('BlockService');
	    	$settings = $serviceLocator->get('SettingsService');
	    	
	    	$layout = new \Cms\Model\Layout($page, $settings);
	    	
			$translator = $serviceLocator->get('translator');
			$locale = $translator->getLocale();
			$fallback = $translator->getFallbackLocale();
				
			$this->getNestedBlockItems($page);
			
	    	if(!empty($side)){
		    	$blocks = $layout->getBlocks();
				foreach ($blocks as $block){
					if(!empty($block['side']) && $side == $block['side']){

					    // check and get the locale version if it is not exists a fallback version will be print
						$theBlock = $theblock->findByPlaceholder($block['block']['name'], $locale);
						if(!empty($theBlock)){
							$strBlocks .= $theBlock->getContent();
						}else{
						    $theBlock = $theblock->findByPlaceholder($block['block']['name'], $fallback);
						    if(!empty($theBlock)){
						        $strBlocks .= $theBlock->getContent();
						    }else{
							    $strBlocks .= "<div class=\"alert alert-danger\">" . sprintf($translator->translate("Block %s%s%s doesn't found!"), "<strong>",$block['block']['name'], "</strong>") . "</div>";
						    }
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