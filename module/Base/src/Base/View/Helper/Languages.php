<?php 
namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Languages extends AbstractHelper implements ServiceLocatorAwareInterface  
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
        $translationTable = $serviceLocator->get('LanguagesService');
        $translator = $serviceLocator->get('translator');
        $translations = $translationTable->findAll();
        
        // Translate the language title and sort the result
        foreach ($translations as $translation){
            $titleTranslated = $translator->translate($translation->getLanguage());
            $newTranslations[$translation->getId()] = $titleTranslated;
        }

        // Sorting of the result
        asort($newTranslations);
        $locale = $translator->getTranslator()->getLocale();
        $selectedLanguage = $translationTable->findByLocale($locale);
        if(!empty($selectedLanguage)){
            $selLanguage = $selectedLanguage->getLanguage();
        }
        return $this->view->render('base/partial/languages', array('languages' => $newTranslations, 'selectedLanguage' => $selLanguage));
    }
}