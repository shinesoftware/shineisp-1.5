<?php
namespace Cms\Form\Element;

use Cms\Service\PageService;
use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\I18n\Translator\Translator;

class ParentPages extends Select implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $translator;
    protected $pageService;
    
    public function __construct(PageService $pageService, \Zend\Mvc\I18n\Translator $translator){
        parent::__construct();
        $this->pageService = $pageService;
        $this->translator = $translator;
    }
    
    public function init()
    {
        $data = array();
        
        $pages = $this->pageService->findAll();
        $data[''] = "";
        
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
