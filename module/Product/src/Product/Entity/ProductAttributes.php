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

class ProductAttributes implements ProductAttributesInterface {

    public $id;
    public $code;
    public $type;
    public $input;
    public $label;
    public $source_model;
    public $filters;
    public $is_required;
    public $is_user_defined;
    
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
	 * @return the $code
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * @param field_type $code
	 */
	public function setCode($code) {
		$this->code = $code;
	}
	/**
     * @return the $type
     */
    public function getType ()
    {
        return $this->type;
    }

	/**
     * @param field_type $type
     */
    public function setType ($type)
    {
        $this->type = $type;
    }

	/**
	 * @return the $input
	 */
	public function getInput() {
		return $this->input;
	}

	/**
	 * @param field_type $input
	 */
	public function setInput($input) {
		$this->input = $input;
	}

	/**
     * @return the $label
     */
    public function getLabel ()
    {
        return $this->label;
    }

	/**
     * @param field_type $label
     */
    public function setLabel ($label)
    {
        $this->label = $label;
    }

	/**
     * @return the $source_model
     */
    public function getSourceModel ()
    {
        return $this->source_model;
    }

	/**
     * @param field_type $source_model
     */
    public function setSourceModel ($source_model)
    {
        $this->source_model = $source_model;
    }

	/**
	 * @return the $filters
	 */
	public function getFilters() {
		return $this->filters;
	}

	/**
	 * @param field_type $filters
	 */
	public function setFilters($filters) {
		$this->filters = $filters;
	}

	/**
     * @return the $is_required
     */
    public function getIsRequired ()
    {
        return $this->is_required;
    }

	/**
     * @param field_type $is_required
     */
    public function setIsRequired ($is_required)
    {
        $this->is_required = $is_required;
    }

	/**
     * @return the $is_user_defined
     */
    public function getIsUserDefined ()
    {
        return $this->is_user_defined;
    }

	/**
     * @param field_type $is_user_defined
     */
    public function setIsUserDefined ($is_user_defined)
    {
        $this->is_user_defined = $is_user_defined;
    }

}