<?php
namespace DisqusSettings\Form;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use \Base\Hydrator\Strategy\DateTimeStrategy;

class DisqusForm extends Form
{

    public function init ()
    {

        $this->setAttribute('method', 'post');

        $this->add(array (
                'name' => 'shortname',
                'attributes' => array (
                        'class' => 'form-control',
                		'placeholder' => _('Type here your Discus account name')
                ),
                'options' => array (
                        'label' => _('Discus Shortname'),
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
     
    }
}