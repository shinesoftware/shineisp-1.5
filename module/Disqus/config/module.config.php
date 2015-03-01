<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeleton for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
        'asset_manager' => array(
                'resolver_configs' => array(
                        'collections' => array(
                                'css/application.css' => array(
                                        'css/disqus.css',
                                ),
                        ),
                        'paths' => array(
                                __DIR__ . '/../public',
                        ),
                ),
        ),
		'bjyauthorize' => array(
				'guards' => array(
					'BjyAuthorize\Guard\Route' => array(
						array('route' => 'zfcadmin/disqus', 'roles' => array('admin')),
						array('route' => 'zfcadmin/disqus/settings', 'roles' => array('admin')),
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
    				                        'label' => 'Disqus',
    				                        'route' => 'zfcadmin/disqus/settings',
    				                        'icon' => 'fa fa-bullhorn'
        				                ),
        				        ),
        				),				
				),
		),
    'router' => array(
        'routes' => array(
        		'zfcadmin' => array(
        				'child_routes' => array(
        						'disqus' => array(
        								'type' => 'literal',
        								'options' => array(
        										'route' => '/disqus',
        										'defaults' => array(
        												'controller' => 'Disqus\Controller\Index',
        												'action'     => 'index',
        										),
        								),
        								'may_terminate' => true,
        								'child_routes' => array (
        										'settings' => array (
        												'type' => 'Segment',
        												'options' => array (
        														'route' => '/settings/[:action[/:id]]',
        														'constraints' => array (
        																'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        																'id' => '[0-9]*'
        														),
        														'defaults' => array (
            														'controller' => 'DisqusSettings\Controller\Index',
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
        		'DisqusSettings\Controller\Index' => 'DisqusSettings\Factory\IndexControllerFactory',
        )
    ),
    'view_helpers' => array (
    		'invokables' => array (
    				'disqus' => 'Disqus\View\Helper\Widget',
    		)
    ),
    'view_manager' => array(
        'template_map' => array(
        ),
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
