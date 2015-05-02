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
		                array('route' => 'cms', 'roles' => array('guest')),
		                array('route' => 'cms/page', 'roles' => array('guest')),
		                array('route' => 'cms/paginator', 'roles' => array('guest')),
		                array('route' => 'cms/search', 'roles' => array('guest')),
							
						// Custom Module
						array('route' => 'zfcadmin/cmspages', 'roles' => array('admin')),
						array('route' => 'zfcadmin/cmspages/default', 'roles' => array('admin')),
						array('route' => 'zfcadmin/cmspages/settings', 'roles' => array('admin')),

					    array('route' => 'zfcadmin/cmsblocks', 'roles' => array('admin')),
						array('route' => 'zfcadmin/cmsblocks/default', 'roles' => array('admin')),
						array('route' => 'zfcadmin/cmscategory', 'roles' => array('admin')),
						array('route' => 'zfcadmin/cmscategory/default', 'roles' => array('admin')),
						
					),
			  ),
		),
		'navigation' => array(
				'default' => array(
// 						'cms' => array(
// 								'label' => _('News'),
// 								'route' => 'cms',
// 						),
				),
				
				'admin' => array(
        				'settings' => array(
                				'label' => _('Settings'),
                				'route' => 'zfcadmin',
        				        'pages' => array (
    				                    array (
    				                        'label' => 'Cms',
    				                        'route' => 'zfcadmin/cmspages/settings',
    				                        'icon' => 'fa fa-file-text-o'
        				                ),
        				        ),
        				),				
						'cmspages' => array(
								'label' => _('CMS'),
								'resource' => 'menu',
								'route' => 'zfcadmin/cmspages',
								'privilege' => 'list',
								'icon' => 'fa fa-file-text-o',
								'pages' => array (
										array (
												'label' => 'Pages',
												'route' => 'zfcadmin/cmspages',
												'icon' => 'fa fa-file-text-o'
										),
										array (
												'label' => 'Blocks',
												'route' => 'zfcadmin/cmsblocks',
												'icon' => 'fa fa-th'
										),
										array (
												'label' => 'Page Categories',
												'route' => 'zfcadmin/cmscategory',
												'icon' => 'fa fa-folder'
										),
								),
						),
				),
		),
    'router' => array(
        'routes' => array(
        		'home' => array(
	                'type' => 'Zend\Mvc\Router\Http\Literal',
	                'options' => array(
	                    'route'    => '/',
	                    'defaults' => array(
	                        '__NAMESPACE__' => 'Cms\Controller',
	                        'controller'    => 'Index',
	                        'action'        => 'page',
	                        'slug'			=> 'homepage'
	                    ),
	                ),
	            ),
        		'zfcadmin' => array(
        				'child_routes' => array(
        						'cmspages' => array(
        								'type' => 'literal',
        								'options' => array(
        										'route' => '/cmspages',
        										'defaults' => array(
        												'controller' => 'CmsAdmin\Controller\Page',
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
            														'controller' => 'CmsSettings\Controller\Page',
            														'action'     => 'index',
        														)
        												)
        										)
        								),
        						),
        						
        						'cmscategory' => array(
        								'type' => 'literal',
        								'options' => array(
        										'route' => '/cmscategory',
        										'defaults' => array(
        												'controller' => 'CmsAdmin\Controller\PageCategory',
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
        						'cmsblocks' => array(
        								'type' => 'literal',
        								'options' => array(
        										'route' => '/cmsblocks',
        										'defaults' => array(
        												'controller' => 'CmsAdmin\Controller\Block',
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
                        'page'			=> 1
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
                            'route'    => '[/:slug].html',
                            'constraints' => array(
                            	'slug'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            		'action'        => 'page',
                            ),
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
                    'paginator' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/list/[page/:page]',
                            'constraints' => array(
                            	'page'     => '[0-9]*',
                            ),
                            'defaults' => array(
                            		'page'        => 1,
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
        'factories' => array(
        		'Cms\Controller\Index' => 'Cms\Factory\PageControllerFactory',
        		'Base\Controller\Search' => 'Cms\Factory\SearchControllerFactory',
        		'CmsAdmin\Controller\Page' => 'CmsAdmin\Factory\PageControllerFactory',
        		'CmsAdmin\Controller\Block' => 'CmsAdmin\Factory\BlockControllerFactory',
        		'CmsAdmin\Controller\PageCategory' => 'CmsAdmin\Factory\PageCategoryControllerFactory',
        		'CmsSettings\Controller\Page' => 'CmsSettings\Factory\PageControllerFactory',
        )
    ),
    'view_helpers' => array (
    		'invokables' => array (
    				'block' => 'Cms\View\Helper\Block',
    				'blocks' => 'Cms\View\Helper\Blocks',
		    		'extract' => 'Cms\View\Helper\Extract',
    				'tags' => 'Cms\View\Helper\Tags',
    		)
    ),
    'view_manager' => array(
        'template_map' => array(
                'footer' => __DIR__ . '/../view/cms/partial/footer.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
