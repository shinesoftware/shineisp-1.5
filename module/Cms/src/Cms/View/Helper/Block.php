<?php 
namespace Cms\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Block extends AbstractHelper implements ServiceLocatorAwareInterface {
	
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

    public function __invoke($block, $showAlertbox=true)
    {
    	$strBlock = null;
    	
    	if(!empty($block)){
    	    
	    	$serviceLocator = $this->getServiceLocator()->getServiceLocator();
	    	$theblock = $serviceLocator->get('BlockService');
	    	$settings = $serviceLocator->get('SettingsService');
			$translator = $serviceLocator->get('translator');
			$locale = $translator->getLocale();
			$fallback = $translator->getFallbackLocale();

			// check and get the locale version if it is not exists a fallback version will be print
			$theBlock = $theblock->findByPlaceholder($block, $locale);
			if(!empty($theBlock)){
				$strBlock  = $theBlock->getContent();
			}else{
			    // Check if the fallback locale version is present
			    $theBlock = $theblock->findByPlaceholder($block, $fallback);
			    if(!empty($theBlock)){
			        $strBlock  = $theBlock->getContent();
			    }else{
    			    if($showAlertbox){
    				    $strBlock = "<div class=\"alert alert-danger\">" . sprintf($translator->translate("Block %s%s%s doesn't found!"), "<strong>", $block, " ($locale)</strong>") . "</div>";
    			    }else{
    			        $strBlock = sprintf($translator->translate("Block %s%s%s doesn't found!"), "", $block, "");
    			    }
			    }
			}
    	}
    	return $strBlock;
    }
    
}