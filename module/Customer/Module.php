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

namespace Customer;

use Customer\Entity\Legalform;

use Customer\Listeners\CustomerListener;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Customer\Service\CustomerService;
use Customer\Service\LegalformService;
use Customer\Entity\Customer;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;

class Module implements DependencyIndicatorInterface {
	
	public function onBootstrap(MvcEvent $e) {
		$eventManager = $e->getApplication ()->getEventManager ();
		$moduleRouteListener = new ModuleRouteListener ();
		$moduleRouteListener->attach ( $eventManager );
		
		$sm = $e->getApplication ()->getServiceManager ();
		$eventManager->attach ( new CustomerListener ( $sm ) );
	}
	
	/**
	 * Set the Services Manager items
	 */
	public function getServiceConfig() {
		return array (
				'factories' => array (
						'CustomerService' => function ($sm) {
								$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
								$translator = $sm->get ( 'translator' );
								$resultSetPrototype = new ResultSet ();
								$resultSetPrototype->setArrayObjectPrototype ( new Customer () );
								$tableGateway = new TableGateway ( 'customer', $dbAdapter, null, $resultSetPrototype );
								$service = new \Customer\Service\CustomerService ( $tableGateway, $translator );
								return $service;
						 }, 
						'LegalformService' => function ($sm) {
								$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
								$translator = $sm->get ( 'translator' );
								$resultSetPrototype = new ResultSet ();
								$resultSetPrototype->setArrayObjectPrototype ( new Legalform () );
								$tableGateway = new TableGateway ( 'customer_legalform', $dbAdapter, null, $resultSetPrototype );
								$service = new \Customer\Service\LegalformService ( $tableGateway, $translator );
								return $service;
						 }, 

						'CustomerForm' => function ($sm) {
							$form = new \Customer\Form\CustomerForm ();
							$form->setInputFilter ( $sm->get ( 'CustomerFilter' ) );
							return $form;
						}, 
						
						'CustomerFilter' => function ($sm) {
							return new \Customer\Form\CustomerFilter ();
						} 
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
						'Customer\Form\Element\Legalform' => function  ($sm)
						{
							$serviceLocator = $sm->getServiceLocator();
							$translator = $sm->getServiceLocator()->get('translator');
							$service = $serviceLocator->get('LegalformService');
							$element = new \Customer\Form\Element\Legalform($service, $translator);
							return $element;
						},
						),
						);
	}
	
	/**
	 * Check the dependency of the module
	 * (non-PHPdoc)
	 * 
	 * @see Zend\ModuleManager\Feature.DependencyIndicatorInterface::getModuleDependencies()
	 */
	public function getModuleDependencies() {
		return array ();
	}
	
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}
	
	public function getAutoloaderConfig() {
		return array ('Zend\Loader\StandardAutoloader' => array ('namespaces' => array (__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__, __NAMESPACE__ . "Admin" => __DIR__ . '/src/' . __NAMESPACE__ . "Admin" ) ) );
	}
}
