<?php
namespace Base\Model;
use Zend\Db\Sql\Ddl\Column\Boolean;

use Zend\Text\Table\Row;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class LanguagesTable
{

    protected $tableGateway;

    public function __construct (TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    /**
     * @return the $tableGateway
     */
    public function getTableGateway ()
    {
    	return $this->tableGateway;
    }
    

    public function saveData (\Base\Model\Languages $record)
    {
        $hydrator = new ClassMethods(true);
        
        // extract the data from the object
        $data = $hydrator->extract($record);
        $id = (int) $record->getId();
        
        if ($id == 0) {
        	unset($data['id']);
            $this->tableGateway->insert($data); // add the record
            $id = $this->tableGateway->getLastInsertValue();
        } else {
        	$rs = $this->getRecordById($id);
            if (!empty($rs)) {
                $this->tableGateway->update($data, array ( 
                        'id' => $id
                ));
            } else {
                throw new \Exception('Record ID does not exist');
            }
        }
        
        $record = $this->getRecordById($id);
        return $record;
    }

    /**
     * Get all pages
     * 
     * @return ResultSet
     */
    public function fetchAll ()
    {
        $records = $this->getTableGateway()->select(function (\Zend\Db\Sql\Select $select) {});
        return $records;
    }

    /**
     * Get record account by id
     * 
     * @param string $id            
     * @throws \Exception
     * @return Row
     */
    public function getRecordById ($id)
    {
    	if(!is_numeric($id)){
    		return false;
    	}
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        return $row;
    }

    /**
     * Get Record account by Name
     * 
     * @param string $name            
     * @throws \Exception
     * @return Row
     */
    public function getRecordByName ($name)
    {
    	$record = $this->getTableGateway()->select(function (\Zend\Db\Sql\Select $select) use ($name){
    		$select->where(array('language' => $name));
    	});
    	
        return $record->current();
    }

    /**
     * Delete a record by its id
     * 
     * @param string $id            
     */
    public function delete ($id)
    {
        $this->tableGateway->delete(array(
                'id' => $id
        ));
    }
}
