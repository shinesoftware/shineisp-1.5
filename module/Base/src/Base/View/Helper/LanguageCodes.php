<?php 
namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LanguageCodes extends AbstractHelper implements ServiceLocatorAwareInterface  
{
    /**
     * Set the service locator.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return CustomHelper
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
    /**
     * Get the service locator.
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
    
    public function __invoke()
    {
        $selLanguage = null;
        $serviceLocator = $this->getServiceLocator()->getServiceLocator();
        $languageService = $serviceLocator->get('LanguagesService');
        $translator = $serviceLocator->get('translator');
        
        // get the language codes
        $langList = $languageService->getCodes();
        
        return $langList;
    }
}