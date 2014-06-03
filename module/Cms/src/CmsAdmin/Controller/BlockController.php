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
use Cms\Model\UrlRewrites as UrlRewrites;
use Cms\Service\blockServiceInterface;

class BlockController extends AbstractActionController
{
	protected $blockService;
	
	public function __construct(BlockServiceInterface $blockService)
	{
		$this->blockService = $blockService;
	}
	
    /**
     * Add new information
     */
    public function addAction ()
    {
    	 
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('Cms\Form\BlockForm');
    
    	$viewModel = new ViewModel(array (
    			'form' => $form,
    	));
    
    	$viewModel->setTemplate('cms-admin/block/edit');
    	return $viewModel;
    }
    
    /**
     * Edit the main block information
     */
    public function editAction ()
    {
    	$id = $this->params()->fromRoute('id');
    	 
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('Cms\Form\BlockForm');
    
    	// Get the record by its id
    	$record = $this->blockService->find($id);
    
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
    	$select->from(array ('b' => 'cms_block'))->join(array('l' => 'base_languages'), 'b.language_id = l.id', array('language'), 'left');;
    
    	$grid = $this->getServiceLocator()->get('ZfcDatagrid\Datagrid');
    	$grid->setDefaultItemsPerPage(100);
    	$grid->setDataSource($select, $dbAdapter);
    
    	$colId = new Column\Select('id', 'b');
    	$colId->setLabel('Id');
    	$colId->setIdentity();
    	$grid->addColumn($colId);
    	
    	$col = new Column\Select('title', 'b');
    	$col->setLabel(_('Title'));
    	$col->setWidth(15);
    	$grid->addColumn($col);
    	
    	$col = new Column\Select('placeholder', 'b');
    	$col->setLabel(_('Placeholder'));
    	$grid->addColumn($col);
    	
    	$colType = new Type\DateTime('Y-m-d H:i:s', \IntlDateFormatter::SHORT, \IntlDateFormatter::SHORT);
    	$colType->setSourceTimezone('Europe/Rome');
    	$colType->setOutputTimezone('UTC');
    	$colType->setLocale('it_IT');
    
    	$col = new Column\Select('createdat', 'b');
    	$col->setType($colType);
    	$col->setLabel(_('Created At'));
    	$grid->addColumn($col);
    
    	$col = new Column\Select('updatedat', 'b');
    	$col->setType($colType);
    	$col->setLabel(_('Updated At'));
    	$grid->addColumn($col);
    
    	$col = new Column\Select('language', 'l');
    	$col->setLabel(_('Language'));
    	$col->addStyle(new Style\Bold());
    	$grid->addColumn($col);
    
    	$col = new Column\Select('visible', 'b');
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
    	$showaction->setAttribute('href', "/admin/cmsblocks/edit/" . $showaction->getColumnValuePlaceholder(new Column\Select('id', 'b')));
    	$showaction->setAttribute('class', 'btn btn-xs btn-success');
    	$showaction->setLabel(_('edit'));
    
    	$delaction = new Column\Action\Button();
    	$delaction->setAttribute('href', '/admin/cmsblocks/delete/' . $delaction->getRowIdPlaceholder());
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
    	$urlRewrite = new UrlRewrites();
    	
    	if (! $this->request->isPost()) {
    		return $this->redirect()->toRoute(NULL, array (
    				'controller' => 'cms',
    				'action' => 'index'
    		));
    	}
    
    	$post = $this->request->getPost();
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('Cms\Form\BlockForm');
    	$form->setData($post);
    	
    	$inputFilter = $this->getServiceLocator()->get('BlockFilter');
    	$form->setInputFilter($inputFilter);
    	 
    	if (!$form->isValid()) {
    
    		// Get the record by its id
    		$viewModel = new ViewModel(array (
    				'error' => true,
    				'form' => $form,
    		));
    		$viewModel->setTemplate('cms-admin/block/edit');
    		return $viewModel;
    	}
    
    	// Get the posted vars
    	$data = $form->getData();
    	
    	$placeholder = $data->getPlaceholder();
    	$strPlaceholder = !empty($placeholder) ? $placeholder : $urlRewrite->format($data->getTitle());
    	$data->setPlaceholder($strPlaceholder);
    	
    	// Save the data in the database
    	$record = $this->blockService->save($data);
    
    	$this->flashMessenger()->setNamespace('success')->addMessage('The information have been saved.');
    
    	return $this->redirect()->toRoute(NULL, array (
    			'controller' => 'cms',
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
    
    		// Delete the record informaiton
    		$this->blockService->delete($id);
    
    		// Go back showing a message
    		$this->flashMessenger()->setNamespace('success')->addMessage('The record has been deleted!');
    		return $this->redirect()->toRoute('zfcadmin/cmsblocks');
    	}
    
    	$this->flashMessenger()->setNamespace('danger')->addMessage('The record has been not deleted!');
    	return $this->redirect()->toRoute('zfcadmin/cmsblocks');
    }
}
