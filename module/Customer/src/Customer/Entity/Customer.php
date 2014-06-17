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
* @author Michelangelo Tslugllo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Tslugllo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/

namespace Customer\Entity;
use DateTime;

class Customer implements CustomerInterface {

    public $id;
    public $uid;
    public $company;
    public $firstname;
    public $lastname;
    public $gender;
    public $email;
    public $birthdate;
    public $birthplace;
    public $birthdistrict;
    public $birthcountry;
    public $birthnationality;
    public $taxpayernumber;
    public $vat;
    public $type_id;
    public $parent_id;
    public $legalform_id;
    public $note;
    public $status_id;
    public $group_id;
    public $language_id;
    public $issubscriber;
    public $taxfree;
    public $isreseller;
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
	 * @return the $company
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * @param field_type $company
	 */
	public function setCompany($company) {
		$this->company = $company;
	}

	/**
	 * @return the $firstname
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * @param field_type $firstname
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	/**
	 * @return the $lastname
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * @param field_type $lastname
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}

	/**
	 * @return the $gender
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * @param field_type $gender
	 */
	public function setGender($gender) {
		$this->gender = $gender;
	}

	/**
	 * @return the $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param field_type $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @return the $birthdate
	 */
	public function getBirthdate() {
		return $this->birthdate;
	}

	/**
	 * @param field_type $birthdate
	 */
	public function setBirthdate($birthdate) {
		$this->birthdate = $birthdate;
	}

	/**
	 * @return the $birthplace
	 */
	public function getBirthplace() {
		return $this->birthplace;
	}

	/**
	 * @param field_type $birthplace
	 */
	public function setBirthplace($birthplace) {
		$this->birthplace = $birthplace;
	}

	/**
	 * @return the $birthdistrict
	 */
	public function getBirthdistrict() {
		return $this->birthdistrict;
	}

	/**
	 * @param field_type $birthdistrict
	 */
	public function setBirthdistrict($birthdistrict) {
		$this->birthdistrict = $birthdistrict;
	}

	/**
	 * @return the $birthcountry
	 */
	public function getBirthcountry() {
		return $this->birthcountry;
	}

	/**
	 * @param field_type $birthcountry
	 */
	public function setBirthcountry($birthcountry) {
		$this->birthcountry = $birthcountry;
	}

	/**
	 * @return the $birthnationality
	 */
	public function getBirthnationality() {
		return $this->birthnationality;
	}

	/**
	 * @param field_type $birthnationality
	 */
	public function setBirthnationality($birthnationality) {
		$this->birthnationality = $birthnationality;
	}

	/**
	 * @return the $taxpayernumber
	 */
	public function getTaxpayernumber() {
		return $this->taxpayernumber;
	}

	/**
	 * @param field_type $taxpayernumber
	 */
	public function setTaxpayernumber($taxpayernumber) {
		$this->taxpayernumber = $taxpayernumber;
	}

	/**
	 * @return the $vat
	 */
	public function getVat() {
		return $this->vat;
	}

	/**
	 * @param field_type $vat
	 */
	public function setVat($vat) {
		$this->vat = $vat;
	}

	/**
	 * @return the $type_id
	 */
	public function getType_id() {
		return $this->type_id;
	}

	/**
	 * @param field_type $type_id
	 */
	public function setType_id($type_id) {
		$this->type_id = $type_id;
	}

	/**
	 * @return the $parent_id
	 */
	public function getParent_id() {
		return $this->parent_id;
	}

	/**
	 * @param field_type $parent_id
	 */
	public function setParent_id($parent_id) {
		$this->parent_id = $parent_id;
	}

	/**
	 * @return the $legalform_id
	 */
	public function getLegalform_id() {
		return $this->legalform_id;
	}

	/**
	 * @param field_type $legalform_id
	 */
	public function setLegalform_id($legalform_id) {
		$this->legalform_id = $legalform_id;
	}

	/**
	 * @return the $note
	 */
	public function getNote() {
		return $this->note;
	}

	/**
	 * @param field_type $note
	 */
	public function setNote($note) {
		$this->note = $note;
	}

	/**
	 * @return the $status_id
	 */
	public function getStatus_id() {
		return $this->status_id;
	}

	/**
	 * @param field_type $status_id
	 */
	public function setStatus_id($status_id) {
		$this->status_id = $status_id;
	}

	/**
	 * @return the $group_id
	 */
	public function getGroup_id() {
		return $this->group_id;
	}

	/**
	 * @param field_type $group_id
	 */
	public function setGroup_id($group_id) {
		$this->group_id = $group_id;
	}

	/**
	 * @return the $language_id
	 */
	public function getLanguage_id() {
		return $this->language_id;
	}

	/**
	 * @param field_type $language_id
	 */
	public function setLanguage_id($language_id) {
		$this->language_id = $language_id;
	}

	/**
	 * @return the $issubscriber
	 */
	public function getIssubscriber() {
		return $this->issubscriber;
	}

	/**
	 * @param field_type $issubscriber
	 */
	public function setIssubscriber($issubscriber) {
		$this->issubscriber = $issubscriber;
	}

	/**
	 * @return the $taxfree
	 */
	public function getTaxfree() {
		return $this->taxfree;
	}

	/**
	 * @param field_type $taxfree
	 */
	public function setTaxfree($taxfree) {
		$this->taxfree = $taxfree;
	}

	/**
	 * @return the $isreseller
	 */
	public function getIsreseller() {
		return $this->isreseller;
	}

	/**
	 * @param field_type $isreseller
	 */
	public function setIsreseller($isreseller) {
		$this->isreseller = $isreseller;
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

}