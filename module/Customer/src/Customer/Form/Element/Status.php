<?php
namespace Customer\Form\Element;

use Base\Service\StatusService;
use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\I18n\Translator\Translator;

class Status extends Select implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $translator;
    protected $status;
    
    public function __construct(StatusService $statusService, \Zend\Mvc\I18n\Translator $translator){
        parent::__construct();
        $this->status = $statusService;
        $this->translator = $translator;
    }
    
    public function init()
    {
        $data = array();
        $section = $this->getOption('section');

        print_r($section);
        
        $records = $this->status->findAll();
        $data[''] = "";
        
        foreach ($records as $record){
            $data[$record->getId()] = $this->translator->translate($record->getStatus());
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
