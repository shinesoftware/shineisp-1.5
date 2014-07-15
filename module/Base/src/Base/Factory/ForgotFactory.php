<?php
namespace Base\Factory;

use GoalioForgotPassword\Form\Forgot;
use GoalioForgotPassword\Form\ForgotFilter;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class ForgotFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $options = $serviceLocator->get('goalioforgotpassword_module_options');
        $form = new Forgot(null, $options);
        $validator = new \ZfcUser\Validator\RecordExists(array(
            'mapper' => $serviceLocator->get('zfcuser_user_mapper'),
            'key'    => 'email'
        ));

        $translator = $serviceLocator->get('Translator');

        $validator->setMessage($translator->translate('Thank you, if your email address is in our database you will receive a mail message in your mailbox.'));
        $form->setInputFilter(new ForgotFilter($validator,$options));
        return $form;
    }

}