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

use Product\Model\Utilities;
use Product\Entity\Product;
use Zend\EventManager\EventManager;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

class ProductService implements ProductServiceInterface, EventManagerAwareInterface
{
	protected $tableGateway;
	protected $eav;
	protected $attributeSetService;
	protected $attributeService;
	protected $attributeGroupService;
	protected $translator;
	protected $eventManager;
	
	public function __construct(TableGateway $tableGateway, 
	                            \Product\Model\Eav $eav,
	                            \Product\Service\ProductAttributeGroupService $attributeGroup,
	                            \Product\Service\ProductAttributeSetServiceInterface $attributeSet,
	                            \Product\Service\ProductAttributeServiceInterface $attribute,
	                            \Zend\Mvc\I18n\Translator $translator ){
	    
		$this->tableGateway = $tableGateway;
		$this->eav = $eav;
		$this->attributeSetService = $attributeSet;
		$this->attributeGroupService = $attributeGroup;
		$this->attributeService = $attribute;
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
     * @see \Product\Entity\Product
     */
    public function find($id)
    {
    	if(!is_numeric($id)){
    		return false;
    	}
    	
    	$rowset = $this->tableGateway->select(array('id' => $id));
    	$row = $rowset->current();
    	
    	// get the attribute values of the record selected
    	if(!empty($row) && $row->getId()){
    	    $attributeSetId = $row->getAttributeSetId();
    	    	
    	    // Get the attributes and build the form on the fly
    	    $attributesIdx = $this->attributeSetService->findByAttributeSet($attributeSetId);
    	    
    	    foreach ($attributesIdx as $attributeId){
    	        $attribute = $this->attributeService->find($attributeId);
    	
    	        // get the attribute values
    	        $attrValues[$attribute->getName()] = $this->eav->getAttributeValue($row, $attribute->getName());
    	        
    	        $attributes[] = $attribute;
    	    }
    	    
    	    /**
    	     * We need to cast the variable $attributes as ArrayObject
    	     * Now I create an ArrayObject in order to set the product attributes entity
    	     * @see \Product\Entity\Product
    	     */ 
    	    if(is_array($attrValues)){
        	    $object = new \Zend\Stdlib\ArrayObject($attrValues);
    	        $row->setAttributes($object);
    	    }
    	}
    	return $row;
    }
    
    /**
     * Delete a file reference from the attribute created by a json string
     * 
     * @param integer $id
     * @param integer $attributeId
     * @param string $file
     * @return boolean
     */
    public function deleteFilefromAttribute($id, $attributeId, $file){
        $attributes = array();
        $eavProduct = new \Product\Model\EavProduct($this->tableGateway);
        
        // Get the record by its id
        $product = $this->find($id);
        $attribute = $this->attributeService->find($attributeId);
        $attributes = $product->getAttributes();
        
        // get the attribute name to select
        $attributeName = $attribute->getName();
         
        if(!empty($attributes[$attributeName])){
        	
        	// get the list of the files saved in the database table
        	$files = json_decode($attributes[$attributeName], true);
        	
        	// get the path where the files have been saved
        	$path = $attribute->getFiletarget();
        	
        	// delete the file from the filesystem
        	$fullpath = PUBLIC_PATH . $path ."/". $file;
        	if(!empty($file) && file_exists($fullpath)){
        		unlink($fullpath);
        	}
        	
        	// delete the file from the database
        	$files = array_diff($files, array($file));
        	
        	// save the attribute data
        	$eavProduct->setAttributeValue($product, $attribute, json_encode($files));
        	
        	return true;
        }
        
        return false;    	
    }
    
    /**
     * Get the attributes by the Set of the attribute Id
     * 
     * @param integer $attributeSetId
     * @return ArrayObject
     */
    public function getAttributes($attributeSetId){
        $attributes = array();
        $attributesIdx = $this->attributeSetService->findByAttributeSet($attributeSetId);
        if(!empty($attributesIdx)){
            foreach ($attributesIdx as $attributeId){
                $attribute = $this->attributeService->find($attributeId);
                $attributes[] = $attribute;
            }
        }
        return $attributes;    	
    }
    
    /**
     * Get the attribute group set
     * 
     * @param integer $attributeSetId
     * @return ArrayObject
     */
    public function getAttributeGroups($attributeSetId){
        $attrGroups = array();
        $attrgroupsIdx = $this->attributeGroupService->getGroupAttributesbyAttributeSetId($attributeSetId);
        if(!empty($attrgroupsIdx)){
            foreach ($attrgroupsIdx as $attrgroup){
                $attrGroups[$attrgroup->groupid] = $attrgroup->group;
            }
        }
        return $attrGroups;    	
    }
    
    /**
     * Get the attribute group set data
     * 
     * @param integer $attributeSetId
     * @return ArrayObject
     */
    public function getAttributeGroupsData($attributeSetId){
        $attrGroups = array();

        // Get the all the attributes and groups by the attribute_set_id field
        $attrgroupsIdx = $this->attributeGroupService->getGroupAttributesbyAttributeSetId($attributeSetId);
        
        // now we include in a new array Groups, Attributes and its data
        if(!empty($attrgroupsIdx)){
            foreach ($attrgroupsIdx as $attrgroup){
            	$attribute = $this->attributeService->find($attrgroup->attribute_id);
                $attrGroups[$attrgroup->groupid][$attrgroup->attribute_id] = array('name' => $attrgroup->group, 'attribute' => $attribute);
            }
        }
        
        return $attrGroups;    	
    }
    
    /**
     * @inheritDoc
     */
    public function search($search, $locale="en_US")
    {
    	$result = array();
    	$i = 0;
    	
    	$records = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) use ($search, $locale){
    		$select->where(new \Zend\Db\Sql\Predicate\Like('company', '%'.$search.'%'));
    		$select->where(new \Zend\Db\Sql\Predicate\Like('lastname', '%'.$search.'%'), 'OR');
    	});
    	
