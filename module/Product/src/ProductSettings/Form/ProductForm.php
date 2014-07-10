<?php
namespace ProductSettings\Form;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use \Base\Hydrator\Strategy\DateTimeStrategy;

class ProductForm extends Form
{

    public function init ()
    {

        $this->setAttribute('method', 'post');
        
        $this->add(array (
                'name' => 'recordsperpage',
                'attributes' => array (
                        'class' => 'form-control',
                		'value' => 5
                ),
                'options' => array (
                        'label' => _('Records per page for the admin grid'),
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