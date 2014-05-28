<?php
/**
 * GoalioMailService Configuration
 *
 * If you have a ./config/autoload/ directory set up for your project, you can
 * drop this config file in it and change the values as you wish.
 */
$settings = array(

    /**
     * Transport Class
     *
     * Name of Zend Transport Class to use
     */
    'transport_class'   => 'Zend\Mail\Transport\Smtp',
    'options_class' => '\Zend\Mail\Transport\SmtpOptions',
    'options' => array(
            'host'             => 'mail.shineisp.com',
            'port'             => 25,
            'connectionClass'  => 'login',
            'connectionConfig' => array(
            //                     'ssl'      => 'tls',
                    'username' => 'info@shineisp.com',
                    'password' => 'mailpassword',
            ),
    ),

    /**
     * End of GoalioMailService configuration
     */
);

/**
 * You do not need to edit below this line
 */
return array(
    'goaliomailservice' => $settings,
);
