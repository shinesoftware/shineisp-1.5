<?php
namespace CmsSettings\Form;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use \Base\Hydrator\Strategy\DateTimeStrategy;

class PageForm extends Form
{

    public function init ()
    {

        $this->setAttribute('method', 'post');
        
        $this->add(array (
                'type' => 'Zend\Form\Element\Select',
                'name' => 'defaultlayout',
                'attributes' => array (
                        'class' => 'form-control'
                ),
                'options' => array (
                        'label' => _('Default Layout'),
                        'value_options' => array (
                        		'1column' => _('1 Column'),
                        		'2columns-left' => _('2 Columns Left'),
                        		'2columns-right' => _('2 Columns Right'),
                        )
                )
        ));
        
        $this->add(array (
                'name' => 'postperpage',
                'attributes' => array (
                        'class' => 'form-control',
                		'value' => 5
                ),
                'options' => array (
                        'label' => _('Post per page'),
                )
        ));
        
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