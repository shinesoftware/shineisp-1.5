<?php
namespace Cms\Form\Element;

use Cms\Model\PageCategoryTable;
use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\I18n\Translator\Translator;

class PageCategories extends Select implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $translator;
    protected $pagecategoryTable;
    
    public function __construct(PageCategoryTable $pagecategoryTable, \Zend\Mvc\I18n\Translator $translator){
        parent::__construct();
        $this->pagecategoryTable = $pagecategoryTable;
        $this->translator = $translator;
    }
    
    public function init()
    {
        $data = array();
        
        $pagecategories = $this->pagecategoryTable->fetchAll();
        foreach ($pagecategories as $pagecategory){
            $data[$pagecategory->getId()] = $this->translator->translate($pagecategory->getCategory());
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
