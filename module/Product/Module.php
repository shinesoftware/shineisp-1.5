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

use Product\Entity\ProductAttributeSet;
use Product\Entity\ProductAttributes;
use Product\Entity\ProductAttributeSetIdx;
use Product\Entity\ProductAttributeGroups;
use Product\Entity\ProductAttributeIdx;
use Product\Entity\ProductTypes;
use Product\Entity\Product;
use Product\Listeners\ProductListener;
use ProductCategory\Entity\Category;
use ProductAdmin\Form\ProductAttributesForm;
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
        
        
        $headLink = $sm->get('viewhelpermanager')->get('headLink');
        $headLink->appendStylesheet('/css/base/fancytree/ui.fancytree.min.css');
        $headLink->appendStylesheet('/css/product/product.css');
        
        $inlineScript = $sm->get('viewhelpermanager')->get('inlineScript');
        $inlineScript->appendFile('/js/product/jquery.fancytree.min.js');
        $inlineScript->appendFile('/js/product/jquery.fancytree.dnd.js');
        $inlineScript->appendFile('/js/product/jquery.fancytree.edit.js');
        $inlineScript->appendFile('/js/product/product.js');
        $inlineScript->appendFile('/js/product/category.js');
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
	    					$tablegateway = new TableGateway ( 'product', $dbAdapter, null, $resultSetPrototype );
	    					$service = new \Product\Service\ProductService ( $tablegateway, $sm->get('ProductEAV'), $sm->get('ProductAttributeGroupService'), $sm->get('ProductAttributeSetService'), $sm->get('ProductAttributeService'), $translator );
	    					return $service;
    					},
    					'ProductEAV' => function ($sm) {
	    					$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
	    					$resultSetPrototype = new ResultSet ();
	    					$resultSetPrototype->setArrayObjectPrototype ( new Product () );
	    					$tablegateway = new TableGateway ( 'product', $dbAdapter, null, $resultSetPrototype );
	    					$service = new \Product\Model\EavProduct( $tablegateway );
	    					return $service;
    					},
    					'ProductTypeService' => function ($sm) {
	    					$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
	    					$translator = $sm->get ( 'translator' );
	    					$resultSetPrototype = new ResultSet ();
	    					$resultSetPrototype->setArrayObjectPrototype ( new ProductTypes () );
	    					$tablegateway = new TableGateway ( 'product_types', $dbAdapter, null, $resultSetPrototype );
	    					$service = new \Product\Service\ProductTypeService ( $tablegateway, $translator );
	    					return $service;
    					},
    					'ProductAttributeSetService' => function ($sm) {
	    					$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
	    					$translator = $sm->get ( 'translator' );
	    					$resultSetPrototype = new ResultSet ();
	    					$resultSetPrototype->setArrayObjectPrototype ( new ProductAttributeSet () );
	    					$tablegateway = new TableGateway ( 'product_attributes_set', $dbAdapter, null, $resultSetPrototype );
	    					$service = new \Product\Service\ProductAttributeSetService ( $tablegateway, $sm->get('ProductAttributeGroupService'), $sm->get('ProductAttributeIdxService'), $translator );
	    					return $service;
    					},
    					'ProductAttributeSetIdxService' => function ($sm) { 
	    					$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
	    					$translator = $sm->get ( 'translator' );
	    					$resultSetPrototype = new ResultSet ();
	    					$resultSetPrototype->setArrayObjectPrototype ( new ProductAttributeSetIdx () );
	    					$tablegateway = new TableGateway ( 'product_attributes_set_idx', $dbAdapter, null, $resultSetPrototype );
	    					$service = new \Product\Service\ProductAttributeSetIdxService ( $tablegateway, $translator );
	    					return $service;
    					},
    					'ProductAttributeGroupService' => function ($sm) {
	    					$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
	    					$translator = $sm->get ( 'translator' );
	    					$resultSetPrototype = new ResultSet ();
	    					$resultSetPrototype->setArrayObjectPrototype ( new ProductAttributeGroups () );
	    					$tablegateway = new TableGateway ( 'product_attributes_groups', $dbAdapter, null, $resultSetPrototype );
	    					$service = new \Product\Service\ProductAttributeGroupService ( $tablegateway, $translator );
	    					return $service;
    					},
    					'ProductAttributeIdxService' => function ($sm) {
	    					$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
	    					$translator = $sm->get ( 'translator' );
	    					$resultSetPrototype = new ResultSet ();
	    					$resultSetPrototype->setArrayObjectPrototype ( new ProductAttributeIdx () );
	    					$tablegateway = new TableGateway ( 'product_attributes_idx', $dbAdapter, null, $resultSetPrototype );
	    					$service = new \Product\Service\ProductAttributeIdxService ( $tablegateway, $translator );
	    					return $service;
    					},
    					'ProductAttributeService' => function ($sm) {
	    					$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
	    					$translator = $sm->get ( 'translator' );
	    					$resultSetPrototype = new ResultSet ();
	    					$resultSetPrototype->setArrayObjectPrototype ( new ProductAttributes () );
	    					$tablegateway = new TableGateway ( 'product_attributes', $dbAdapter, null, $resultSetPrototype );
	    					$service = new \Product\Service\ProductAttributeService ( $tablegateway, $translator );
	    					return $service;
    					},
    					'CategoryService' => function ($sm) {
	    					$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
	    					$translator = $sm->get ( 'translator' );
	    					$resultSetPrototype = new ResultSet ();
	    					$resultSetPrototype->setArrayObjectPrototype ( new Category () );
	    					$tablegateway = new TableGateway ( 'product_category', $dbAdapter, null, $resultSetPrototype );
	    					$service = new \ProductCategory\Service\CategoryService ( $tablegateway, $translator );
	    					return $service;
    					},
    	
				    	'ProductNewForm' => function ($sm) {
					    	$form = new \ProductAdmin\Form\ProductNewForm ();
					    	$form->setInputFilter ( $sm->get ( 'ProductNewFilter' ) );
					    	return $form;
				    	},
				    
				    	'ProductNewFilter' => function ($sm) {
				    		return new \ProductAdmin\Form\ProductNewFilter ();
				    	},
    	
				    
				    	'AdminProductForm' => function ($sm) {
					    	$form = new \ProductAdmin\Form\ProductForm ();
					    	$form->setInputFilter ( $sm->get ( 'AdminProductFilter' ) );
					    	return $form;
				    	},
				    
				    	'AdminProductFilter' => function ($sm) {
				    		return new \ProductAdmin\Form\ProductFilter ();
				    	},
				    
				    	'AttributesForm' => function ($sm) {
					    	$form = new \ProductAdmin\Form\AttributesForm ();
					    	$form->setInputFilter ( $sm->get ( 'AttributesFilter' ) );
					    	return $form;
				    	},
				    
				    	'AttributesFilter' => function ($sm) {
				    		return new \ProductAdmin\Form\AttributesFilter ();
				    	},
				    
				    	'AttributeGroupsForm' => function ($sm) {
					    	$form = new \ProductAdmin\Form\AttributeGroupsForm ();
					    	$form->setInputFilter ( $sm->get ( 'AttributeGroupsFilter' ) );
					    	return $form;
				    	},
				    
				    	'AttributeGroupsFilter' => function ($sm) {
				    		return new \ProductAdmin\Form\AttributeGroupsFilter ();
				    	},
				    
				    	'AttributeSetForm' => function ($sm) {
					    	$form = new \ProductAdmin\Form\AttributeSetForm ();
					    	$form->setInputFilter ( $sm->get ( 'AttributeSetFilter' ) );
					    	return $form;
				    	},
				    
				    	'AttributeSetFilter' => function ($sm) {
				    		return new \ProductAdmin\Form\AttributeSetFilter ();
				    	},
				    	
				    	'CategoryForm' => function ($sm) {
					    	$form = new \ProductCategory\Form\CategoryForm ();
					    	$form->setInputFilter ( $sm->get ( 'CategoryFilter' ) );
					    	return $form;
				    	},
				    
				    	'CategoryFilter' => function ($sm) {
				    		return new \ProductCategory\Form\CategoryFilter ();
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
    					'ProductAdmin\Form\Element\Attributes' => function  ($sm)
    					{
    						$serviceLocator = $sm->getServiceLocator();
    						$translator = $sm->getServiceLocator()->get('translator');
    						$service = $serviceLocator->get('ProductAttributeService');
    						$element = new \ProductAdmin\Form\Element\Attributes($service, $translator);
    						return $element;
    					},
    					'ProductAdmin\Form\Element\AttributeSet' => function  ($sm)
    					{
    						$serviceLocator = $sm->getServiceLocator();
    						$translator = $sm->getServiceLocator()->get('translator');
    						$service = $serviceLocator->get('ProductAttributeSetService');
    						$element = new \ProductAdmin\Form\Element\AttributeSets($service, $translator);
    						return $element;
    					},
    					'ProductSettings\Form\Element\CommonAttributes' => function  ($sm)
    					{
    						$serviceLocator = $sm->getServiceLocator();
    						$translator = $sm->getServiceLocator()->get('translator');
    						$service = $serviceLocator->get('ProductAttributeService');
    						$element = new \ProductSettings\Form\Element\CommonAttributes($service, $translator, false);
    						return $element; 
    					},
    					'ProductAdmin\Form\Element\Groups' => function  ($sm)
    					{
    						$serviceLocator = $sm->getServiceLocator();
    						$translator = $sm->getServiceLocator()->get('translator');
    						$service = $serviceLocator->get('ProductAttributeGroupService');
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
                    __NAMESPACE__ . "Category" => __DIR__ . '/src/' . __NAMESPACE__ . "Category",
                ),
            ),
        );
    }
}
