<?php
namespace Cms\Form;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use \Base\Hydrator\Strategy\DateTimeStrategy;

class PageForm extends Form
{

    public function init ()
    {
        $hydrator = new ClassMethods;

        $this->setAttribute('method', 'post');
        $this->setHydrator($hydrator)->setObject(new \Cms\Entity\Page());
        
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
        		'type' => 'Cms\Form\Element\PageCategories',
        		'name' => 'category_id',
        		'attributes' => array (
        				'class' => 'form-control'
        		),
        		'options' => array (
        				'label' => _('Category')
        		)
        ));
        
        $this->add(array (
        		'type' => 'Cms\Form\Element\ParentPages',
        		'name' => 'parent_id',
        		'attributes' => array (
        				'class' => 'form-control'
        		),
        		'options' => array (
        				'label' => _('Parent page')
        		)
        ));
        
        $this->add(array ( 
                'name' => 'slug', 
                'attributes' => array ( 
                        'type' => 'text', 
                        'class' => 'form-control',
                		'placeholder' => _('Write here the url key of the page'),
                ), 
                'options' => array ( 
                        'label' => _('Slug'),
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
                        'rows' => 40,
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
        		'name' => 'tags',
        		'attributes' => array (
        				'type' => 'text',
        				'class' => 'form-control',
        				'data-role' => 'tagsinput',
        				'placeholder' => _('Add tags'),
        		),
        		'options' => array (
        				'label' => _('Tags'),
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
                'type' => 'Zend\Form\Element\Select',
                'name' => 'showonlist',
                'attributes' => array (
                        'class' => 'form-control'
                ),
                'options' => array (
                        'label' => _('Show on list'),
                        'value_options' => array (
                        		'1' => _('Yes'),
                        		'0' => _('No'),
                        )
                )
        ));
        
        $this->add(array (
        		'name' => 'layout',
        		'attributes' => array (
        				'type' => 'textarea',
        				'class' => 'form-control',
        				'placeholder' => _('Write here the xml layout update'),
        				'rows' => '15',
        		),
        		'options' => array (
        				'label' => _('Layout'),
        				
        		),
        		'filters' => array (
        				array (
        						'name' => 'StringTrim'
        				)
        		)
        ));
        
        $this->add(array (
        		'name' => 'metatitle',
        		'attributes' => array (
        				'type' => 'text',
        				'class' => 'form-control',
        				'placeholder' => _('Write here the title of the page'),
        		),
        		'options' => array (
        				'label' => _('Meta Title'),
        				
        		),
        		'filters' => array (
        				array (
        						'name' => 'StringTrim'
        				)
        		)
        ));
        
        $this->add(array (
        		'name' => 'metadescription',
        		'attributes' => array (
        				'type' => 'textarea',
        				'class' => 'form-control',
        				'placeholder' => _('Write here the meta description'),
        				'rows' => '15',
        		),
        		'options' => array (
        				'label' => _('Meta Description'),
        				
        		),
        		'filters' => array (
        				array (
        						'name' => 'StringTrim'
        				)
        		)
        ));
        
        $this->add(array (
        		'name' => 'metakeywords',
        		'attributes' => array (
        				'type' => 'text',
        				'class' => 'form-control',
        				'placeholder' => _('Write here the meta keyword of the page'),
        		),
        		'options' => array (
        				'label' => _('Meta keywords'),
        				
        		),
        		'filters' => array (
        				array (
        						'name' => 'StringTrim'
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