<?php
namespace Base\Form;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class LanguagesForm extends Form
{

    public function init ()
    {
        $hydrator = new ClassMethods;

        $this->setAttribute('method', 'post');
        $this->setHydrator($hydrator)->setObject(new \Base\Model\Languages());
        
        $this->add(array ( 
                'name' => 'language', 
                'attributes' => array ( 
                        'type' => 'text', 
                        'class' => 'form-control',
                		'placeholder' => _('Write here the language name'),
                ), 
                'options' => array ( 
                        'label' => _('Language'),
                ), 
                'filters' => array ( 
                        array ( 
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        $this->add(array ( 
                'name' => 'code', 
                'attributes' => array ( 
                        'type' => 'text', 
                        'class' => 'form-control',
                		'placeholder' => _('Add the language code eg. it'),
                ), 
                'options' => array ( 
                        'label' => _('Code'),
                ), 
                'filters' => array ( 
                        array ( 
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        $this->add(array ( 
                'name' => 'locale', 
                'attributes' => array ( 
                        'type' => 'text', 
                        'class' => 'form-control',
                		'placeholder' => _('Add the locale eg. it_IT'),
                ), 
                'options' => array ( 
                        'label' => _('Locale'),
                ), 
                'filters' => array ( 
                        array ( 
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        $this->add(array (
                'type' => 'Zend\Form\Element\Select',
                'name' => 'base',
                'attributes' => array (
                        'class' => 'form-control'
                ),
                'options' => array (
                        'label' => _('Base'),
                        'value_options' => array (
                        		'1' => _('Yes, this is the main site language'),
                        		'0' => _('No, it is not'),
                        )
                )
        ));
        
        $this->add(array (
                'type' => 'Zend\Form\Element\Select',
                'name' => 'active',
                'attributes' => array (
                        'class' => 'form-control'
                ),
                'options' => array (
                        'label' => _('Active'),
                        'value_options' => array (
                        		'1' => _('Yes, this language is active'),
                        		'0' => _('No, it is hidden'),
                        )
                )
        ));
        
        $this->add(array ( 
                'name' => 'submit', 
                'attributes' => array ( 
                        'type' => 'submit', 
                        'class' => 'btn btn-success', 
                        'value' => _('Save')
                )
        ));
        $this->add(array (
                'name' => 'id',
                'attributes' => array (
                        'type' => 'hidden'
                )
        ));
    }
}