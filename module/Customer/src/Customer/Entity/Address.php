<?php
namespace Customer\Entity;

class Address
{
    public $id;
    public $street;
    public $code;
    public $city;
    public $country_id;
    public $region_id;
    public $latitude;
    public $longitude;
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
	 * @return the $region_id
	 */
	public function getRegionId() {
		return $this->region_id;
	}

	/**
	 * @param field_type $region_id
	 */
	public function setRegionId($region_id) {
		$this->region_id = $region_id;
	}

	/**
     * @return the $id
     */
    public function getId ()
    {
        return $this->id;
    }

	/**
     * @return the $street
     */
    public function getStreet ()
    {
        return $this->street;
    }

	/**
     * @return the $code
     */
    public function getCode ()
    {
        return $this->code;
    }

	/**
     * @return the $city
     */
    public function getCity ()
    {
        return $this->city;
    }

	/**
     * @return the $country_id
     */
    public function getCountryId ()
    {
        return $this->country_id;
    }

	/**
     * @return the $latitude
     */
    public function getLatitude ()
    {
        return $this->latitude;
    }

	/**
     * @return the $longitude
     */
    public function getLongitude ()
    {
        return $this->longitude;
    }

	/**
     * @param field_type $id
     */
    public function setId ($id)
    {
        $this->id = $id;
    }

	/**
     * @param field_type $street
     */
    public function setStreet ($street)
    {
        $this->street = $street;
    }

	/**
     * @param field_type $code
     */
    public function setCode ($code)
    {
        $this->code = $code;
    }

	/**
     * @param field_type $city
     */
    public function setCity ($city)
    {
        $this->city = $city;
    }

	/**
     * @param field_type $country_id
     */
    public function setCountryId ($country_id)
    {
        $this->country_id = $country_id;
    }

	/**
     * @param field_type $latitude
     */
    public function setLatitude ($latitude)
    {
        $this->latitude = $latitude;
    }

	/**
     * @param field_type $longitude
     */
    public function setLongitude ($longitude)
    {
        $this->longitude = $longitude;
    }
	
	/**
     * @return the $customer_id
     */
    public function getCustomerId ()
    {
        return $this->customer_id;
    }

	/**
     * @param field_type $customer_id
     */
    public function setCustomerId ($customer_id)
    {
        $this->customer_id = $customer_id;
    }

}