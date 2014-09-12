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
* @package Products
* @subpackage Entity
* @author Michelangelo Turillo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Turillo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/

namespace Product\Entity;

use DateTime; 
use Zend\Stdlib\ArrayObject as ArrayObject;

class Product implements ProductInterface {

    public $id;
    public $uid;
    public $type_id;
    public $attribute_set_id;
    public $attributes;
    public $createdat;
    public $updatedat;

    /**
     * Returns all the properties of this entity
     * 
     * @return array
     */
    public function getArrayCopy()
    {
        return array_merge(get_object_vars($this), array('attributes' => $this->attributes->getArrayCopy()));
    }
    
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
	 * @return the $uid
	 */
	public function getUid() {
		return $this->uid;
	}

	/**
	 * @param field_type $uid
	 */
	public function setUid($uid) {
		$this->uid = $uid;
	}

	/**
	 * @return the $type_id
	 */
	public function getTypeId() {
		return $this->type_id;
	}

	/**
	 * @param field_type $type_id
	 */
	public function setTypeId($type_id) {
		$this->type_id = $type_id;
	}

	/**
     * @return the $attribute_set_id
     */
    public function getAttributeSetId ()
    {
        return $this->attribute_set_id;
    }

	/**
     * @param field_type $attribute_set_id
     */
    public function setAttributeSetId ($attribute_set_id)
    {
        $this->attribute_set_id = $attribute_set_id;
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
	public function setAttributes(ArrayObject $attributes) {
		$this->attributes = $attributes;
	}

	/**
	 * @return the $createdat
	 */
	public function getCreatedat() {
		return $this->createdat;
	}

	/**
	 * @param field_type $createdat
	 */
	public function setCreatedat(DateTime $createdat = null) {
		$this->createdat = $createdat;
	}

	/**
	 * @return the $updatedat
	 */
	public function getUpdatedat() {
		return $this->updatedat;
	}

	/**
	 * @param field_type $updatedat
	 */
	public function setUpdatedat(DateTime $updatedat = null) {
		$this->updatedat = $updatedat;
	}

    

}