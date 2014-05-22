<?php
namespace Cms\Model;

class PageCategory
{

    public $id;
    public $category;
    public $visible;
    
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
	 * @return the $category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * @param field_type $category
	 */
	public function setCategory($category) {
		$this->category = $category;
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


}