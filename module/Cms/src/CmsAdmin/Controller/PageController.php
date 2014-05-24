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
use Cms\Service\PageServiceInterface;

class PageController extends AbstractActionController
{
	protected $pageService;
	
	public function __construct(PageServiceInterface $pageService)
	{
		$this->pageService = $pageService;
	}
	
    /**
     * Add new information
     */
    public function addAction ()
    {
    	 
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('Cms\Form\PageForm');
    
    	$viewModel = new ViewModel(array (
    			'form' => $form,
    	));
    
    	$viewModel->setTemplate('cms-admin/page/edit');
    	return $viewModel;
    }
    
    /**
     * Edit the main page information
     */
    public function editAction ()
    {
    	$id = $this->params()->fromRoute('id');
    	 
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('Cms\Form\PageForm');
    
    	// Get the record by its id
    	$rspage = $this->pageService->find($id);
    
    	// Bind the data in the form
    	if (! empty($rspage)) {
    		$form->bind($rspage);
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
    	$select->from(array ('p' => 'page'))->join(array('c' => 'page_category'), 'p.category_id = c.id', array('category'), 'left');;
    
    	$grid = $this->getServiceLocator()->get('ZfcDatagrid\Datagrid');
    	$grid->setDefaultItemsPerPage(100);
    	$grid->setDataSource($select, $dbAdapter);
    
    	$colId = new Column\Select('id', 'p');
    	$colId->setLabel('Id');
    	$colId->setIdentity();
    	$grid->addColumn($colId);
    	
    	$col = new Column\Select('title', 'p');
    	$col->setLabel(_('Title'));
    	$col->setWidth(15);
    	$grid->addColumn($col);
    	
    	$col = new Column\Select('tags', 'p');
    	$col->setLabel(_('Tags'));
    	$grid->addColumn($col);
    	
    	$colType = new Type\DateTime('Y-m-d H:i:s', \IntlDateFormatter::SHORT, \IntlDateFormatter::SHORT);
    	$colType->setSourceTimezone('Europe/Rome');
    	$colType->setOutputTimezone('UTC');
    	$colType->setLocale('it_IT');
    
    	$col = new Column\Select('createdat', 'p');
    	$col->setType($colType);
    	$col->setLabel(_('Created At'));
    	$grid->addColumn($col);
    
    	$col = new Column\Select('updatedat', 'p');
    	$col->setType($colType);
    	$col->setLabel(_('Updated At'));
    	$grid->addColumn($col);
    
    	$col = new Column\Select('category', 'c');
    	$col->setLabel(_('Category'));
    	$col->addStyle(new Style\Bold());
    	$grid->addColumn($col);
    
    	$col = new Column\Select('visible', 'p');
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
    	$showaction->setAttribute('href', "/admin/cmspages/edit/" . $showaction->getColumnValuePlaceholder(new Column\Select('id', 'p')));
    	$showaction->setAttribute('class', 'btn btn-xs btn-success');
    	$showaction->setLabel(_('edit'));
    
    	$delaction = new Column\Action\Button();
    	$delaction->setAttribute('href', '/admin/cmspages/delete/' . $delaction->getRowIdPlaceholder());
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
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('Cms\Form\PageForm');
    	$form->setData($post);
    	
    	$inputFilter = $this->getServiceLocator()->get('PageFilter');
    	$form->setInputFilter($inputFilter);
    	 
    	if (!$form->isValid()) {
    
    		// Get the record by its id
    		$viewModel = new ViewModel(array (
    				'error' => true,
    				'form' => $form,
    		));
    		$viewModel->setTemplate('cms-admin/page/edit');
    		return $viewModel;
    	}
    
    	// Get the posted vars
    	$pageData = $form->getData();
    	$slug = $pageData->getSlug();
    	$parent = 0 == $pageData->getParentId() ? null : $pageData->getParentId();
    	
    	$strslug = !empty($slug) ? $slug : $urlRewrite->format($pageData->getTitle());
    	$pageData->setSlug($strslug);
    	$pageData->setParentId($parent);
    	
    	// Save the data in the database
    	$page = $this->pageService->save($pageData);
    
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
    		$this->pageService->delete($id);
    
    		// Go back showing a message
    		$this->flashMessenger()->setNamespace('success')->addMessage('The record has been deleted!');
    		return $this->redirect()->toRoute('zfcadmin/cmspages');
    	}
    
    	$this->flashMessenger()->setNamespace('danger')->addMessage('The record has been not deleted!');
    	return $this->redirect()->toRoute('zfcadmin/cmspages');
    }
}
