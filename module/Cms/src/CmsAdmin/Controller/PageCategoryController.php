<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace CmsAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ZfcDatagrid\Column;
use ZfcDatagrid\Column\Type;
use ZfcDatagrid\Column\Style;
use ZfcDatagrid\Column\Formatter;
use ZfcDatagrid\Filter;
use Zend\Db\Sql\Select;
use Cms\Service\PageCategoryServiceInterface;

class PageCategoryController extends AbstractActionController
{
	protected $pagecategoryService;
	
	public function __construct(PageCategoryServiceInterface $pagecategoryService)
	{
		$this->pagecategoryService = $pagecategoryService;
	}
	
	/**
	 * Add new information
	 */
	public function addAction ()
	{
	
		$form = $this->getServiceLocator()->get('FormElementManager')->get('Cms\Form\PageCategoryForm');
	
		$viewModel = new ViewModel(array (
				'form' => $form,
		));
	
		$viewModel->setTemplate('cms-admin/page-category/edit');
		return $viewModel;
	}
	
    /**
     * Edit the record
     */
    public function editAction ()
    {
    	$id = $this->params()->fromRoute('id');
    	 
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('Cms\Form\PageCategoryForm');
    
    	// Get the record by its id
    	$record = $this->pagecategoryService->find($id);
    	
    	// Bind the data in the form
    	if (! empty($record)) {
    		$form->bind($record);
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
    	$select->from(array ('c' => 'page_category'));
    
    	$grid = $this->getServiceLocator()->get('ZfcDatagrid\Datagrid');
    	$grid->setDefaultItemsPerPage(100);
    	$grid->setDataSource($select, $dbAdapter);
    
    	$colId = new Column\Select('id', 'c');
    	$colId->setLabel('Id');
    	$colId->setIdentity();
    	$grid->addColumn($colId);
    	
    	$col = new Column\Select('category', 'c');
    	$col->setLabel(_('Category'));
    	$col->setWidth(15);
    	$grid->addColumn($col);
    
    	$col = new Column\Select('visible', 'c');
    	$col->setType(new \ZfcDatagrid\Column\Type\String());
    	$col->setLabel(_('Visible'));
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
    	$showaction->setAttribute('href', "/admin/cmscategory/edit/" . $showaction->getColumnValuePlaceholder(new Column\Select('id', 'c')));
    	$showaction->setAttribute('class', 'btn btn-xs btn-success');
    	$showaction->setLabel(_('edit'));
    
    	$delaction = new Column\Action\Button();
    	$delaction->setAttribute('href', '/admin/cmscategory/delete/' . $delaction->getRowIdPlaceholder());
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
    				'controller' => 'cms',
    				'action' => 'index'
    		));
    	}
    
    	$post = $this->request->getPost();
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('Cms\Form\PageCategoryForm');
    	$form->setData($post);
    	
    	$inputFilter = $this->getServiceLocator()->get('PageCategoryFilter');
    	$form->setInputFilter($inputFilter);
    	 
    	if (!$form->isValid()) {
    
    		// Get the record by its id
    		$viewModel = new ViewModel(array (
    				'error' => true,
    				'form' => $form,
    		));
    		$viewModel->setTemplate('cms-admin/page-category/edit');
    		return $viewModel;
    	}
    
    	// Get the posted vars
    	$pageData = $form->getData();
    	
    	// Save the data in the database
    	$page = $this->pagecategoryService->save($pageData);
    
    	$this->flashMessenger()->setNamespace('success')->addMessage('The information have been saved.');
    
    	return $this->redirect()->toRoute(NULL, array (
    			'controller' => 'cms',
    			'action' => 'edit',
    			'id' => $page->getId()
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
    
    		// Delete the record informaiton
    		$this->pagecategoryService->delete($id);
    
    		// Go back showing a message
    		$this->flashMessenger()->setNamespace('success')->addMessage('The record has been deleted!');
    		return $this->redirect()->toRoute('zfcadmin/cmscategory');
    	}
    
    	$this->flashMessenger()->setNamespace('danger')->addMessage('The record has been not deleted!');
    	return $this->redirect()->toRoute('zfcadmin/cmscategory');
    }
}
