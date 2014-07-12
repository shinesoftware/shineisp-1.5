<?php
namespace ProductAdmin\Form\Fieldset;

use Product\Entity\ProductAttributes;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethods;

class AttributesFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function init ()
    {
        
        $this->setHydrator(new ClassMethods(true))
        	 ->setObject(new ProductAttributes());
        
        $this->add ( array ('type' => 'ProductAdmin\Form\Element\Attributes', 
        					'name' => 'items', 
        					'attributes' => array (
        									'multiple' => 'multiple', 
        									'class' => 'form-control' ), 
        					'options' => array ( 
        									'label' => _ ( 'Attributes' ) 
        					) 
        				)	 
        		);
        
        $this->add(array ( 
                'name' => 'id', 
                'attributes' => array ( 
                        'type' => 'hidden'
                )
        ));
    }
    
    /**
     * @return array
     \*/
    public function getInputFilterSpecification()
    {
    	return array(
    			'name' => array('required' => false),
    	);
    }
}