    	foreach ($records as $record){
    		$result[$i]['icon'] = "fa fa-file";
    		$result[$i]['section'] = "Product";
    		$result[$i]['value'] = $record->getCompany();
//     		$result[$i]['url'] = "/admin/Product/" . $record->getSlug() . ".html";
    		$result[$i]['keywords'] = null;
    		$i++;
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
    public function save(\Product\Entity\Product $record)
    {
    	$hydrator = new ClassMethods();
    	$utils = new \Product\Model\Utilities();
    	 
    	$eavProduct = new \Product\Model\EavProduct($this->tableGateway);
    	
    	// extract the data from the object
    	$data = $hydrator->extract($record);
    	$attributes = $data['attributes'];
    	unset($data['attributes']);
    	
    	$id = (int) $record->getId();
    	$this->getEventManager()->trigger(__FUNCTION__ . '.pre', null, array('data' => $data));  // Trigger an event
    	    	
    	if ($id == 0) {
    		unset($data['id']);
    		
    		$data['createdat'] = date('Y-m-d H:i:s');
    		$data['updatedat'] = date('Y-m-d H:i:s');
			$data['uid'] = $utils->generateUid();
			
    		// Save the data
    		$this->tableGateway->insert($data); 
    		
    		// Get the ID of the record
    		$id = $this->tableGateway->getLastInsertValue();
    	} else {
    		
    		$rs = $this->find($id);
    		
    		if (!empty($rs)) {
    			$data['updatedat'] = date('Y-m-d H:i:s');
    			unset( $data['createdat']);
    			unset( $data['uid']);
    			
    			
    			// Save the data
    			$this->tableGateway->update($data, array (
    					'id' => $id
    			));
    			
    		} else {
    			throw new \Exception('Record ID does not exist');
    		}
    	}
    	
    	$record = $this->find($id);
    	
    	// Save the attributes
    	foreach ($attributes as $attribute => $value){
    	    var_dump($attributes);
    	    die;
    		$theAttrib = $this->attributeService->findbyName($attribute);
    		
    		// check here the value type because the Validator Strategy is not simple to apply to the dynamic fieldset
    		// http://stackoverflow.com/questions/24989878/how-to-create-a-form-in-zf2-using-the-fieldsets-validators-strategies-and-the?noredirect=1
    		if($this->validateDate($value, 'd/m/Y')){
    	
//     			$date = \DateTime::createFromFormat('d/m/Y', $value);
//     			$value = $date->format('Y-m-d');
    		}
    		
    		var_dump($attribute);
    		
    		switch ($theAttrib->getInput()) {
    			case "file":
    				
    				// get the old attached files
    				$oldFile = $eavProduct->getAttributeValue($record, $attribute);
    				
					if(!empty($value['name'])){
		    			if(!empty($oldFile)){
		    				$files = json_decode($oldFile, true);
		    				
		    				// add new files to the record
		    				$allFiles = array_merge(array($value['name']), $files);
		    				$value = json_encode($allFiles);
	    				}else{
	    					$value = json_encode(array($value['name']));
	    				}
					}else{
						$value = $oldFile; // if no file is upload set the old information  
					}
    				
	    			break;
    		}
    		
    		$eavProduct->setAttributeValue($record, $attribute, $value);
    	}
    	$this->getEventManager()->trigger(__FUNCTION__ . '.post', null, array('id' => $id, 'data' => $data, 'record' => $record));  // Trigger an event
    	return $record;
    }
    
    /**
     * check if is a valid date
     * 
     * @param string $date
     * @param string $format
     * @return boolean
     */
    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        if(is_string($date)){
    		$d = \DateTime::createFromFormat($format, $date);
        	return $d && $d->format($format) == $date;
        }
        return false;
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