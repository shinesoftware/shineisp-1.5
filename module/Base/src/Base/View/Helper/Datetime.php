<?php 
namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Datetime extends AbstractHelper implements ServiceLocatorAwareInterface {
	
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

    public function __invoke($value, $format = 'Y-m-d H:i:s')
    {
        $translator = $this->getServiceLocator()->getServiceLocator()->get('translator');
        $locale = $translator->getTranslator()->getLocale();
        
        setlocale (LC_TIME, $locale);
        
        $date = new \DateTime($value);
        return $date->format($format);
    }
}