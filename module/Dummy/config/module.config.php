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
								
								array('route' => 'zfcadmin/dummy', 'roles' => array('admin')),
								array('route' => 'zfcadmin/dummy/default', 'roles' => array('admin')),
								array('route' => 'zfcadmin/dummy/settings', 'roles' => array('admin')),
								
						        // Generic route guards
						        array('route' => 'dummy', 'roles' => array('guest')),
						        array('route' => 'dummy/default', 'roles' => array('guest')),
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
												'label' => _('Dummys'),
												'route' => 'zfcadmin/dummy/settings',
												'icon' => 'fa fa-group'
										),
								),
						),
						'dummy' => array(
								'label' => 'Dummy',
								'route' => 'home',
						        'icon' => 'fa fa-user',
								'pages' => array (
										array (
												'label' => _('Dummys'),
												'route' => 'zfcadmin/dummy/default',
										        'icon' => 'fa fa-group',
										)
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
																'controller' => 'DummyAdmin\Controller\Index',
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
																				'controller' => 'DummySettings\Controller\Index',
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
	'view_helpers' => array(
		'invokables'=> array(
			'createMap' => 'Dummy\View\Helper\MapHelper',
		)
	),
	'controllers' => array(
			'invokables' => array(
		    ),
			'factories' => array(
				'DummyAdmin\Controller\Index' => 'DummyAdmin\Factory\IndexControllerFactory',
				'DummySettings\Controller\Index' => 'DummySettings\Factory\IndexControllerFactory',
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
