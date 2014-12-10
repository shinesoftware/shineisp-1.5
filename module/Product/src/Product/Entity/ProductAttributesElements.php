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
* * Neither the codes of the copyright holders nor the codes of the
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
* @package Products
* @subpackage Entity
* @author Michelangelo Turillo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Turillo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@ 
*/

namespace Product\Entity;

class ProductAttributesElements implements ProductAttributesElementsInterface {

    public $id;
    public $name;
    public $description;
    public $css;
    public $attributes;
    public $input_type;
     
    
    /**
     * This method get the array posted and assign the values to the table
     * object
     *
     * @param array $data
     */
    public function exchangeArray ($data)
    {
    	foreach ($data as $field => $value) {
    		$this->$field = (isset($value)) ? $value : null;
    	}
    
    	return true;
    }
    
	/**
     * @return the $id
     */
    public function getId() {
        return $this->id;
    }

	/**
     * @param field_type $id
     */
    public function setId($id) {
        $this->id = $id;
    }

	/**
     * @return the $name
     */
    public function getName() {
        return $this->name;
    }

	/**
     * @param field_type $name
     */
    public function setName($name) {
        $this->name = $name;
    }

	/**
     * @return the $description
     */
    public function getDescription() {
        return $this->description;
    }

	/**
     * @param field_type $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

	/**
     * @return the $css
     */
    public function getCss() {
        return $this->css;
    }

	/**
     * @param field_type $css
     */
    public function setCss($css) {
        $this->css = $css;
    }

	/**
     * @return the $attributes
     */
    public function getAttributes() {
        return $this->attributes;
    }

	/**
     * @param field_type $attributes
     */
    public function setAttributes($attributes) {
        $this->attributes = $attributes;
    }

	/**
     * @return the $input_type
     */
    public function getInputType() {
        return $this->input_type;
    }

	/**
     * @param field_type $input_type
     */
    public function setInputType($input_type) {
        $this->input_type = $input_type;
    }

    
}