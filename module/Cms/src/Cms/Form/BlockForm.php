<?php
namespace Cms\Form;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use \Base\Hydrator\Strategy\DateTimeStrategy;

class BlockForm extends Form
{

    public function init ()
    {
        $hydrator = new ClassMethods;

        $this->setAttribute('method', 'post');
        $this->setHydrator($hydrator)->setObject(new \Cms\Entity\Block());
        
        $this->add(array ( 
                'name' => 'title', 
                'attributes' => array ( 
                        'type' => 'text', 
                        'class' => 'form-control',
                		'placeholder' => _('Write here the title of the page'),
                ), 
                'options' => array ( 
                        'label' => _('Title'),
                ), 
                'filters' => array ( 
                        array ( 
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        $this->add(array ( 
        		'type' => 'Base\Form\Element\Languages',
                'name' => 'language_id', 
                'attributes' => array ( 
                        'class' => 'form-control',
                ), 
                'options' => array ( 
                        'label' => _('Language'),
                ), 
        ));
        
        $this->add(array ( 
                'name' => 'placeholder', 
                'attributes' => array ( 
                        'type' => 'text', 
                        'class' => 'form-control',
                		'placeholder' => _('Write here the placeholder for identify the block. If empty it will be created automatically.'),
                ), 
                'options' => array ( 
                        'label' => _('Placeholder'),
                ), 
                'filters' => array ( 
                        array ( 
                                'name' => 'StringTrim'
                        )
                )
        ));
        
        $this->add(array ( 
                'name' => 'content', 
                'attributes' => array ( 
                        'type' => 'textarea', 
                        'class' => 'form-control wysiwyg',
                        'rows' => 20,
                		'placeholder' => _('Add your html content'),
                ), 
                'options' => array ( 
                        'label' => _('Content'),
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