<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Base\Model\Languages;
use Base\Model\LanguagesTable;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $sm = $e->getApplication()->getServiceManager();
        $headLink = $sm->get('viewhelpermanager')->get('headLink');
        $headLink->appendStylesheet('/css/cms/bootstrap-tagsinput.css', 'all')
                 ->appendStylesheet('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', 'all')
                 ->appendStylesheet('//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css', 'all')
                 ->appendStylesheet('//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css', 'all');
    
        $inlineScript = $sm->get('viewhelpermanager')->get('inlineScript');
        $inlineScript->appendFile('//code.jquery.com/jquery.min.js')
        			 ->appendFile('/js/ckeditor/ckeditor.js')
        			 ->appendFile('/js/ckeditor/adapters/jquery.js')
        			 ->appendFile('//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js');
        
        // Add ACL information to the Navigation view helper
        $authorize = $e->getApplication()->getServiceManager()->get('BjyAuthorize\Service\Authorize');
        $acl = $authorize->getAcl();
        $role = $authorize->getIdentity();
        \Zend\View\Helper\Navigation::setDefaultAcl($acl);
        \Zend\View\Helper\Navigation::setDefaultRole($role);
        
        // BjyAuthorize user role configuration
        $adapter = $e->getApplication()->getServiceManager()->get('Zend\Db\Adapter\Adapter');
        
        // adding action for user registration
        $zfcServiceEvents = $e->getApplication()->getServiceManager()->get('zfcuser_user_service')->getEventManager();
        $zfcServiceEvents->attach('register.post', function  ($e) use( $adapter)
        {
        	$user = $e->getParam('user'); // User account object
        	$id = $user->getId(); // get user id
        
        	$adapter->query('INSERT INTO
        			user_role_linker (user_id, role_id)
        			VALUES
        			(' . $id . ', "user")', \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE);
        
        });
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
    					'LanguagesTable' => function  ($sm)
    					{
    						$tableGateway = $sm->get('LanguagesTableGateway');
    						$table = new LanguagesTable($tableGateway);
    						return $table;
    					},
    					'LanguagesTableGateway' => function  ($sm)
    					{
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$resultSetPrototype = new ResultSet();
    						$resultSetPrototype->setArrayObjectPrototype(new Languages());
    						return new TableGateway('languages', $dbAdapter, null, $resultSetPrototype);
    					},
    					
    					
    					'LanguagesForm' => function  ($sm)
    					{
    						$form = new \Base\Form\LanguagesForm();
    						$form->setInputFilter($sm->get('LanguagesFilter'));
    						return $form;
    					},
    					'LanguagesFilter' => function  ($sm)
    					{
    						return new \Base\Form\LanguagesFilter();
    					},
    			  	)
    			 );
    }
    
    /**
     * Handle the flash messages of the project
     * @return multitype:multitype:NULL  |\Base\View\Helper\FlashMessages
     */
    public function getViewHelperConfig ()
    {
    	return array (
    			'factories' => array (
    					'flashMessage' => function  ($sm)
    					{
    						$flashmessenger = $sm->getServiceLocator()->get('ControllerPluginManager')->get('flashmessenger');
    						$message = new \Base\View\Helper\FlashMessages();
    						$message->setFlashMessenger($flashmessenger);
    						return $message;
    					}
    					)
    					);
    }
    
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
