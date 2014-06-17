<?php
namespace Customer\Form\Element;

use Customer\Service\LegalformService;
use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\I18n\Translator\Translator;

class Legalform extends Select implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $translator;
    protected $legalform;
    
    public function __construct(LegalformService $legalformService, \Zend\Mvc\I18n\Translator $translator){
        parent::__construct();
        $this->legalform = $legalformService;
        $this->translator = $translator;
    }
    
    public function init()
    {
        $data = array();
        
        $pages = $this->legalform->findAll();
        $data[''] = "";
        
        foreach ($pages as $page){
            $data[$page->getId()] = $page->getName();
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
