<?php
namespace Base\Form\Element;

use Base\Service\LanguagesService;
use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\I18n\Translator\Translator;

class Languages extends Select implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $translator;
    protected $languagesService;
    
    public function __construct(LanguagesService $languagesService, \Zend\Mvc\I18n\Translator $translator){
        parent::__construct();
        $this->languagesService = $languagesService;
        $this->translator = $translator;
    }
    
    public function init()
    {
        $data = array();
        
        $pages = $this->languagesService->findAll();
        
        foreach ($pages as $page){
            $data[$page->getId()] = $page->getLanguage();
        }
        asort($data);
        $this->setValueOptions($data);
    }
    
    public function setServiceLocator(ServiceLocatorInterface $sl)
    {
        $this->serviceLocator = $sl;
    }
    
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}
