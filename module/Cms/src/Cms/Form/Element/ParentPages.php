<?php
namespace Cms\Form\Element;

use Cms\Model\PageTable;
use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\I18n\Translator\Translator;

class ParentPages extends Select implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $translator;
    protected $pageTable;
    
    public function __construct(PageTable $pageTable, \Zend\Mvc\I18n\Translator $translator){
        parent::__construct();
        $this->pageTable = $pageTable;
        $this->translator = $translator;
    }
    
    public function init()
    {
        $data = array();
        
        $pages = $this->pageTable->fetchAll();
        $data[] = "";
        
        foreach ($pages as $page){
            $data[$page->getId()] = $page->getTitle();
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
