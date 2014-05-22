<?php
namespace Base\Model;

class Languages
{

    public $id;
    public $language;
    public $locale;
    public $code;
    public $base;
    public $active;
    
    
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
	 * @return the $language
	 */
	public function getLanguage() {
		return $this->language;
	}

	/**
	 * @param field_type $language
	 */
	public function setLanguage($language) {
		$this->language = $language;
	}

	/**
	 * @return the $locale
	 */
	public function getLocale() {
		return $this->locale;
	}

	/**
	 * @param field_type $locale
	 */
	public function setLocale($locale) {
		$this->locale = $locale;
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
	 * @return the $base
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * @param field_type $base
	 */
	public function setBase($base) {
		$this->base = $base;
	}

	/**
	 * @return the $active
	 */
	public function getActive() {
		return $this->active;
	}

	/**
	 * @param field_type $active
	 */
	public function setActive($active) {
		$this->active = $active;
	}

    

}