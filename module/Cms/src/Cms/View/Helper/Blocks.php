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

    public function __invoke($value)
    {
    	$serviceLocator = $this->getServiceLocator()->getServiceLocator();
    	$block = $serviceLocator->get('BlockService');

    	if(!empty($value)){
	    	$placeHolders = array();
			if(preg_match_all('/\{([^{}}]+)\}/', $value, $matches)) {
			    $placeHolders = $matches[1];
			}
			
			foreach ($placeHolders as $placeHolder){
				$theBlock = $block->findByPlaceholder($placeHolder);
				if(!empty($theBlock)){
					$value = str_replace("{" . $placeHolder . "}", $theBlock->getContent(), $value);
				}
			}
    	}
    	
    	return $value;
    }
}