<?php
namespace Customer\Form\Element;

use Customer\Service\ContactTypeService;
use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\I18n\Translator\Translator;

class ContactType extends Select implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $translator;
    protected $contacttype;
    
    public function __construct(ContactTypeService $contacttypeService, \Zend\Mvc\I18n\Translator $translator){
        parent::__construct();
        $this->contacttype = $contacttypeService;
        $this->translator = $translator;
    }
    
    public function init()
    {
        $data = array();
        
        $records = $this->contacttype->findAll();
        $data[''] = "";
        
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
