GoalioForgotPassword
====================

Version 0.1.3 Created by the goalio UG (haftungsbeschränkt)

Introduction
------------

A Zend Framework 2 (ZF2) Module offering forgot password via e-mail functionality to ZfcUser

Information
-----------
I developed this module to use in our [goalio](http://www.goalio.de) application. There are currently no tests and support
can be a little slow because we are a small company with only two developers. I appreciate any feedback, pull requests are even better.


Requirements
------------

* [Zend Framework 2](https://github.com/zendframework/zf2) (latest master).
* [ZfcBase](https://github.com/ZF-Commons/ZfcBase) (latest master).
* [ZfcUser](https://github.com/ZF-Commons/ZfcUser) (latest master).
* [GoalioMailService](https://github.com/goalio/GoalioMailService) (latest master).

Features / Goals
----------------

* Add pluggable behaviour to request a password reset [COMPLETE]
* Provide updated login view [COMPLETE]

Installation
------------

### Main Setup

#### With composer

1. Add this project and the requirements in your composer.json:

    ```json
    "require": {
        "goalio/goalio-forgotpassword": "0.*"
    }
    ```

2. Now tell composer to download ZfcUser by running the command:

    ```bash
    $ php composer.phar update
    ```

#### Post installation

1. Enabling it in your `application.config.php`file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'ZfcBase',
            'ZfcUser',
            'GoalioMailService',
            'GoalioForgotPassword'
        ),
        // ...
    );
    ```

2. Then Import the SQL schema located in `./vendor/goalio/goalio-forgotpassword/data/schema.sql`.

3. Make sure that the MailService is configured correctly.

### Post-Install: Zend\Db

1. If you do not already have a valid Zend\Db\Adapter\Adapter in your service
   manager configuration, put the following in `./config/autoload/database.local.php`:

        <?php

        $dbParams = array(
            'database'  => 'changeme',
            'username'  => 'changeme',
            'password'  => 'changeme',
            'hostname'  => 'changeme',
        );

        return array(
            'service_manager' => array(
                'factories' => array(
                    'Zend\Db\Adapter\Adapter' => function ($sm) use ($dbParams) {
                        return new Zend\Db\Adapter\Adapter(array(
                            'driver'    => 'pdo',
                            'dsn'       => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'],
                            'database'  => $dbParams['database'],
                            'username'  => $dbParams['username'],
                            'password'  => $dbParams['password'],
                            'hostname'  => $dbParams['hostname'],
                        ));
                    },
                ),
            ),
        );

### Post-Install: Doctrine2 ORM

There is an additional module for Doctrine integration [GoalioForgotPasswordORM](https://github.com/goalio/GoalioForgotPasswordDoctrineORM)

### Usage

Navigate to http://yourproject/user and you should land on a login page.

Options
-------

The ForgotPassword module has some options to allow you to quickly customize the basic
functionality. After installing, copy
`./vendor/goalio/goalio-forgotpassword/config/goalioforgotpassword.global.php.dist` to
`./config/autoload/goalioforgotpassword.global.php` and change the values as desired.

The following options are available:

- **password_entity_class** - Name of Entity class to use. Useful for using your own
  entity class instead of the default one provided. Default is
  `GoalioRememberMe\Entity\RememberMe`.
- **reset_expire** - Integer value in seconds when the login cookie should expire.
  Default is `86400` (24 hours).
- **email_transport** - String value which transport class to use.
  Default is `Zend\Mail\Transport\Sendmail`.
- **reset_email_subject_line** - String value which transport class to use.
  Default is `You requested to reset your password`.
- **email_from_address** - Array
  Default is
	`array(
    	'email' => 'your_email_address@here.com',
    	'name' => 'Your name',
	)`.

Acknowledgements
----------------
Daniel Strøm (https://github.com/Danielss89)
for most of the basic work in the cookie adapter etc.
