<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Admin;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Cms\Model\Page;
use Cms\Model\PageTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements AutoloaderProviderInterface
{

	public function getModuleDependencies()
	{
		return array('Base');
	}
	
    public function getAutoloaderConfig ()
    {
        return array(
                'Zend\Loader\ClassMapAutoloader' => array(
                        __DIR__ . '/autoload_classmap.php'
                ),
                'Zend\Loader\StandardAutoloader' => array(
                        'namespaces' => array(
                                __NAMESPACE__ => __DIR__ . '/src/' .
                                         str_replace('\\', '/', __NAMESPACE__)
                        )
                )
        );
    }

    /**
     * Set the Services Manager items
     */
    public function getServiceConfig ()
    {
        return array(
                'abstract_factories' => array(),
                'aliases' => array(),
                'factories' => array(),
                'invokables' => array(),
                'services' => array(),
                'shared' => array()
        );
    }

    public function getConfig ()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap (MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $sm = $e->getApplication()->getServiceManager();
        $headLink = $sm->get('viewhelpermanager')->get('headLink');
        $headLink->appendStylesheet('/css/admin/bootstrap-switch.css', 'all')
                 ->appendStylesheet('/css/admin/bootstrap-typeahead.css', 'all')
                 ->appendStylesheet('/css/admin/admin.css', 'all');
        
        $inlineScript = $sm->get('viewhelpermanager')->get('inlineScript');
        $inlineScript->appendFile('/js/admin/bootstrap-hogan-2.0.0.js')
			         ->appendFile('/js/admin/bootstrap-typeahead.min.js')
			         ->appendFile('/js/admin/bootstrap-switch.min.js')
			         ->appendFile('/js/admin/admin.js');
    }
}
