<?php
namespace Base\Form\Element;

use Base\Service\CountryService;
use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\I18n\Translator\Translator;

class Country extends Select implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $translator;
    protected $countryService;
    
    public function __construct(CountryService $countryService, \Zend\Mvc\I18n\Translator $translator){
        parent::__construct();
        $this->countryService = $countryService;
        $this->translator = $translator;
    }
    
    public function init()
    {
        $data = array();
        
        $records = $this->countryService->findAll();
        
        foreach ($records as $record){
            $data[$record->getId()] = $record->getName();
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
