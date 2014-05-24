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
* @package Cms
* @subpackage Entity
* @author Michelangelo Tslugllo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Tslugllo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/

namespace Cms\Entity;
use DateTime;

class Page implements PageInterface {

    public $id;
    public $title;
    public $slug;
    public $content;
    public $visible;
    public $category_id;
    public $language_id;
    public $parent_id;
    public $tags;
    public $createdat;
    public $updatedat;
    
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
	 * @return the $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param field_type $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return the $slug
	 */
	public function getSlug() {
		return $this->slug;
	}

	/**
	 * @param field_type $slug
	 */
	public function setSlug($slug) {
		$this->slug = $slug;
	}

	/**
	 * @return the $content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param field_type $content
	 */
	public function setContent($content) {
		$this->content = $content;
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
	public function setCreatedat(DateTime $createdat = NULL) {
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
	public function setUpdatedat(DateTime $updatedat = NULL) {
		$this->updatedat = $updatedat;
	}

	/**
	 * @return the $visible
	 */
	public function getVisible() {
		return $this->visible;
	}

	/**
	 * @param field_type $visible
	 */
	public function setVisible($visible) {
		$this->visible = $visible;
	}

	/**
	 * @return the $category_id
	 */
	public function getCategoryId() {
		return $this->category_id;
	}

	/**
	 * @return the $language_id
	 */
	public function getLanguageId() {
		return $this->language_id;
	}

	/**
	 * @param field_type $language_id
	 */
	public function setLanguageId($language_id) {
		$this->language_id = $language_id;
	}

	/**
	 * @param field_type $category_id
	 */
	public function setCategoryId($category_id) {
		$this->category_id = $category_id;
	}

	/**
	 * @return the $tags
	 */
	public function getTags() {
		return $this->tags;
	}

	/**
	 * @param field_type $tags
	 */
	public function setTags($tags) {
		$this->tags = $tags;
	}
	/**
	 * @return the $parent_id
	 */
	public function getParentId() {
		return $this->parent_id;
	}

	/**
	 * @param field_type $parent_id
	 */
	public function setParentId($parent_id) {
		$this->parent_id = $parent_id;
	}


}