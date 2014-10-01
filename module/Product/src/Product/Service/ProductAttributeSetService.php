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

use Product\Entity\ProductAttributeSet;
use Zend\EventManager\EventManager;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface; 

class ProductAttributeSetService implements ProductAttributeSetServiceInterface, EventManagerAwareInterface
{
	protected $tableGateway;
	protected $attributegroupService;
	protected $attributegroupIdxService;
	protected $translator;
	protected $eventManager;
	
	public function __construct(TableGateway $tableGateway,
								\Product\Service\ProductAttributeGroupService $attributeGroupService, 
								\Product\Service\ProductAttributeIdxService $attributeGroupIdxService, 
								\Zend\Mvc\I18n\Translator $translator ){
		
			$this->tableGateway = $tableGateway;
			$this->attributegroupService = $attributeGroupService;
			$this->attributegroupIdxService = $attributeGroupIdxService;
			$this->translator = $translator;
	}
	
    /**
     * @inheritDoc
     */
    public function findAll()
    {
    	$records = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
        });
        
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
    public function getDefault()
    {
    	$record = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
    		$select->where(array('default' => true));
    	})->current();
    
    	return $record;
    }
    
    /**
     * @inheritDoc
     */
    public function findByAttributeSet($id)
    {
    	if(!is_numeric($id)){
    		return false;
    	}
    	
    	$result = array();
    
    	$records = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) use ($id){
    		$select->join('product_attributes_idx', 'product_attributes_set.id = product_attributes_idx.attribute_set_id', array ('*'), 'left');
    		$select->where(array('product_attributes_set.id' => $id));
    	});
    
    	foreach ($records as $record){
    		$result[] = $record->attribute_id;
    	}
    	return $result;
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
    public function save(\Product\Entity\ProductAttributeSet $record)
    {
    	$hydrator = new ClassMethods();
    	
    	$attributes = $record->getAttributes();
    	
    	// get the default attribute set
    	$defaultAttributeSet = $this->getDefault();
    	
    	// extract the data from the object
    	$data = $hydrator->extract($record);
    	$id = (int) $record->getId();
    	
    	$this->getEventManager()->trigger(__FUNCTION__ . '.pre', null, array('data' => $data));  // Trigger an event
    	
    	unset($data['attributes']);
    	
    	if ($id == 0) {
    		unset($data['id']);
    		
    		$data['default'] = false;  // this field is false for the new "attribute set".
    		
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
    	
    	// If the "Attribute Set" is new we have to create the default attributes group based on the default Attribute Group! 
    	if(empty($attributes)){
    	    $attributetree = $this->attributegroupService->getGroupAttributes($defaultAttributeSet->getId());
    	    foreach ($attributetree as $attribute){
    	        $attributes[] = array('attribute_group_id' => $attribute->getId(),
    	                              'attribute_group_title' => $attribute->name,
    	                              'attribute_id' => $attribute->attribute_id,
    	                              'attribute_name' => $attribute->attribute);
    	    }
    	}    
    	
    	// save the attributes
    	$this->saveAttributes($id, $attributes);
    	
    	$record = $this->find($id);
    	$this->getEventManager()->trigger(__FUNCTION__ . '.post', null, array('id' => $id, 'data' => $data, 'record' => $record));  // Trigger an event
    	return $record;
    }
    
    /**
     * Save the attributes idx
     * @param integer $setId
     * @param array $attributes
     */
    private function saveAttributes($setId, array $attributes){
    	
    	$attributegroupIdxService = $this->attributegroupIdxService;
    	
    	// clear the old custom settings
    	$attributegroupIdxService->clearAttributeGroup($setId);
    	
    	$idx = new \Product\Entity\ProductAttributeIdx();
    	
    	// save the new pair attribute ids and attributeset id
    	foreach ($attributes as $data){

    		// if the group is new fancytree js object add an underscore into the id of the item
    		$chkNew = strpos($data['attribute_group_id'], "_"); 
    		if ($chkNew !== false) {
    			$rsGroup = $this->attributegroupService->findByName($data['attribute_group_title']);
    			if(0 == $rsGroup->count()){
    				$newGroup = new \Product\Entity\ProductAttributeGroups();
    				$newGroup->setName($data['attribute_group_title']);
    				$group = $this->attributegroupService->save($newGroup);
    				$data['attribute_group_id'] = $group->getId();
    			}else{
    				$data['attribute_group_id'] = $rsGroup->current()->getId();
    			}
    		}
    		
    		// save the data
    		$idx->setAttributeId($data['attribute_id']);
    		$idx->setAttributeGroupId($data['attribute_group_id']);
    		$idx->setAttributeSetId($setId);
    		$attributegroupIdxService->save($idx);
    	}
    	
    	return true;
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