<?php

namespace GoalioForgotPassword\Form;

use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;
use GoalioForgotPassword\Options\ForgotOptionsInterface;

class Forgot extends ProvidesEventsForm
{
    /**
     * @var AuthenticationOptionsInterface
     */
    protected $forgotOptions;

    public function __construct($name = null, ForgotOptionsInterface $options)
    {
        $this->setForgotOptions($options);
        parent::__construct($name);

        $this->add(array(
            'name' => 'email',
            'options' => array(
                'label' => 'E-Mail',
            ),
        ));

        $submitElement = new Element\Button('submit');
        $submitElement
            ->setLabel('Request new password')
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
