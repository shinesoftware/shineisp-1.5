<?php

return array(
        
    'bjyauthorize' => array(

        // set the 'guest' role as default (must be defined in a role provider)
        'default_role'       => 'guest',         // not authenticated
        'authenticated_role' => 'user',          // authenticated
        'identity_provider'  => 'BjyAuthorize\Provider\Identity\ZfcUserZendDb',
        'unauthorized_strategy' => 'BjyAuthorize\View\RedirectionStrategy',
        'role_providers' => array(
                
            'BjyAuthorize\Provider\Role\ZendDb' => array(
                'table'                 => 'user_role',
                'identifier_field_name' => 'id',
                'role_id_field'         => 'role_id',
                'parent_role_field'     => 'parent_id',
            ),

        ),
            
        'resource_providers' => array(
                'BjyAuthorize\Provider\Resource\Config' => array(
                        'menu' => array(),
                        'adminmenu' => array(),
                ),
        ),
    
        'rule_providers' => array(
                'BjyAuthorize\Provider\Rule\Config' => array(
                        'allow' => array(
                                array(array('user'), 'menu', array('list')),  // UserType, Resource, Privileges
                                array(array('admin'), 'adminmenu', array('list')),  // UserType, Resource, Privileges
                        ),
                ),
        ),

        /* Currently, only controller and route guards exist
         *
         * Consider enabling either the controller or the route guard depending on your needs.
         */
        'guards' => array(
            'BjyAuthorize\Guard\Route' => array(

            ),
        ),
    ),
);