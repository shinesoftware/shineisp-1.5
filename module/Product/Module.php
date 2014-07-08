<?php
/**
* Copyright (c) 2014 Shine Software.
* All rights reserved.
*
* Redistribution and use in source and binary forms, with or without
* modification, are permitted provided that the following conditions
* are met:
*
* * Redistributions of source code must retain the above copyright
* notice, this list of conditions and the following disclaimer.
*
* * Redistributions in binary form must reproduce the above copyright
* notice, this list of conditions and the following disclaimer in
* the documentation and/or other materials provided with the
* distribution.
*
* * Neither the names of the copyright holders nor the names of the
* contributors may be used to endorse or promote products derived
* from this software without specific prior written permission.
*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
* "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
* LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
* FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
* COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
* INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
* BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
* LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
* CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
* LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
* ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
* POSSIBILITY OF SUCH DAMAGE.
*
* @package Cms
* @subpackage Entity
* @author Michelangelo Turillo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Turillo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/


namespace Product;
use Product\Entity\ProductGroups;

use Product\Entity\ProductTypes;

use Product\Entity\Product;
use Product\Listeners\ProductListener;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;

class Module implements DependencyIndicatorInterface{
	
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $sm = $e->getApplication()->getServiceManager();
        $eventManager->attach(new ProductListener($sm));
    }
    
    /**
     * Set the Services Manager items
     */
    public function getServiceConfig() {
    	return array (
    			'factories' => array (
    					'ProductService' => function ($sm) {
	    					$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
	    					$translator = $sm->get ( 'translator' );
	    					$resultSetPrototype = new ResultSet ();
	    					$resultSetPrototype->setArrayObjectPrototype ( new Product () );
	    					$personaldata = new TableGateway ( 'product', $dbAdapter, null, $resultSetPrototype );
	    					$service = new \Product\Service\ProductService ( $personaldata, $translator );
	    					return $service;
    					},
    					'ProductTypeService' => function ($sm) {
	    					$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
	    					$translator = $sm->get ( 'translator' );
	    					$resultSetPrototype = new ResultSet ();
	    					$resultSetPrototype->setArrayObjectPrototype ( new ProductTypes () );
	    					$types = new TableGateway ( 'product_types', $dbAdapter, null, $resultSetPrototype );
	    					$service = new \Product\Service\ProductTypeService ( $types, $translator );
	    					return $service;
    					},
    					'ProductGroupService' => function ($sm) {
	    					$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
	    					$translator = $sm->get ( 'translator' );
	    					$resultSetPrototype = new ResultSet ();
	    					$resultSetPrototype->setArrayObjectPrototype ( new ProductGroups () );
	    					$types = new TableGateway ( 'product_groups', $dbAdapter, null, $resultSetPrototype );
	    					$service = new \Product\Service\ProductGroupService ( $types, $translator );
	    					return $service;
    					},
    	
				    
				    	'AdminProductForm' => function ($sm) {
					    	$form = new \ProductAdmin\Form\ProductForm ();
					    	$form->setInputFilter ( $sm->get ( 'AdminProductFilter' ) );
					    	return $form;
				    	},
				    
				    	'AdminProductFilter' => function ($sm) {
				    		return new \ProductAdmin\Form\ProductFilter ();
				    	},
				)
    	);
    }
    
    
    /**
     * Get the form elements
     */
    public function getFormElementConfig ()
    {
    	return array (
    			'factories' => array (
    					'ProductAdmin\Form\Element\Types' => function  ($sm)
    					{
    						$serviceLocator = $sm->getServiceLocator();
    						$translator = $sm->getServiceLocator()->get('translator');
    						$service = $serviceLocator->get('ProductTypeService');
    						$element = new \ProductAdmin\Form\Element\Types($service, $translator);
    						return $element;
    					},
    					'ProductAdmin\Form\Element\Groups' => function  ($sm)
    					{
    						$serviceLocator = $sm->getServiceLocator();
    						$translator = $sm->getServiceLocator()->get('translator');
    						$service = $serviceLocator->get('ProductGroupService');
    						$element = new \ProductAdmin\Form\Element\Groups($service, $translator);
    						return $element;
    					},
    			  ),
    	   );
    }
    
    /**
     * Check the dependency of the module
     * (non-PHPdoc)
     * @see Zend\ModuleManager\Feature.DependencyIndicatorInterface::getModuleDependencies()
     */
    public function getModuleDependencies()
    {
    	return array();
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                    __NAMESPACE__ . "Admin" => __DIR__ . '/src/' . __NAMESPACE__ . "Admin",
                    __NAMESPACE__ . "Settings" => __DIR__ . '/src/' . __NAMESPACE__ . "Settings",
                ),
            ),
        );
    }
}
