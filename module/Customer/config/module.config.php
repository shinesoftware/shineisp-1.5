<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletoncms for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
		'bjyauthorize' => array(
				'guards' => array(
						'BjyAuthorize\Guard\Route' => array(
								
								array('route' => 'zfcadmin/customer/settings', 'roles' => array('admin')),
								
						        // Generic route guards
						        array('route' => 'customer', 'roles' => array('guest')),
						        array('route' => 'customer/default', 'roles' => array('guest')),
						),
				),
		),
		'navigation' => array(
				'admin' => array(
						'settings' => array(
								'label' => _('Settings'),
								'route' => 'zfcadmin',
								'pages' => array (
										array (
												'label' => 'Customer',
												'route' => 'zfcadmin/customer/settings',
												'icon' => 'fa fa-flag'
										),
								),
						),
						'customer' => array(
								'label' => 'Customer',
								'route' => 'home',
						        'icon' => 'fa fa-cog',
								'pages' => array (
										array (
												'label' => 'Customer Sub Menu',
												'route' => 'zfcadmin/customer/default',
										        'icon' => 'fa fa-star',
										),
								),
						),
				),
		),
		'router' => array(
			'routes' => array(
				        'customer' => array(
				            'type' => 'literal',
		                        'options' => array (
		                                'route' => '/customer',
		                                'defaults' => array (
		                                        'controller' => 'Customer\Controller\Index',
		                                        'action'     => 'index',
		                                )
		                        )
				        ),
				        'zfcadmin' => array(
				                'type' => 'literal',
				                'options' => array(
				                        'route'    => '/admin',
				                        'defaults' => array(
				                                'controller' => 'ZfcAdmin\Controller\AdminController',
				                                'action'     => 'index',
				                        ),
				                ),
				                'may_terminate' => true,
								'child_routes' => array(
										'customer' => array(
												'type' => 'Literal',
												'options' => array(
														'route' => '/customer',
														'defaults' => array(
																'controller' => 'CustomerAdmin\Controller\Index',
																'action'     => 'index',
														),
												),
												'child_routes' => array (
														'default' => array (
																'type' => 'Segment',
																'options' => array (
																		'route' => '/[:action[/:id]]',
																		'constraints' => array (
																				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
																				'id' => '[0-9]*'
																		),
																		'defaults' => array ()
																)
														),
														'settings' => array (
																'type' => 'Segment',
																'options' => array (
																		'route' => '/settings/[:action[/:id]]',
																		'constraints' => array (
																				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
																				'id' => '[0-9]*'
																		),
																		'defaults' => array (
																				'controller' => 'Customer\Controller\Index',
																				'action'     => 'index',
																		)
																)
														)
												),
												
										),
								),
						),
			    ),
		),
	'controllers' => array(
			'invokables' => array(
		        'Customer\Controller\Index' => 'Customer\Controller\IndexController'
		    ),
			'factories' => array()
	),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
