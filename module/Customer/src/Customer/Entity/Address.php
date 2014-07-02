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
 * @package Customer
 * @subpackage Entity
 * @author Michelangelo Turillo <mturillo@shinesoftware.com>
 * @copyright 2014 Michelangelo Turillo.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @link http://shinesoftware.com
 * @version @@PACKAGE_VERSION@@
 */

namespace Customer\Entity;

class Address implements AddressInterface
{
    public $id;
    public $street;
    public $code;
    public $city;
    public $country_id;
    public $region_id;
    public $province_id;
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
     * @return the $province_id
     */
    public function getProvinceId() {
    	return $this->province_id;
    }
    
    /**
     * @param field_type $province_id
     */
    public function setProvinceId($province_id) {
    	$this->province_id = $province_id;
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