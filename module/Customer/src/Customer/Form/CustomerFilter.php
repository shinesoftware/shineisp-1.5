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
    			'name' => 'legalform_id',
    			'required' => false
    	));
    	
    	$this->add(array (
    			'name' => 'type_id',
    			'required' => false
    	));
    	
    	// File Input
    	$fileInput = new \Zend\InputFilter\FileInput('file');
    	$fileInput->getFilterChain()->attachByName(
    			'filerenameupload',
    			array(
    					'use_upload_name' => true,
    					'overwrite' => true,
    					'target'    => PUBLIC_PATH . '/documents/customers/',
    			)
    	);
    	
    	$fileInput->getValidatorChain()
		    	->attachByName('filesize',      array('max' => 204800))
		    	->attachByName('filemimetype',  array('mimeType' => 'application/pdf'));
    	
    	$this->add($fileInput);
    	
    	
    }
}