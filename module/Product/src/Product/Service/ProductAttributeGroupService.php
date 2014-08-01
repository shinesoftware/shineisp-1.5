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
* @package Product
* @subpackage Service
* @author Michelangelo Turillo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Turillo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/

namespace Product\Service;

use Product\Entity\ProductGroups;
use Zend\EventManager\EventManager;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface; 

class ProductAttributeGroupService implements ProductAttributeGroupServiceInterface, EventManagerAwareInterface
{
	protected $tableGateway;
	protected $translator;
	protected $eventManager;
	
	public function __construct(TableGateway $tableGateway, \Zend\Mvc\I18n\Translator $translator ){
		$this->tableGateway = $tableGateway;
		$this->translator = $translator;
	}
	
    /**
     * @inheritDoc
     */
    public function findAll()
    {
    	$records = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {});
        return $records;
    }
	
    /**
     * Get the all the attributes set in the group attribute selected.
     * 
     * @param integer $attribute_set_id
     * @return unknown
     */
    public function findbyAttributeSetId($attribute_set_id)
    {
    	$records = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) use ($attribute_set_id) {
    		$select->where(array('attribute_set_id' => $attribute_set_id));
    		$select->join('product_attributes_groups_idx', 'id = product_attributes_groups_idx.attribute_group_id', array('*'), 'left');
        });
        
        return $records;
    }
    
    /**
     * Get all the attributes ids from the group attributes Idx
     * 
     * @param \Zend\Db\ResultSet\ResultSet $records
     * @return array
     */
    public function getAllAttributeIds(\Zend\Db\ResultSet\ResultSet $records){
        
        $ids = array();
        
        if($records->count()){
            foreach ($records as $record){
                $ids[] = $record->attribute_id;
            }
        }
        
        return $ids;
    }
	
    /**
     * Get the all the attributes and groups by the attribute_set_id field
     * 
     * @param integer $attribute_set_id
     * @return unknown
     */
    public function getGroupAttributesbyAttributeSetId($attribute_set_id)
    {
    	$records = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) use ($attribute_set_id) {
    		$select->join('product_attributes_groups_idx', 'id = product_attributes_groups_idx.attribute_group_id', array('*'), 'left');
    		$select->join('product_attributes', 'product_attributes.id = product_attributes_groups_idx.attribute_id', array ('attribute' => 'name'), 'left');
    		$select->where(array('attribute_set_id' => $attribute_set_id));
        });
        $resource = $records->getDataSource()->getResource();
        return $records;
    }
    
    /**
     * Create the tree of the groups and attributes
     */
    public function createTree($records){
        $items = array();
        $i = 0;
        foreach ($records as $record){
			$items[$record->getId()]['key'] = $record->attribute_id;
			$items[$record->getId()]['title'] = $record->getName();
			$items[$record->getId()]['folder'] = true;
			$items[$record->getId()]['children'][] = array('title' => $record->attribute, 'key' => $record->attribute_id);
			$i++;
        }
        $items = array_values($items);
        return $items;
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
    public function delete($id)
    {
    	$this->tableGateway->delete(array(
    			'id' => $id
    	));
    }

    /**
     * @inheritDoc
     */
    public function save(\Product\Entity\ProductAttributeGroups $record)
    {
    	$hydrator = new ClassMethods();
    	
    	// extract the data from the object
    	$data = $hydrator->extract($record);
    	$id = (int) $record->getId();
    	
    	$this->getEventManager()->trigger(__FUNCTION__ . '.pre', null, array('data' => $data));  // Trigger an event
    	    	
    	if ($id == 0) {
    		unset($data['id']);

    		// Save the data
    		$this->tableGateway->insert($data); 
    		
    		// Get the ID of the record
    		$id = $this->tableGateway->getLastInsertValue();
    	} else {
    		
    		$rs = $this->find($id);
    		
    		if (!empty($rs)) {

    			// Save the data
    			$this->tableGateway->update($data, array (
    					'id' => $id
    			));
    			
    		} else {
    			throw new \Exception('Record ID does not exist');
    		}
    	}
    	
    	$record = $this->find($id);
    	$this->getEventManager()->trigger(__FUNCTION__ . '.post', null, array('id' => $id, 'data' => $data, 'record' => $record));  // Trigger an event
    	return $record;
    }
    
	/* (non-PHPdoc)
     * @see \Zend\EventManager\EventManagerAwareInterface::setEventManager()
     */
     public function setEventManager (EventManagerInterface $eventManager){
         $eventManager->addIdentifiers(get_called_class());
         $this->eventManager = $eventManager;
     }

	/* (non-PHPdoc)
     * @see \Zend\EventManager\EventsCapableInterface::getEventManager()
     */
     public function getEventManager (){
       if (null === $this->eventManager) {
            $this->setEventManager(new EventManager());
        }

        return $this->eventManager;
     }

}