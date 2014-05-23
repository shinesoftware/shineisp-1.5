<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Cms;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Cms\Model\Page;
use Cms\Model\PageTable;
use Cms\Model\PageCategory;
use Cms\Model\PageCategoryTable;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $sm = $e->getApplication()->getServiceManager();
        $headLink = $sm->get('viewhelpermanager')->get('headLink');
        $headLink->appendStylesheet('/css/cms/bootstrap-tagsinput.css');
        
        $inlineScript = $sm->get('viewhelpermanager')->get('inlineScript');
        $inlineScript->appendFile('/js/cms/bootstrap-tagsinput.min.js');
        $inlineScript->appendFile('/js/cms/module.js');
        
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    
    /**
     * Set the Services Manager items
     */
    public function getServiceConfig ()
    {
    	return array(
    			'factories' => array(
    					'PageTable' => function  ($sm)
    					{
    						$tableGateway = $sm->get('PageTableGateway');
    						$table = new PageTable($tableGateway);
    						return $table;
    					},
    					'PageTableGateway' => function  ($sm)
    					{
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$resultSetPrototype = new ResultSet();
    						$resultSetPrototype->setArrayObjectPrototype(new Page());
    						return new TableGateway('page', $dbAdapter, null, $resultSetPrototype);
    					},
    					
    					'PageCategoryTable' => function  ($sm)
    					{
    						$tableGateway = $sm->get('PageCategoryTableGateway');
    						$table = new PageCategoryTable($tableGateway);
    						return $table;
    					},
    					'PageCategoryTableGateway' => function  ($sm)
    					{
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$resultSetPrototype = new ResultSet();
    						$resultSetPrototype->setArrayObjectPrototype(new PageCategory());
    						return new TableGateway('page_category', $dbAdapter, null, $resultSetPrototype);
    					},
    					
    					'PageForm' => function  ($sm)
    					{
    						$form = new \Cms\Form\PageForm();
    						$form->setInputFilter($sm->get('PageFilter'));
    						return $form;
    					},
    					'PageFilter' => function  ($sm)
    					{
    						return new \Cms\Form\PageFilter();
    					},
    					
    					'PageCategoryForm' => function  ($sm)
    					{
    						$form = new \Cms\Form\PageCategoryForm();
    						$form->setInputFilter($sm->get('PageCategoryFilter'));
    						return $form;
    					},
    					'PageCategoryFilter' => function  ($sm)
    					{
    						return new \Cms\Form\PageCategoryFilter();
    					}
    					
    				),
    			);
    }
    
    
    /**
     * Get the form elements
     */
    public function getFormElementConfig ()
    {
    	return array (
    			'factories' => array (
    					'Cms\Form\Element\PageCategories' => function  ($sm)
		    					{
		    						$serviceLocator = $sm->getServiceLocator();
		    						$translator = $sm->getServiceLocator()->get('translator');
		    						$CategoryTable = $serviceLocator->get('PageCategoryTable');
		    						$element = new \Cms\Form\Element\PageCategories($CategoryTable, $translator);
		    						return $element;
		    					},
    					'Cms\Form\Element\ParentPages' => function  ($sm)
		    					{
		    						$serviceLocator = $sm->getServiceLocator();
		    						$translator = $sm->getServiceLocator()->get('translator');
		    						$PageTable = $serviceLocator->get('PageTable');
		    						$element = new \Cms\Form\Element\ParentPages($PageTable, $translator);
		    						return $element;
		    					},
    						),
    					);
    }
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                    __NAMESPACE__ . "Admin" => __DIR__ . '/src/' . __NAMESPACE__ . "Admin",
                ),
            ),
        );
    }
}
