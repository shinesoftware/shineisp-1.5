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
								
						),
				),
		),
		'navigation' => array(
				'admin' => array(
						'settings' => array(
								'label' => _('Settings'),
								'route' => 'zfcadmin/languages',
								'pages' => array (
										array (
												'label' => 'Languages',
												'route' => 'zfcadmin/languages',
												'icon' => 'fa fa-flag'
										),
								),
						),
				),
		),
		'router' => array(
				'routes' => array(
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
				'invokables' => array(),
				'factories' => array(
						'Base\Controller\LanguagesAdmin' => 'Base\Factory\LanguagesControllerFactory',
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
					'socialSignInButton' => 'Base\View\Helper\SocialSignInButton'
			)
	),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => array (
        		'goalioforgotpassword' => __DIR__ . '/../view',
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
