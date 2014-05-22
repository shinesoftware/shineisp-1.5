<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ZfcDatagrid\Column;
use ZfcDatagrid\Column\Type;
use ZfcDatagrid\Column\Style;
use ZfcDatagrid\Column\Formatter;
use ZfcDatagrid\Filter;
use Zend\Db\Sql\Select;

class LanguagesAdminController extends AbstractActionController
{
    /**
     * Add new information
     */
    public function addAction ()
    {
    	 
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('Base\Form\LanguagesForm');
    
    	$viewModel = new ViewModel(array (
    			'form' => $form,
    	));
    
    	$viewModel->setTemplate('base/languages-admin/edit');
    	return $viewModel;
    }
    
    /**
     * Edit the main information
     */
    public function editAction ()
    {
    	$id = $this->params()->fromRoute('id');
    	 
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('Base\Form\LanguagesForm');
    
    	// Get the TableGateway object to retrieve the data
    	$record = $this->getServiceLocator()->get('LanguagesTable');
    	
    	// Get the record by its id
    	$rsdata = $record->getRecordById($id);
    
    	// Bind the data in the form
    	if (! empty($rsdata)) {
    		$form->bind($rsdata);
    	}
    
    	$viewModel = new ViewModel(array (
    			'form' => $form,
    	));
    
    	return $viewModel;
    }
    
    /**
     * List of all records
     */
    public function indexAction ()
    {
    	$grid = $this->createGrid();
    	$grid->render();
    
    	$response = $grid->getResponse();
    
    	if ($grid->isHtmlInitReponse()) {
    		$view = new ViewModel();
    		$view->addChild($response, 'grid');
    		return $view;
    	} else {
    		return $response;
    	}
    
    }
    
    // Create the list grid
    private function createGrid ()
    {
    	$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    	$select = new Select();
    	$select->from(array ('l' => 'languages'));
    
    	$grid = $this->getServiceLocator()->get('ZfcDatagrid\Datagrid');
    	$grid->setDefaultItemsPerPage(100);
    	$grid->setDataSource($select, $dbAdapter);
    
    	$colId = new Column\Select('id', 'l');
    	$colId->setLabel('Id');
    	$colId->setIdentity();
    	$grid->addColumn($colId);
    	
    	$col = new Column\Select('language', 'l');
    	$col->setLabel(_('Title'));
    	$col->setWidth(15);
    	$grid->addColumn($col);
    	
    	$col = new Column\Select('locale', 'l');
    	$col->setLabel(_('Locale'));
    	$grid->addColumn($col);
    
    	$col = new Column\Select('base', 'l');
    	$col->setType(new \ZfcDatagrid\Column\Type\String());
    	$col->setLabel(_('Base'));
    	$col->setTranslationEnabled(true);
    	$col->setFilterSelectOptions(array (
    			'' => '-',
    			'0' => 'No',
    			'1' => 'Yes'
    	));
    	$col->setReplaceValues(array (
    			'' => '-',
    			'0' => 'No',
    			'1' => 'Yes'
    	));
    	$grid->addColumn($col);
    
    	$col = new Column\Select('active', 'l');
    	$col->setType(new \ZfcDatagrid\Column\Type\String());
    	$col->setLabel(_('Active'));
    	$col->setTranslationEnabled(true);
    	$col->setFilterSelectOptions(array (
    			'' => '-',
    			'0' => 'No',
    			'1' => 'Yes'
    	));
    	$col->setReplaceValues(array (
    			'' => '-',
    			'0' => 'No',
    			'1' => 'Yes'
    	));
    	$grid->addColumn($col);
    
    	// Add actions to the grid
    	$showaction = new Column\Action\Button();
    	$showaction->setAttribute('href', "/admin/languages/edit/" . $showaction->getColumnValuePlaceholder(new Column\Select('id', 'l')));
    	$showaction->setAttribute('class', 'btn btn-xs btn-success');
    	$showaction->setLabel(_('edit'));
    
    	$delaction = new Column\Action\Button();
    	$delaction->setAttribute('href', '/admin/languages/delete/' . $delaction->getRowIdPlaceholder());
    	$delaction->setAttribute('onclick', "return confirm('Are you sure?')");
    	$delaction->setAttribute('class', 'btn btn-xs btn-danger');
    	$delaction->setLabel(_('delete'));
    
    	$col = new Column\Action();
    	$col->addAction($showaction);
    	$col->addAction($delaction);
    	$grid->addColumn($col);
    
    	$grid->setToolbarTemplate('');
    
    	return $grid;
    }
    
    /**
     * Prepare the data and then save them
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function processAction ()
    {
    	
    	if (! $this->request->isPost()) {
    		return $this->redirect()->toRoute(NULL, array (
    				'controller' => 'languages',
    				'action' => 'index'
    		));
    	}
    
    	$post = $this->request->getPost();
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('Base\Form\LanguagesForm');
    	$form->setData($post);
    	
    	$inputFilter = $this->getServiceLocator()->get('LanguagesFilter');
    	$form->setInputFilter($inputFilter);
    	 
    	if (!$form->isValid()) {
    
    		// Get the record by its id
    		$viewModel = new ViewModel(array (
    				'error' => true,
    				'form' => $form,
    		));
    		$viewModel->setTemplate('base/languages-admin/edit');
    		return $viewModel;
    	}
    
    	// Get the posted vars
    	$data = $form->getData();
    	
    	// Save the data in the database
    	$record = $this->getServiceLocator()->get('LanguagesTable')->saveData($data);
    
    	$this->flashMessenger()->setNamespace('success')->addMessage('The information have been saved.');
    
    	return $this->redirect()->toRoute(NULL, array (
    			'controller' => 'languages',
    			'action' => 'edit',
    			'id' => $record->getId()
    	));
    }
    
    /**
     * Delete the records 
     *
     * @return \Zend\Http\Response
     */
    public function deleteAction ()
    {
    	$id = $this->params()->fromRoute('id');
    
    	if (is_numeric($id)) {
    		$record = $this->getServiceLocator()->get('LanguagesTable');
    
    		// Delete the record informaiton
    		$record->delete($id);
    
    		// Go back showing a message
    		$this->flashMessenger()->setNamespace('success')->addMessage('The record has been deleted!');
    		return $this->redirect()->toRoute('zfcadmin/languages');
    	}
    
    	$this->flashMessenger()->setNamespace('danger')->addMessage('The record has been not deleted!');
    	return $this->redirect()->toRoute('zfcadmin/languages');
    }
}
