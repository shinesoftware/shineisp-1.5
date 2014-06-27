<?php
namespace Customer\Entity;

class Contact implements ContactInterface
{
    public $id;
    public $contact;
    public $type_id;
    public $customer_id;

    /**
     * 
     * @param array $data
     */
    function exchangeArray ($data)
    {
        foreach ($data as $field => $value){
            $this->$field = (isset($value)) ? $value : null;
        }
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
	 * @return the $contact
	 */
	public function getContact() {
		return $this->contact;
	}

	/**
	 * @param field_type $contact
	 */
	public function setContact($contact) {
		$this->contact = $contact;
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
	 * @return the $customer_id
	 */
	public function getCustomerId() {
		return $this->customer_id;
	}

	/**
	 * @param field_type $customer_id
	 */
	public function setCustomerId($customer_id) {
		$this->customer_id = $customer_id;
	}

        
}