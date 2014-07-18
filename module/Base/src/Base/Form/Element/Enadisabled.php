<?php
namespace Base\Form\Element;

use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\I18n\Translator\Translator;

class Enadisabled extends Select implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $translator;
    
    public function __construct(\Zend\Mvc\I18n\Translator $translator){
        $this->translator = $translator;
        parent::__construct();
    }
    
    public function init()
    {
        $data = array('1' => $this->translator->translate('Enabled'), 
        		      '0' => $this->translator->translate('Disabled'));
        
        $this->setEmptyOption($this->translator->translate('-- Please Select --'));
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
