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

    public function __invoke($block)
    {
    	$strBlock = null;
    	
    	if(!empty($block)){
    		
	    	$serviceLocator = $this->getServiceLocator()->getServiceLocator();
	    	$theblock = $serviceLocator->get('BlockService');
	    	$settings = $serviceLocator->get('SettingsService');
			$translator = $serviceLocator->get('translator');
			
			$theBlock = $theblock->findByPlaceholder($block);
			if(!empty($theBlock)){
				$strBlock  = $theBlock->getContent();
			}else{
				$strBlock = "<div class=\"alert alert-danger\">" . sprintf($translator->translate("Block %s%s%s doesn't found!"), "<strong>", $block, "</strong>") . "</div>";
			}
    	}
    	return $strBlock;
    }
    
}