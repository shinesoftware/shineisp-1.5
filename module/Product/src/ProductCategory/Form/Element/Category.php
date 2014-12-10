<?php
namespace ProductCategory\Form\Element;

use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\I18n\Translator\Translator;

class Category extends Select implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $service;
    protected $translator;
    
    public function __construct(\ProductCategory\Service\CategoryService $service, \Zend\Mvc\I18n\Translator $translator){
        $this->service = $service;
        $this->translator = $translator;
        parent::__construct();
    }
    
    public function init()
    {
        $data = $this->service->getCategoryList();
        
        asort($data);
        $this->setValueOptions($data);
        
        $this->setEmptyOption($this->translator->translate('-- Please Select --'));
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
