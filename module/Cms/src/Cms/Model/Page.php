<?php
namespace Cms\Model;

class Page
{

    public $id;
    public $title;
    public $uri;
    public $content;
    public $visible;
    public $category_id;
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
	 * @return the $uri
	 */
	public function getUri() {
		return $this->uri;
	}

	/**
	 * @param field_type $uri
	 */
	public function setUri($uri) {
		$this->uri = $uri;
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
	public function setCreatedat($createdat) {
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
	public function setUpdatedat($updatedat) {
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