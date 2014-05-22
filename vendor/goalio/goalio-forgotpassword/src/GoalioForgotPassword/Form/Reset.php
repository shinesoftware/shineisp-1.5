<?php

namespace GoalioForgotPassword\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;
use GoalioForgotPassword\Options\ForgotOptionsInterface;

class Reset extends ProvidesEventsForm
{
    /**
     * @var ForgotOptionsInterface
     */
    protected $forgotOptions;

    public function __construct($name = null, ForgotOptionsInterface $forgotOptions)
    {
        $this->setForgotOptions($forgotOptions);
        parent::__construct($name);

        $this->add(array(
            'name' => 'newCredential',
            'options' => array(
                'label' => 'New Password',
            ),
            'attributes' => array(
                'type' => 'password',
            ),
        ));

        $this->add(array(
            'name' => 'newCredentialVerify',
            'options' => array(
                'label' => 'Verify New Password',
            ),
            'attributes' => array(
                'type' => 'password',
            ),
        ));

        $submitElement = new Element\Button('submit');
        $submitElement
            ->setLabel('Set new password')
            ->setAttributes(array(
                'type'  => 'submit',
            ));

        $this->add($submitElement, array(
            'priority' => -100,
        ));

        $this->getEventManager()->trigger('init', $this);
    }

    public function setForgotOptions(ForgotOptionsInterface $forgotOptions)
    {
        $this->forgotOptions = $forgotOptions;
        return $this;
    }

    public function getForgotOptions()
    {
        return $this->forgotOptions;
    }
}
