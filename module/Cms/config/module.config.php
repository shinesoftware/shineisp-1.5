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
		                array('route' => 'home', 'roles' => array('guest')),
		                array('route' => 'application', 'roles' => array('guest')),
		                array('route' => 'application/default', 'roles' => array('guest')),
					),
			  ),
		),
		'navigation' => array(
				'admin' => array(
						'cmspages' => array(
								'label' => _('CMS'),
								'resource' => 'menu',
								'route' => 'zfcadmin/cmspage',
								'privilege' => 'list',
								'pages' => array (
										array (
												'label' => 'Pages',
												'route' => 'zfcadmin/cmspage',
												'icon' => 'fa fa-list'
										),
										array (
												'label' => 'Page Categories',
												'route' => 'zfcadmin/cmscategory',
												'icon' => 'fa fa-list'
										),
								),
						),
				),
		),
    'router' => array(
        'routes' => array(
        		'zfcadmin' => array(
        				'child_routes' => array(
        						'cmspage' => array(
        								'type' => 'literal',
        								'options' => array(
        										'route' => '/cmspage',
        										'defaults' => array(
        												'controller' => 'Cms\Controller\PageAdmin',
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
        										)
        								),
        						),
        						'cmscategory' => array(
        								'type' => 'literal',
        								'options' => array(
        										'route' => '/cmscategory',
        										'defaults' => array(
        												'controller' => 'Cms\Controller\PageCategoryAdmin',
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
        										)
        								),
        						),
        				),
        		),
            'cms' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/cms',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cms\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
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
                    'page' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:page].html',
                            'constraints' => array(
                            	'page'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            		'action'        => 'page',
                            ),
                        ),
                    ),
                    
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Cms\Controller\Index' => 'Cms\Controller\IndexController',
            'Cms\Controller\PageAdmin' => 'Cms\Controller\PageAdminController',
            'Cms\Controller\PageCategoryAdmin' => 'Cms\Controller\PageCategoryAdminController'
        ),
    ),
    'view_helpers' => array (
    		'invokables' => array (
		    		'extract' => 'Cms\View\Helper\Extract',
    				'tags' => 'Cms\View\Helper\Tags',
    		)
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
