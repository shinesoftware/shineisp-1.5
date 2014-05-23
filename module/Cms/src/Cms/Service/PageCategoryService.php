<?php
namespace Cms\Service;

use Cms\Entity\PageCategory;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class PageCategoryService implements PageCategoryServiceInterface
{
	protected $tableGateway;
	
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
    public function findByName($name)
    {
    	$record = $this->getTableGateway()->select(function (\Zend\Db\Sql\Select $select) use ($name){
    		$select->where(array('category' => $name));
    	});
    	 
    	return $record->current();
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
    public function save(\Cms\Entity\PageCategory $record)
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
        	$rs = $this->find($id);
            if (!empty($rs)) {
                $this->tableGateway->update($data, array ( 
                        'id' => $id
                ));
            } else {
                throw new \Exception('Page ID does not exist');
            }
        }
        
        $record = $this->find($id);
        return $record;
    }
}