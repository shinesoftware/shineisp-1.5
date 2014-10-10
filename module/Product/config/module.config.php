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
						        array('route' => 'product/search', 'roles' => array('guest')),
						        
								array('route' => 'zfcadmin/category', 'roles' => array('admin')),
								array('route' => 'zfcadmin/category/default', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product/default', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product/settings', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product/attributes', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product/groups', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product/sets', 'roles' => array('admin')),
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
												'label' => _('Products'),
												'route' => 'zfcadmin/product/settings',
												'icon' => 'fa fa-barcode'
										),
										
								),
						),
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
										array (
												'label' => _('Category'),
												'route' => 'zfcadmin/category',
										        'icon' => 'fa fa-barcode',
										),
										array (
												'label' => _('Attributes'),
												'route' => 'zfcadmin/product/attributes',
												'icon' => 'fa fa-puzzle-piece',
										),
										array (
												'label' => _('Attribute Groups'),
												'route' => 'zfcadmin/product/groups',
												'icon' => 'fa fa-puzzle-piece',
										),
										array (
												'label' => _('Attribute Sets'),
												'route' => 'zfcadmin/product/sets',
												'icon' => 'fa fa-puzzle-piece',
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
										'category' => array(
												'type' => 'Literal',
												'options' => array(
														'route' => '/category',
														'defaults' => array(
																'controller' => 'ProductCategory\Controller\Index',
																'action'     => 'index',
														),
												),
												'may_terminate' => true,
												'child_routes' => array (
														'default' => array (
																'type' => 'Segment',
																'options' => array (
																		'route' => '/[:action[/:id][/:attribute][/:file]]',
																		'constraints' => array (
																				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
																				'id' => '[.a-zA-Z0-9_-]*',
																				'attribute' => '[0-9]*',
																				'file' => '([.\s\w-]|%20){3,}',
																		),
																		'defaults' => array ()
																)
														),
												),
										
										),
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
																		'route' => '/[:action[/:id][/:attribute][/:file]]',
																		'constraints' => array (
																				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
																				'id' => '[.a-zA-Z0-9_-]*',
																				'attribute' => '[0-9]*',
																				'file' => '([.\s\w-]|%20){3,}',
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
																				'controller' => 'ProductSettings\Controller\Index',
																				'action'     => 'index',
																		)
																)
														),
														'attributes' => array (
																'type' => 'Segment',
																'options' => array (
																		'route' => '/attributes/[:action[/:id]]',
																		'constraints' => array (
																				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
																				'id' => '[0-9]*'
																		),
																		'defaults' => array (
																				'controller' => 'ProductAdmin\Controller\Attributes',
																				'action'     => 'index',
																		)
																),
														),
														'groups' => array (
																'type' => 'Segment',
																'options' => array (
																		'route' => '/groups/[:action[/:id]]',
																		'constraints' => array (
																				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
																				'id' => '[0-9]*'
																		),
																		'defaults' => array (
																				'controller' => 'ProductAdmin\Controller\AttributeGroups',
																				'action'     => 'index',
																		)
																),
														),
														'sets' => array (
																'type' => 'Segment',
																'options' => array (
																		'route' => '/sets/[:action[/:id]]',
																		'constraints' => array (
																				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
																				'id' => '[0-9]*'
																		),
																		'defaults' => array (
																				'controller' => 'ProductAdmin\Controller\AttributeSet',
																				'action'     => 'index',
																		)
																),
														),
														'search' => array(
														        'type'    => 'Segment',
														        'options' => array(
														                'route'    => '/search/[query/:query]',
														                'constraints' => array(
														                        'query'     => '[a-zA-Z][a-zA-Z0-9_-]*',
														                ),
														                'defaults' => array(
														                        'action'        => 'search',
														                        'query'        => null,
														                ),
														        ),
														),
												),
										),
								),
						),
			    ),
		),
		
		'view_helpers' => array(
				'invokables'=> array(
						'filemanager' => 'ProductAdmin\View\Helper\FilemanagerHelper',
				)
		),
		'input_filters' => array(
				'invokables' => array(
						'cleanurl' => 'ProductAdmin\Form\Filter\Cleanurl',
				),
		),
		
		
	'controllers' => array(
			'invokables' => array(
		        
		    ),
			'factories' => array(
				'ProductCategory\Controller\Index' => 'ProductCategory\Factory\IndexControllerFactory',
				'ProductAdmin\Controller\Index' => 'ProductAdmin\Factory\IndexControllerFactory',
				'Base\Controller\Search' => 'Product\Factory\SearchControllerFactory',
				'ProductAdmin\Controller\Attributes' => 'ProductAdmin\Factory\AttributesControllerFactory',
				'ProductAdmin\Controller\AttributeGroups' => 'ProductAdmin\Factory\AttributeGroupsControllerFactory',
				'ProductAdmin\Controller\AttributeSet' => 'ProductAdmin\Factory\AttributeSetControllerFactory',
				'ProductSettings\Controller\Index' => 'ProductSettings\Factory\IndexControllerFactory',
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
