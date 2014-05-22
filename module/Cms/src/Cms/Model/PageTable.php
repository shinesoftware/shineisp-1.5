<?php
namespace Cms\Model;
use Zend\Db\Sql\Ddl\Column\Boolean;

use Zend\Text\Table\Row;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class PageTable
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
    

    public function saveData (\Cms\Model\Page $record)
    {
        $hydrator = new ClassMethods(true);
        
        // extract the data from the object
        $data = $hydrator->extract($record);
        $id = (int) $record->getId();
        
        if ($id == 0) {
        	unset($data['id']);
            $data['createdat'] = date('Y-m-d H:i:s');
            $data['updatedat'] = date('Y-m-d H:i:s');
            $this->tableGateway->insert($data); // add the record
            $id = $this->tableGateway->getLastInsertValue();
        } else {
        	$rs = $this->getRecordById($id);
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
        $records = $this->getTableGateway()->select(function (\Zend\Db\Sql\Select $select) {
        	$select->where(array('page.visible' => true));
        	$select->join('page_category', 'category_id = page_category.id', array ('category'), 'left');
        });
        
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
     * Get Record account by Uri
     * 
     * @param string $pageUri            
     * @throws \Exception
     * @return Row
     */
    public function getRecordByUri ($pageUri)
    {
    	$record = $this->getTableGateway()->select(function (\Zend\Db\Sql\Select $select) use ($pageUri){
    		$select->where(array('uri' => $pageUri));
    		$select->where(array('page.visible' => true));
    		$select->join('page_category', 'category_id = page_category.id', array ('category'), 'left');
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
