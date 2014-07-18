<?php
namespace Base\Form\Element;

use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\I18n\Translator\Translator;

class Yesno extends Select implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $translator;
    
    public function __construct(\Zend\Mvc\I18n\Translator $translator){
        $this->translator = $translator;
        parent::__construct();
    }
    
    public function init()
    {
        $data = array('0' => $this->translator->translate('Yes'), 
        		      '1' => $this->translator->translate('No'));
        
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
