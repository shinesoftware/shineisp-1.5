<?php
namespace ProductAdmin\Form\Element;

use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\I18n\Translator\Translator;

class Attributes extends Select implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $translator;
    protected $service;
    
    public function __construct(\Product\Service\ProductAttributeService $service, \Zend\Mvc\I18n\Translator $translator){
        parent::__construct();
        $this->service = $service;
        $this->translator = $translator;
    }
    
    public function init()
    {
        $data = array();
        
        $records = $this->service->findAll();
        
        foreach ($records as $record){
            $data[$record->getId()] = $this->translator->translate($record->getName());
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
