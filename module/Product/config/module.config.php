<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletoncms for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
        'asset_manager' => array(
                'resolver_configs' => array(
                        'collections' => array(
                                'js/application.js' => array(
                                        'commons/js/jquery-ui.min.js',
                                        'commons/js/jquery.fancytree.min.js',
                                        'commons/js/jquery.fancytree.dnd.js',
                                        'commons/js/jquery.fancytree.edit.js',
                                        'commons/js/bootstrap-select.min.js',
                                        'commons/js/select2.min.js',
                                        'js/product.js',
                                        'js/category.js',
                                ),
                                'css/application.css' => array(
                                        'commons/css/select2.min.css',
                                        'commons/css/bootstrap-select.css',
                                        'commons/css/ui.fancytree.min.css',
                                        'css/product.css',
                                ),
                        ),
                        'paths' => array(
                                __DIR__ . '/../public',
                                PUBLIC_PATH,
                        ),
                ),
        ),
		'bjyauthorize' => array(
				'guards' => array(
						'BjyAuthorize\Guard\Route' => array(
						        
								// Generic route guards
						        array('route' => 'product', 'roles' => array('guest')),
						        array('route' => 'product/default', 'roles' => array('guest')),
						        array('route' => 'product/search', 'roles' => array('guest')),
						        array('route' => 'category', 'roles' => array('guest')),
						        array('route' => 'category/default', 'roles' => array('guest')),
						        array('route' => 'category/slug', 'roles' => array('guest')),
						        
								array('route' => 'zfcadmin/category', 'roles' => array('admin')),
								array('route' => 'zfcadmin/category/default', 'roles' => array('admin')),
								array('route' => 'zfcadmin/category/add', 'roles' => array('admin')),
								array('route' => 'zfcadmin/category/get', 'roles' => array('admin')),
								array('route' => 'zfcadmin/category/move', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product/default', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product/settings', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product/attributes', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product/groups', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product/sets', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product/search', 'roles' => array('admin')),
								array('route' => 'zfcadmin/product/search/byid', 'roles' => array('admin')),
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
		                        ),
				                'may_terminate' => true,
				                'child_routes' => array(
				                        'default' => array(
				                                'type'    => 'Segment',
				                                'options' => array(
				                                        'route'    => '/[:controller[/:action]]',
				                                        'constraints' => array(
				                                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
				                                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
				                                        ),
				                                        'defaults' => array(
				                                        ),
				                                ),
				                        ),
				                ),
				        ),
				        'category' => array(
				            'type' => 'literal',
		                        'options' => array (
		                                'route' => '/category',
		                                'defaults' => array (
		                                        'controller' => 'ProductCategory\Controller\Category',
		                                        'action'     => 'index',
		                                )
		                        ),
				                'may_terminate' => true,
				                'child_routes' => array(
				                        'default' => array(
				                                'type'    => 'Segment',
				                                'options' => array(
				                                        'route'    => '/[:controller[/:action]]',
				                                        'constraints' => array(
				                                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
				                                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
				                                        ),
				                                        'defaults' => array(
				                                        ),
				                                ),
				                        ),
				                        'slug' => array(
				                                'type'    => 'Segment',
				                                'options' => array(
				                                        'route'    => '[/:slug].html',
				                                        'constraints' => array(
				                                                'slug'     => '[a-zA-Z][a-zA-Z0-9_-]*',
				                                        ),
				                                        'defaults' => array(
				                                                'action'        => 'index',
				                                        ),
				                                ),
				                        ),
				                ),
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
														'add' => array (
														        'type' => 'Segment',
														        'options' => array (
														                'route' => '/add/[:name][/:parent]',
														                'constraints' => array (
														                        'name' => '[A-Za-z ][A-Za-z0-9!@#$%^&* ]*',
														                        'parent' => '[.a-zA-Z0-9_-]*',
														                ),
														                'defaults' => array (
														                        'action'     => 'add',
														                )
														        )
														),
														'get' => array (
														        'type' => 'Segment',
														        'options' => array (
														                'route' => '/get/[:id]',
														                'constraints' => array (
														                        'id' => '[.a-zA-Z0-9_-]*',
														                ),
														                'defaults' => array (
														                        'action'     => 'get',
														                )
														        )
														),
														'move' => array (
														        'type' => 'Segment',
														        'options' => array (
														                'route' => '/move/[:orig][/:dest]',
														                'constraints' => array (
														                        'orig' => '[.a-zA-Z0-9_-]*',
														                        'dest' => '[.a-zA-Z0-9_-]*',
														                ),
														                'defaults' => array (
														                        'action'     => 'move',
														                )
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
														
														// this is the "JQuery Select2 object"
														'search' => array(
														        'type'    => 'Segment',
														        'options' => array(
														                'route'    => '/search',
														                'defaults' => array(
														                        'controller' => 'ProductCategory\Controller\Index',
														                        'action'        => 'getcategory',
														                        'query'        => null,
														                ),
														        ),
														        'may_terminate' => true,
														        'child_routes' => array (
														                'byid' => array (
														                        'type' => 'Segment',
														                        'options' => array (
														                                'route' => '/id[/:id]',
														                                'constraints' => array (
														                                        'id' => '[.a-zA-Z0-9,_-]*',
														                                ),
														                                'defaults' => array ()
														                        )
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
				'ProductCategory\Controller\Category' => 'ProductCategory\Factory\CategoryControllerFactory',
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
        'factories' => array(
                'navigation' => 'ProductCategory\Factory\CategoryNavigationFactory',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
