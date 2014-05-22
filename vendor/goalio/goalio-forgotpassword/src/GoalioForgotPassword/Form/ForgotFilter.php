<?php

namespace GoalioForgotPassword\Form;

use Zend\InputFilter\InputFilter;
use GoalioForgotPassword\Options\ForgotOptionsInterface;

class ForgotFilter extends InputFilter
{
    /**
     * @var ForgotOptionsInterface
     */
    protected $options;

    public function __construct( $emailValidator, ForgotOptionsInterface $options)
    {
        $this->setOptions($options);
        $this->emailValidator = $emailValidator;

        $this->add(array(
            'name'       => 'email',
            'required'   => true,
            'validators' => array(
                array(
                    'name' => 'EmailAddress'
                )
            ),
        ));

        if($this->options->getValidateExistingRecord()){
            $this->add(array(
	            'name'       => 'email',
	            'validators' => array(
	            	$this->emailValidator
	            ),
	        ));
        }
    }

    /**
     * set options
     *
     * @param RegistrationOptionsInterface $options
     */
    public function setOptions(ForgotOptionsInterface $options)
    {
        $this->options = $options;
    }

    /**
     * get options
     *
     * @return RegistrationOptionsInterface
     */
    public function getOptions()
    {
        return $this->options;
    }

}
