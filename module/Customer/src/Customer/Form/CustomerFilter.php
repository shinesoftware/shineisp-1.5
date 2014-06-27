<?php
namespace Customer\Form;
use Zend\InputFilter\InputFilter;

class CustomerFilter extends InputFilter
{

    public function __construct ()
    {
    	$this->add(array (
    			'name' => 'firstname',
    			'required' => true
    	));
    	
    	$this->add(array (
    			'name' => 'lastname',
    			'required' => true
    	));
    	
    	$this->add(array (
    			'name' => 'legalform_id',
    			'required' => false
    	));
    	
    	$this->add(array (
    			'name' => 'type_id',
    			'required' => false
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