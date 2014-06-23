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
* @subpackage Service
* @author Michelangelo Turillo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Turillo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/

namespace Customer\Service;

use Zend\EventManager\EventManager;

use Customer\Entity\Customer;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

class CustomerService implements CustomerServiceInterface, EventManagerAwareInterface
{
	protected $tableGateway;
	protected $addressService;
	protected $translator;
	protected $eventManager;
	
	public function __construct(TableGateway $tableGateway, \Customer\Service\AddressService $addressService, \Zend\Mvc\I18n\Translator $translator ){
		$this->tableGateway = $tableGateway;
		$this->addressService = $addressService;
		$this->translator = $translator;
	}
	
    /**
     * @inheritDoc
     */
    public function findAll()
    {
    	$records = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
//          	$select->join('customer_address', 'category_id = customer_address.id', array ('category'), 'left');
        });
        
        return $records;
    }
	
    /**
     * @inheritDoc
     */
    public function getActiveCustomers()
    {
    	$records = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
//     		$select->join('cms_page_category', 'category_id = cms_page_category.id', array ('category'), 'left');
//         	$select->where(array('cms_page.visible' => true, 'cms_page.showonlist' => true));
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
    	
    	if(!empty($row) && $row->getId()){
//     		$address = $this->addressService->find($row->getId());
//     		$row->setAddress($address);
    	}
    	
    	return $row;
    }
    
    /**
     * @inheritDoc
     */
    public function search($search, $locale="en_US")
    {
    	$result = array();
    	$i = 0;
    	
    	$records = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) use ($search, $locale){
//     		$select->join('cms_page_category', 'category_id = cms_page_category.id', array ('category'), 'left');
//     		$select->join('base_languages', 'language_id = base_languages.id', array ('locale', 'language'), 'left');
    		$select->where(new \Zend\Db\Sql\Predicate\Like('company', '%'.$search.'%'));
    		$select->where(new \Zend\Db\Sql\Predicate\Like('lastname', '%'.$search.'%'), 'OR');
    	});
    	
    	foreach ($records as $record){
    		$result[$i]['icon'] = "fa fa-file";
    		$result[$i]['section'] = "Customer";
    		$result[$i]['value'] = $record->getCompany();
//     		$result[$i]['url'] = "/admin/customer/" . $record->getSlug() . ".html";
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
    public function save(\Customer\Entity\Customer $record)
    {
    	$hydrator = new ClassMethods();
    	
    	// extract the data from the object
    	$data = $hydrator->extract($record);
    	$id = (int) $record->getId();
    	
    	$this->getEventManager()->trigger(__FUNCTION__ . '.pre', null, array('data' => $data));  // Trigger an event
    	
    	if ($id == 0) {
    		unset($data['id']);
    		$data['createdat'] = date('Y-m-d H:i:s');
    		$data['updatedat'] = date('Y-m-d H:i:s');
    		$this->tableGateway->insert($data); // add the record
    		$id = $this->tableGateway->getLastInsertValue();
    	} else {
    		$rs = $this->find($id);
    		if (!empty($rs)) {
    			$data['updatedat'] = date('Y-m-d H:i:s');
    			unset( $data['createdat']);
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