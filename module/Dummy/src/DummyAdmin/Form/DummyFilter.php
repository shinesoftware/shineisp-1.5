<?php
namespace DummyAdmin\Form;
use Zend\InputFilter\InputFilter;

class DummyFilter extends InputFilter
{

    public function __construct ()
    {
    	$this->add(array (
    			'name' => 'name',
    			'required' => true,
    			'filters' => array(
    					array('name' => 'Null'),
    					array('name' => 'StringTrim'),
    			)
    	));
    	
    	
//     	$this->add(
//     			array(
//     					'type' => 'Zend\InputFilter\FileInput',
//     					'name' => 'file',
//     					'required' => false,
//     					'validators' => array(
//     							array(
//     									'name' => 'File\UploadFile',
//     									'filesize' => array('max' => 204800),
//     									'filemimetype' => array('mimeType' => 'application/pdf'),
//     							),
//     					),
//     					'filters' => array(
//     							array(
//     									'name' => 'File\RenameUpload',
//     									'options' => array(
//     											'target' => PUBLIC_PATH . '/documents/dummys/',
//     											'overwrite' => true,
//     											'use_upload_name' => true,
//     									),
//     							),
//     					),
//     			)
//     	);
    }
}