<?php
/**
* Copyright (c) 2014 Shine Software.
* All rights reserved.
*
* Redistribution and use in source and binary forms, with or without
* modification, are permitted provided that the following conditions
* are met:
*
* * Redistributions of source code must retain the above copyright
* notice, this list of conditions and the following disclaimer.
*
* * Redistributions in binary form must reproduce the above copyright
* notice, this list of conditions and the following disclaimer in
* the documentation and/or other materials provided with the
* distribution.
*
* * Neither the names of the copyright holders nor the names of the
* contributors may be used to endorse or promote products derived
* from this software without specific prior written permission.
*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
* "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
* LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
* FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
* COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
* INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
* BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
* LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
* CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
* LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
* ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
* POSSIBILITY OF SUCH DAMAGE.
*
* @package Product
* @subpackage Form
* @author Michelangelo Turillo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Turillo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/

namespace ProductAdmin\Form;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use Base\Hydrator\Strategy\DateTimeStrategy;

class AttributesForm extends Form
{

    public function init ()
    {
        $hydrator = new ClassMethods();
        
        $this->setAttribute('method', 'post');
        $this->setHydrator($hydrator)->setObject(new \Product\Entity\ProductAttributes());
        
        $this->add(
                array('name' => 'name', 
                        'attributes' => array('type' => 'text', 
                                'class' => 'form-control'), 
                        'options' => array('label' => _('Name'))));
        
        $this->add(
                array('name' => 'label', 
                        'attributes' => array('type' => 'text', 
                                'class' => 'form-control'), 
                        'options' => array('label' => _('Label'))));
        
        $this->add(
                array('name' => 'source_model', 
                        'attributes' => array('type' => 'text', 
                                'class' => 'form-control'), 
                        'options' => array('label' => _('Source Model'))));
        
        $this->add(
                array('name' => 'css', 
                        'attributes' => array('type' => 'text', 
                                'class' => 'form-control'), 
                        'options' => array('label' => _('CSS Styles'))));
        
        $this->add(
                array('name' => 'is_required', 
                        'type' => 'Zend\Form\Element\Select', 
                        'attributes' => array('class' => 'form-control'), 
                        'options' => array('label' => _('Is Required'), 
                                'value_options' => array('0' => _('No'), 
                                        '1' => _('Yes')))));
        
        $this->add(
                array('name' => 'filters', 
                        'type' => 'Zend\Form\Element\Select', 
                        'attributes' => array('class' => 'form-control', 'multiple' => 'multiple'), 
                        'options' => array('label' => _('Filters'), 
                                'value_options' => array('int' => _('Integer numbers only'),
                                						 'stringtolower' => _('String to lower'),
                                        				 'stringtoupper' => _('String to upper'),
                                        				 'alpha' => _('Alphabetic characters only'),
                                        				 'cleanurl' => _('Url clean'),
                                		))));
        $this->add(
        		array('name' => 'filesize',
        				'attributes' => array('type' => 'text',
        						'class' => 'form-control'),
        				'options' => array('label' => _('File Size'))));
        
        $this->add(
        		array('name' => 'filetarget',
        				'attributes' => array('type' => 'text',
        						'class' => 'form-control'),
        				'options' => array('label' => _('Target directory'))));
        
        
        $this->add(
                array('name' => 'filemimetype', 
                        'type' => 'Zend\Form\Element\Select', 
                        'attributes' => array('class' => 'form-control', 'multiple' => 'multiple'), 
                        'options' => array('label' => _('Frontend Input type'), 
                                'value_options' => array('application/pdf' => _('Adobe PDF'),
                                						 'application/msword' => _('Microsoft Doc'),
                                						 'application/zip' => _('Zip Archive'),
                                						 'image/jpeg' => _('Jpg Image'),
                                						 'image/gif' => _('Gif Image'),
                                						 'image/png' => _('Png Image'),
                                        				 ))));
        
        $this->add(
                array('name' => 'input', 
                        'type' => 'Zend\Form\Element\Select', 
                        'attributes' => array('class' => 'form-control', 'id' => 'input'), 
                        'options' => array('label' => _('Frontend Input type'), 
                                'value_options' => array('text' => _('Text'),
                                						 'textarea' => _('Textarea'),
                                						 'file' => _('File'),
                                        				 'select' => _('Select')))));
        
        $this->add(
                array('name' => 'type', 
                        'type' => 'Zend\Form\Element\Select', 
                        'attributes' => array('class' => 'form-control'), 
                        'options' => array('label' => _('Type'), 
                                'value_options' => array('string' => _('String'),
                                						 'text' => _('Text'),
                                						 'integer' => _('Integer'),
                                        				 'float' => _('Decimal'),
                                        				 'datetime' => _('Datetime'),
                                        				 'date' => _('Date'),
                                		))));
        $this->add(
                array('name' => 'is_user_defined', 
                        'type' => 'Zend\Form\Element\Select', 
                        'attributes' => array('class' => 'form-control'), 
                        'options' => array('label' => _('Is User Defined'), 
                                'value_options' => array('0' => _('No'), 
                                        '1' => _('Yes')))));
        
        $this->add(
                array('name' => 'quick_search', 
                        'type' => 'Zend\Form\Element\Select', 
                        'attributes' => array('class' => 'form-control'), 
                        'options' => array('label' => _('Use in Quick Search'), 
                                'value_options' => array('0' => _('No'), 
                                        '1' => _('Yes')))));
        
        $this->add(
                array('name' => 'submit', 
                        'attributes' => array('type' => 'submit', 
                                'class' => 'btn btn-success', 
                                'value' => _('Save'))));
        $this->add(
                array('name' => 'id', 'attributes' => array('type' => 'hidden')));
    }
}