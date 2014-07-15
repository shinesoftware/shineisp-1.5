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
								
								// ZfcUser module
								array('route' => 'zfcuser', 'roles' => array('guest')),
								array('route' => 'zfcuser/index', 'roles' => array('user')),
								array('route' => 'zfcuser/logout', 'roles' => array('user')),
								array('route' => 'zfcuser/login', 'roles' => array('guest')),
								array('route' => 'zfcuser/forgotpassword', 'roles' => array('guest')),
								array('route' => 'zfcuser/resetpassword', 'roles' => array('guest')),
								array('route' => 'zfcuser/changepassword', 'roles' => array('user')),
								array('route' => 'zfcuser/changeemail', 'roles' => array('user')),
								array('route' => 'zfcuser/register', 'roles' => array('guest')),
								
								// Social Auth Module
								array('route' => 'scn-social-auth-hauth', 'roles' => array('guest')),
								array('route' => 'scn-social-auth-user', 'roles' => array('guest')),
								array('route' => 'scn-social-auth-user/authenticate/provider', 'roles' => array('guest')),
								array('route' => 'scn-social-auth-user/authenticate', 'roles' => array('guest')),
								array('route' => 'scn-social-auth-user/login', 'roles' => array('guest')),
								array('route' => 'scn-social-auth-user/logout', 'roles' => array('guest')),
								array('route' => 'scn-social-auth-user/register', 'roles' => array('guest')),
								array('route' => 'scn-social-auth-user/login/provider', 'roles' => array('guest')),
								
								// Custom routes
								array('route' => 'switcher', 'roles' => array('guest')),
								array('route' => 'search', 'roles' => array('guest')),
								array('route' => 'location', 'roles' => array('guest')),
								array('route' => 'zfcadmin/languages', 'roles' => array('admin')),
								array('route' => 'zfcadmin/languages/default', 'roles' => array('admin')),
						),
				),
		),
		'navigation' => array(
				'admin' => array(
						'settings' => array(
								'label' => _('Settings'),
								'route' => 'zfcadmin/languages',
								'icon' => 'fa fa-cog',
								'pages' => array (
										array (
												'label' => 'Languages',
												'route' => 'zfcadmin/languages',
												'icon' => 'fa fa-language'
										),
								),
						),
				),
		),
		'router' => array(
				'routes' => array(
    				'switcher' => array(
    				         'type' => 'Segment',
    		                        'options' => array (
    		                                'route' => '/switch[/:id]',
    		                                'constraints' => array (
    		                                        'id' => '[0-9]*'
    		                                ),
    		                                'defaults' => array (
    		                                        'controller' => 'Base\Controller\LanguageSwitcher',
    		                                        'action'     => 'changelng',
    		                                )
    		                        )
    				        ),
    				'search' => array(
    				         'type' => 'Segment',
    		                        'options' => array (
    		                                'route'    => '/search/[query/:query]',
				                            'constraints' => array(
				                            	'query'     => '[a-zA-Z][a-zA-Z0-9_-]*',
				                            ),
				                            'defaults' => array(
				                            		'controller' => 'Base\Controller\Search',
				                            		'action'        => 'do',
				                            		'query'        => null,
				                            ),
    		                        )
    				        ),
    				'location' => array(
    				         'type' => 'Segment',
    		                        'options' => array (
    		                                'route' => '/location/[:action[/:id]]',
				                            'constraints' => array(
				                            	'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
				                            	'id' => '[0-9]*'
				                            ),
				                            'defaults' => array(
				                            		'controller' => 'Base\Controller\Location',
				                            		'action'        => 'index',
				                            		'id'        => null,
				                            ),
    		                        )
    				        ),
    						'zfcadmin' => array(
    								'child_routes' => array(
    										'languages' => array(
    												'type' => 'literal',
    												'options' => array(
    														'route' => '/languages',
    														'defaults' => array(
    																'controller' => 'Base\Controller\LanguagesAdmin',
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
				    ),
		),
		'controllers' => array(
				'invokables' => array(
				),
				'factories' => array(
						'Base\Controller\LanguagesAdmin' => 'Base\Factory\LanguagesControllerFactory',
						'Base\Controller\LanguageSwitcher' => 'Base\Factory\LanguageSwitcherControllerFactory',
						'Base\Controller\Location' => 'Base\Factory\LocationControllerFactory',
				)
		),
	'session' => array(
			'remember_me_seconds' => 2419200,
			'use_cookies' => true,
			'cookie_httponly' => true,
	),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'invokables' => array(
        		'Zend\Session\SessionManager' => 'Zend\Session\SessionManager',
        ),
        'factories' => array(
                'Base\Listeners\UserRegisterListener' => function($sm){
                	$config = $sm->get('config');
                    $config = $config['db'];
                    $dbAdapter = new Zend\Db\Adapter\Adapter($config);
                	$regListener = new Base\Listeners\UserRegisterListener();
                	$regListener->setAdapter($dbAdapter);
        			return $regListener;
		        },
                'Zend\Log\Logger' => function($sm){
                    $logger = new Zend\Log\Logger;
                    $writer = new Zend\Log\Writer\Stream('./data/log/'.date('Y-m-d').'-error.log');
                    $logger->addWriter($writer);
                    return $logger;
                },
                'goalioforgotpassword_forgot_form'     => 'Base\Factory\ForgotFactory',
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
	'view_helpers' => array (
			'invokables' => array (
					'datetime' => 'Base\View\Helper\Datetime',
					'user' => 'Base\View\Helper\User',
					'languages' => 'Base\View\Helper\Languages',
					'socialSignInButton' => 'Base\View\Helper\SocialSignInButton'
			)
	),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_path_stack' => array(
            __DIR__ . '/../view',
            'zfc-user' => __DIR__ . '/../view',
        ),
        'template_map' => array (
        		'goalioforgotpassword' => __DIR__ . '/../view',
        		'zfc-user/user/login' => __DIR__ . '/../view/zfc-user/user/login.phtml',
                'error/index' => __DIR__ . '/../view/error/index.phtml',
                'error/404' => __DIR__ . '/../view/error/404.phtml',
                'error/403' => __DIR__ . '/../view/error/403.phtml',
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
