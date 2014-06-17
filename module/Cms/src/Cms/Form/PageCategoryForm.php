<?php
namespace Cms\Form;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use \Base\Hydrator\Strategy\DateTimeStrategy;

class PageCategoryForm extends Form
{

    public function init ()
    {
        $hydrator = new ClassMethods;

        $this->setAttribute('method', 'post');
        $this->setHydrator($hydrator)->setObject(new \Cms\Entity\PageCategory());
        
        $this->add(array ( 
                'name' => 'category', 
                'attributes' => array ( 
                        'type' => 'text', 
                        'class' => 'form-control',
                		'placeholder' => _('Write here the category name'),
                ), 
                'options' => array ( 
                        'label' => _('Category'),
                ), 
                'filters' => array ( 
                        array ( 
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        $this->add(array (
                'type' => 'Zend\Form\Element\Select',
                'name' => 'visible',
                'attributes' => array (
                        'class' => 'form-control'
                ),
                'options' => array (
                        'label' => _('Visible'),
                        'value_options' => array (
                        		'1' => _('Visible'),
                        		'0' => _('Not Visible'),
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