<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonAdmin for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array ( 
        'asset_manager' => array(
                'resolver_configs' => array(
                        'collections' => array(
                                'js/administration.js' => array(
                                        'commons/js/jquery-1.11.1.js',
                                        'commons/js/jquery-ui.min.js',
                                        'commons/js/bootstrap.min.js',
                                        'commons/js/bootstrap-hogan-2.0.0.js',
                                        'commons/js/bootstrap-typeahead.min.js',
                                        'js/ckeditor.path.js',
                                        'commons/ckeditor/ckeditor.js',
                                        'commons/ckeditor/adapters/jquery.js',
                                        'commons/js/jquery.datetimepicker.js',
                                        'js/admin.js',
                                ),
                                'css/administration.css' => array(
                                        'commons/css/bootstrap.min.css',
                                        'commons/css/bootstrap-typeahead.css',
                                        'commons/css/font-awesome.min.css',
                                        'commons/css/jquery.datetimepicker.css',
                                        'css/admin.css',
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
							//Admin module
                			array('route' => 'zfcadmin', 'roles' => array('admin')),
						),
				),
		),	
		'navigation' => array(
				'default' => array(
						 'admin' => array(
        		                'label' => _('Admin'),
        		                'route' => 'zfcadmin',
        		                'resource' => 'adminmenu',  // look at the bjyauthorize.global.php config file
        		                'privilege' => 'list', 
        		                'icon' => 'fa fa-cog',
        		                'order' => '1000', 
        		        ),
				),
				'admin' => array(
						'home' => array(
								'label' => _('Dashboard'),
								'route' => 'zfcadmin',
								'icon' => 'fa fa-home'
						),
				),
		),
		'zfcadmin' => array(
				'admin_layout_template' => 'layout/backend'
		),
        'view_manager' => array ( 
                'template_map' => array ( 
                		'layout/layout' => __DIR__ . '/../view/layout/backend.phtml',
                        'admin/index/index' => __DIR__ . '/../view/admin/index/index.phtml', 
                        'error/404' => __DIR__ . '/../view/error/404.phtml', 
                        'error/index' => __DIR__ . '/../view/error/index.phtml',
                        'zfc-datagrid/renderer/bootstrapTable/layout' => __DIR__ . '/../view/zfc-datagrid/renderer/bootstrapTable/layout.phtml',
                ), 
                'template_path_stack' => array ( 
                        __DIR__ . '/../view'
                )
        ), 
);
