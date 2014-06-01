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
						        array('route' => 'dummy', 'roles' => array('guest')),
						        array('route' => 'dummy/default', 'roles' => array('guest')),
						),
				),
		),
		'navigation' => array(
				'admin' => array(
						'dummy' => array(
								'label' => 'Dummy',
								'route' => 'home',
						        'icon' => 'fa fa-cog',
								'pages' => array (
										array (
												'label' => 'Dummy Sub Menu',
												'route' => 'home',
										        'icon' => 'fa fa-star',
										),
								),
						),
				),
		),
		'router' => array(
			'routes' => array(
				        'dummy' => array(
				            'type' => 'literal',
		                        'options' => array (
		                                'route' => '/dummy',
		                                'defaults' => array (
		                                        'controller' => 'Dummy\Controller\Index',
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
										'dummy' => array(
												'type' => 'Literal',
												'options' => array(
														'route' => '/dummy',
														'defaults' => array(
																'controller' => 'Dummy\Controller\Index',
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
														)
												),
										),
								),
						),
			    ),
		),
	'controllers' => array(
			'invokables' => array(
		        'Dummy\Controller\Index' => 'Dummy\Controller\IndexController'
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
