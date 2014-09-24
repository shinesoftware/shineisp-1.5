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
* @author Michelangelo Turillo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Turillo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/

namespace Base\Service;

use Base\Entity\Settings;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class SettingsService implements SettingsServiceInterface {
    
	protected $tableGateway;
	protected $module;
	
	public function __construct(TableGateway $tableGateway ){
		$this->tableGateway = $tableGateway;
	}
	
	/**
	 * @inheritDoc
	 */
	public function findAll()
	{
		$records = $this->tableGateway->select();
		return $records;
	}
	
	/**
	 * @inheritDoc
	 */
	public function find($id)
	{
		if(!is_numeric($id)){
			return false;
		}
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		return $row;
	}
	
	/**
	 * @inheritDoc
	 */
	public function findByModule($module)
	{
		$records = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) use ($module){
			$select->where(array('module' => $module));
		});
	
		return $records;
	}
	
	/**
	 * @inheritDoc
	 */
	public function findByParameter($module, $parameter)
	{
		$record = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) use ($module, $parameter){
			$select->where(array('module' => $module, 'parameter' => $parameter));
		});
	
		return $record->current();
	}
	
	/**
	 * @inheritDoc
	 */
	public function getValueByParameter($module, $parameter)
	{
		$record = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) use ($module, $parameter){
			$select->where(array('module' => $module, 'parameter' => $parameter));
		});
		
		if($record->current()){
			return $record->current()->getValue();
		}else{
			return null;
		}
	}
	
	/**
	 * @inheritDoc
	 */
	public function cleanup($module)
	{
		return $this->tableGateway->delete(array('module' => $module));
	
	}
	
	/**
	 * @inheritDoc
	 */
	public function delete($id)
	{
		$this->tableGateway->delete(array(
				'id' => $id
		));
	}
	
	/**
	 * @inheritDoc
	 */
	public function save(\Base\Entity\Settings $record)
	{
		$hydrator = new ClassMethods(true);
		 
		// extract the data from the object
		$data = $hydrator->extract($record);
		$id = (int) $record->getId();

		// check if the value is an array and convert it into json string
	    $data['value'] = is_array($data['value']) ? json_encode($data['value']) : $data['value'];    
		
		if ($id == 0) {
			unset($data['id']);
			$this->tableGateway->insert($data); // add the record
			$id = $this->tableGateway->getLastInsertValue();
		} else {
			$rs = $this->find($id);
			if (!empty($rs)) {
				$this->tableGateway->update($data, array (
						'id' => $id
				));
			} else {
				throw new \Exception('Record ID does not exist');
			}
		}
		 
		$record = $this->find($id);
		return $record;
	}
}
	