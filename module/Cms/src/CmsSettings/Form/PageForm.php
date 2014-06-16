<?php
namespace CmsSettings\Form;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use \Cms\Hydrator\Strategy\DateTimeStrategy;

class PageForm extends Form
{

    public function init ()
    {
//         $hydrator = new ClassMethods;

        $this->setAttribute('method', 'post');
//         $this->setHydrator($hydrator)->setObject(new \Base\Entity\Settings());
        
        $this->add(array (
                'type' => 'Zend\Form\Element\Select',
                'name' => 'defaultlayout',
                'attributes' => array (
                        'class' => 'form-control'
                ),
                'options' => array (
                        'label' => _('Visible'),
                        'value_options' => array (
                        		'1column' => _('1 Column'),
                        		'2column-left' => _('2 Columns Left'),
                        		'2column-right' => _('2 Columns Right'),
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
                'name' => 'submit', 
                'attributes' => array ( 
                        'type' => 'submit', 
                        'class' => 'btn btn-success', 
                        'value' => _('Save')
                )
        ));
     
    }
}