<?php
namespace Cms\Service;

use Cms\Entity\Page;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class PageService implements PageServiceInterface
{
	protected $tableGateway;
	protected $translator;
	
	public function __construct(TableGateway $tableGateway, \Zend\Mvc\I18n\Translator $translator ){
		$this->tableGateway = $tableGateway;
		$this->translator = $translator;
	}
	
    /**
     * @inheritDoc
     */
    public function findAll()
    {
    	$records = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
        	$select->join('page_category', 'category_id = page_category.id', array ('category'), 'left');
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
    public function findByUri($slug, $locale="en_US")
    {
    	$record = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) use ($slug, $locale){
    		$select->join('page_category', 'category_id = page_category.id', array ('category'), 'left');
    		$select->join('languages', 'language_id = languages.id', array ('locale', 'language'), 'left');
    		$select->where(array('slug' => $slug));
    	});

    	if ($record->count()){
    		if($record->current()->locale != $locale){
    			$myRecord = $record->current();
    			$myContent = $myRecord->getContent();
    			$message = sprintf($this->translator->translate('The content has not been found into the selected language. Original %s version is shown.'), $myRecord->language);
    			$message = "<small>$message</small>";
    			$myRecord->setContent($myContent . $message);
    			return $myRecord;
    		}
    	}
    	 
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
    public function save(\Cms\Entity\Page $record)
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
    	return $record;
    }
}