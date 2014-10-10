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
* @package Category
* @subpackage Service
* @author Michelangelo Turillo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Turillo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/

namespace ProductCategory\Service;

use ProductCategory\Model\Utilities;
use ProductCategory\Entity\Category;
use Zend\EventManager\EventManager;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use \Base\Hydrator\Strategy\DateTimeStrategy as DateTimeStrategy;
 
class CategoryService implements CategoryServiceInterface, EventManagerAwareInterface
{
	protected $tableGateway;
	protected $translator;
	protected $eventManager;
	
	public function __construct(TableGateway $tableGateway, 
	                            \Zend\Mvc\I18n\Translator $translator ){
	    
		$this->tableGateway = $tableGateway;
		$this->translator = $translator;
	}
	
	/**
	 * get the tablegateway object for the datagrid
	 * @see \CategoryAdmin\Factory\IndexControllerFactory
	 */
	public function getTablegateway(){
	    return $this->tableGateway;
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
     * @see \ProductCategory\Entity\Category
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
     * Get the all the categories
     *
     * @param integer $attribute_set_id
     * @return unknown
     */
    public function getCategories()
    {
        $records = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
//             $select->where(array('active' => true));
        });
        $records->getDataSource()->getResource();
        return $records;
    }
    
    /**
     * Create the tree of the groups and attributes
     */
    public function createTree($records){
        $items = array();
        $i = 0;
        foreach ($records as $record){
            $items[$record->getId()]['key'] = $record->getId();
            $items[$record->getId()]['title'] = $record->getName();
            $items[$record->getId()]['folder'] = true;
            $items[$record->getId()]['base'] = true;
            $items[$record->getId()]['expanded'] = true;
            $items[$record->getId()]['data'] = "basenode";
            $items[$record->getId()]['children'][] = array('title' => $record->getName(), 'key' => $record->getId());
            $i++;
        }
        $items = array_values($items);
        return $items;
    }
    
    
    /**
     * @inheritDoc
     */
    public function search($search, $locale="en_US")
    {
    	$result = array();
    	$retval = array();
    	$i = 0;
    	
    	// get all the products (few fields only)
    	$category = $this->findAll();

    	// loop the result
    	foreach ($retval as $id => $value){
        	$result[$i]['icon'] = "fa fa-barcode";
        	$result[$i]['section'] = "Category";
        	$result[$i]['value'] = $value;
//         	$result[$i]['url'] = "/admin/product/" . $record->getSlug() . ".html";
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
    public function save(\ProductCategory\Entity\Category $record)
    {
    	$hydratorClassMethod = new ClassMethods();
    	$hydratorDateTime = new DateTimeStrategy();
    	 
    	// extract the data from the object
    	$thedata = $hydratorDateTime->extract($record);
    	$data = $hydratorClassMethod->extract($thedata);
    	 
    	$data = $data['array_copy'];
    	
    	$attributes = $thedata->getAttributes();
    	unset($data['attributes']);
    	unset($data['submit']);
    	
    	$id = (int) $record->getId();
    	$this->getEventManager()->trigger(__FUNCTION__ . '.pre', null, array('data' => $record));  // Trigger an event
    	 	
    	if ($id == 0) {
    		unset($data['id']);
    		
    		$data['createdat'] = date('Y-m-d H:i:s');
    		$data['updatedat'] = date('Y-m-d H:i:s');
			
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