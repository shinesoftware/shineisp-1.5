<?php
namespace ProductSettings\Form\Element;

use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\I18n\Translator\Translator;

class CommonAttributes extends Select implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $translator;
    protected $service;
    protected $is_user_defined;
    
    public function __construct(\Product\Service\ProductAttributeService $service, \Zend\Mvc\I18n\Translator $translator, $is_user_defined = true){
        parent::__construct();
        $this->service = $service;
        $this->translator = $translator;
        $this->is_user_defined = $is_user_defined;
    }
    
    public function init()
    {
        $data = array();
        
        $records = $this->service->findUserDefined($this->is_user_defined);
        
        foreach ($records as $record){
            $data[$record->getId()] =  $record->getName() . " - (" . $this->translator->translate($record->getLabel()) . ")";
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
