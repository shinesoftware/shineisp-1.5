<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonAdmin for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array ( 
		'bjyauthorize' => array(
				'guards' => array(
						'BjyAuthorize\Guard\Route' => array(
							//Admin module
                			array('route' => 'zfcadmin', 'roles' => array('admin')),
						),
				),
		),	
		'navigation' => array(
				'admin' => array(
						'home' => array(
								'label' => _('Admin'),
								'route' => 'zfcadmin',
						),
				),
		),
		'zfcadmin' => array(
				'admin_layout_template' => 'layout/admin'
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
