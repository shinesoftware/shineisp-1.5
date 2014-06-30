<?php
namespace CustomerAdmin\Form;
use Zend\InputFilter\InputFilter;

class CustomerFilter extends InputFilter
{

    public function __construct ()
    {
    	$this->add(array (
    			'name' => 'firstname',
    			'required' => true,
    			'filters' => array(
    					array('name' => 'Null'),
    					array('name' => 'StringTrim'),
    			)
    	));
    	
    	$this->add(array (
    			'name' => 'lastname',
    			'required' => true,
    			'filters' => array(
    					array('name' => 'Null'),
    					array('name' => 'StringTrim'),
    			)
    	));
    	
    	$this->add(array (
    			'name' => 'birthdate',
    			'required' => false,
    			'filters' => array(
    					array('name' => 'Null'),
    					array('name' => 'StringTrim'),
    			)
    	));
    	
    	$this->add(array (
    			'name' => 'birthplace',
    			'required' => false,
    			'filters' => array(
    					array('name' => 'Null'),
    					array('name' => 'StringTrim'),
    			)
    	));
    	
    	$this->add(array (
    			'name' => 'birthdistrict',
    			'required' => false,
    			'filters' => array(
    					array('name' => 'Null'),
    					array('name' => 'StringTrim'),
    			)
    	));
    	
    	$this->add(array (
    			'name' => 'birthnationality',
    			'required' => false,
    			'filters' => array(
    					array('name' => 'Null'),
    					array('name' => 'StringTrim'),
    			)
    	));
    	
    	$this->add(array (
    			'name' => 'taxpayernumber',
    			'required' => false,
    			'filters' => array(
    					array('name' => 'Null'),
    					array('name' => 'StringTrim'),
    			)
    	));
    	
    	$this->add(array (
    			'name' => 'legalform_id',
    			'required' => false,
    			'filters' => array(
    					array('name' => 'Null'),
    			)
    	));
    	
    	$this->add(array (
    			'name' => 'contacttype',
    			'required' => false,
    			'filters' => array(
    					array('name' => 'Null'),
    			)
    	));
    	
    	$this->add(array (
    			'name' => 'type_id',
    			'required' => false,
    			'filters' => array(
    					array('name' => 'Null'),
    			)
    	));
    	
    	$this->add(
    			array(
    					'type' => 'Zend\InputFilter\FileInput',
    					'name' => 'file',
    					'required' => false,
    					'validators' => array(
    							array(
    									'name' => 'File\UploadFile',
    									'filesize' => array('max' => 204800),
    									'filemimetype' => array('mimeType' => 'application/pdf'),
    							),
    					),
    					'filters' => array(
    							array(
    									'name' => 'File\RenameUpload',
    									'options' => array(
    											'target' => PUBLIC_PATH . '/documents/customers/',
    											'overwrite' => true,
    											'use_upload_name' => true,
    									),
    							),
    					),
    			)
    	);
    }
}