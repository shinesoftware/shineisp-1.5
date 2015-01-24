<?php
namespace BaseSettings\Form;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use \Base\Hydrator\Strategy\DateTimeStrategy;

class GenericForm extends Form
{

    public function init ()
    {

        $this->setAttribute('method', 'post');
        
        $this->add(array (
                'type' => 'Zend\Form\Element\Select',
                'name' => 'active',
                'attributes' => array (
                        'class' => 'form-control'
                ),
                'options' => array (
                        'label' => _('Active'),
                        'value_options' => array (
                                '1' => _('Yes, this website is active'),
                                '0' => _('No, it is on maintainance mode'),
                        )
                )
        ));
        
        $this->add(array (
                'type' => 'Zend\Form\Element\Select',
                'name' => 'iscompressed',
                'attributes' => array (
                        'class' => 'form-control'
                ),
                'options' => array (
                        'label' => _('Is HTML code compressed?'),
                        'value_options' => array (
                                '1' => _('Yes, compress the html content of the page'),
                                '0' => _('No, it is not'),
                        )
                )
        ));
        
        $this->add(array (
                'name' => 'name',
                'attributes' => array (
                        'class' => 'form-control',
                		'value' => 'My application'
                ),
                'options' => array (
                        'label' => _('Name'),
                )
        ));
        
        $this->add(array (
                'name' => 'email',
                'attributes' => array (
                        'class' => 'form-control',
                ),
                'options' => array (
                        'label' => _('Email'),
                )
        ));
        
        $this->add(array (
                'name' => 'slogan',
                'attributes' => array (
                        'class' => 'form-control',
                ),
                'options' => array (
                        'label' => _('Slogan'),
                )
        ));
        
        $this->add(array (
                'name' => 'metatitle',
                'attributes' => array (
                        'class' => 'form-control',
                ),
                'options' => array (
                        'label' => _('META Title'),
                )
        ));
        
        $this->add(array (
                'name' => 'metadescription',
                'attributes' => array (
                        'type' => 'textarea',
                        'class' => 'form-control',
                ),
                'options' => array (
                        'label' => _('META Description'),
                )
        ));
        
        $this->add(array (
                'name' => 'metakeywords',
                'attributes' => array (
                        'type' => 'textarea',
                        'class' => 'form-control',
                ),
                'options' => array (
                        'label' => _('META Keywords'),
                )
        ));
        
        $this->add(array (
                'name' => 'headscript',
                'attributes' => array (
                        'type' => 'textarea',
                        'class' => 'form-control',
                ),
                'options' => array (
                        'label' => _('Inject the script in the HTML head section'),
                )
        ));
        
        $this->add(array (
                'name' => 'bodyscript',
                'attributes' => array (
                        'type' => 'textarea',
                        'class' => 'form-control',
                ),
                'options' => array (
                        'label' => _('Inject the script in the HTML body section'),
                )
        ));
        
        $this->add(array (
                'name' => 'ganalytics',
                'attributes' => array (
                        'type' => 'textarea',
                        'class' => 'form-control',
                ),
                'options' => array (
                        'label' => 'Google Analytics Code',
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