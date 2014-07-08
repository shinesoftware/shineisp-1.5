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
						        
								// Generic route guards
						        array('route' => 'product', 'roles' => array('guest')),
						        array('route' => 'product/default', 'roles' => array('guest')),
								
								array('route' => 'zfcadmin/product', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product/default', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product/settings', 'roles' => array('admin')),
						),
				),
		),
		'navigation' => array(
				'admin' => array(
						'product' => array(
								'label' => _('Product'),
								'route' => 'zfcadmin/product',
						        'icon' => 'fa fa-barcode',
								'pages' => array (
										array (
												'label' => _('Products'),
												'route' => 'zfcadmin/product',
										        'icon' => 'fa fa-barcode',
										),
								),
						),
				),
		),
		'router' => array(
			'routes' => array(
				        'product' => array(
				            'type' => 'literal',
		                        'options' => array (
		                                'route' => '/product',
		                                'defaults' => array (
		                                        'controller' => 'Product\Controller\Index',
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
										'product' => array(
												'type' => 'Literal',
												'options' => array(
														'route' => '/product',
														'defaults' => array(
																'controller' => 'ProductAdmin\Controller\Index',
																'action'     => 'index',
														),
												),
												'may_terminate' => true,
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
																				'controller' => 'Product\Controller\Index',
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
		        
		    ),
			'factories' => array(
				'ProductAdmin\Controller\Index' => 'ProductAdmin\Factory\IndexControllerFactory',
			)
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
