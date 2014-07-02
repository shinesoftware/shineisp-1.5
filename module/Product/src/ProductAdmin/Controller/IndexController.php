<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ProductAdmin\Controller;

use Base\Service\SettingsServiceInterface;

use Base\Entity\Settings;

use Product\Entity\ContactInterface;
use Product\Service\AddressServiceInterface;
use Product\Service\ContactServiceInterface;
use Product\Service\ProductServiceInterface;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ZfcDatagrid\Column;
use ZfcDatagrid\Column\Type;
use ZfcDatagrid\Column\Style;
use ZfcDatagrid\Column\Formatter;
use ZfcDatagrid\Filter;
use Zend\Db\Sql\Select;
use Product\Model\UrlRewrites as UrlRewrites;
use Zend\InputFilter\InputFilter;

class IndexController extends AbstractActionController
{
	protected $recordService;
	protected $addressService;
	protected $contactService;
	protected $settings;
	
	public function __construct(ProductServiceInterface $recordService, SettingsServiceInterface $settings)
	{
		$this->productService = $recordService;
		$this->settings = $settings;
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
	
    /**
     * Add new information
     */
    public function addAction ()
    {
    	 
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('ProductAdmin\Form\ProductForm');
    
    	$viewModel = new ViewModel(array (
    			'form' => $form,
    	));
    
    	$viewModel->setTemplate('product-admin/index/edit');
    	return $viewModel;
    }
    
    /**
     * Edit the main product information
     */
    public function editAction ()
    {
    	$id = $this->params()->fromRoute('id');
    	$address = null;
    	$contact = null;
    	
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('ProductAdmin\Form\ProductForm');
    
    	// Get the record by its id
    	$product = $this->productService->find($id);
    	
    	// Get the address of the product
    	if(!empty($product) && $product->getId()){
//     		$contact = $this->contactService->findByParameter('product_id', $product->getId());
    	}else{
    		$this->flashMessenger()->setNamespace('danger')->addMessage('The record has been not found!');
    		return $this->redirect()->toRoute('zfcadmin/product/default');
    	}

    	// Bind the data in the form
    	if (! empty($product)) {
    		$form->bind($product);
    	}
    
    	$viewModel = new ViewModel(array (
    			'form' => $form,
//     			'address' => $address,
    	));
    
    	return $viewModel;
    }
    
    // Create the list grid
    private function createGrid ()
    {
    	$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    	$select = new Select();
    	$select->from(array ('p' => 'product'));

    	$RecordsPerPage = $this->settings->getValueByParameter('Product', 'recordsperpage');
    	
    	$grid = $this->getServiceLocator()->get('ZfcDatagrid\Datagrid');
    	$grid->setDefaultItemsPerPage($RecordsPerPage);
    	$grid->setDataSource($select, $dbAdapter);
    
    	$colId = new Column\Select('id', 'p');
    	$colId->setLabel('Id');
    	$colId->setIdentity();
    	$grid->addColumn($colId);
    	
    	$col = new Column\Select('company', 'p');
    	$col->setLabel(_('Company'));
    	$col->setWidth(15);
    	$grid->addColumn($col);
    	
    	$col = new Column\Select('firstname', 'p');
    	$col->setLabel(_('Last name'));
    	$col->setWidth(15);
    	$grid->addColumn($col);
    	
    	$col = new Column\Select('lastname', 'p');
    	$col->setLabel(_('First name'));
    	$col->setWidth(15);
    	$grid->addColumn($col);
    	
    	$colType = new Type\DateTime('Y-m-d H:i:s', \IntlDateFormatter::SHORT, \IntlDateFormatter::SHORT);
    	$colType->setSourceTimezone('Europe/Rome');
    	$colType->setOutputTimezone('UTC');
    	$colType->setLocale('it_IT');
    
    	$col = new Column\Select('createdat', 'p');
    	$col->setType($colType);
    	$col->setLabel(_('Created At'));
    	$grid->addColumn($col);
    
    	// Add actions to the grid
    	$showaction = new Column\Action\Button();
    	$showaction->setAttribute('href', "/admin/product/edit/" . $showaction->getColumnValuePlaceholder(new Column\Select('id', 'p')));
    	$showaction->setAttribute('class', 'btn btn-xs btn-success');
    	$showaction->setLabel(_('edit'));
    
    	$delaction = new Column\Action\Button();
    	$delaction->setAttribute('href', '/admin/product/delete/' . $delaction->getRowIdPlaceholder());
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
    				'controller' => 'product',
    				'action' => 'index'
    		));
    	}
    	
    	$request = $this->getRequest();
    	$post = $this->request->getPost();
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('ProductAdmin\Form\ProductForm');
    	
    	$post = array_merge_recursive(
    			$request->getPost()->toArray(),
    			$request->getFiles()->toArray()
    	);
    	
    	$form->setData($post);
    	
    	// get the input file filter in order to set the right file upload path
    	$inputFilter = $this->getServiceLocator()->get('AdminProductFilter');

    	// set the input filter
    	$form->setInputFilter($inputFilter);
    	
    	if (!$form->isValid()) {
    		$viewModel = new ViewModel(array (
    				'error' => true,
    				'form' => $form,
    		));
    		
    		$viewModel->setTemplate('product-admin/index/edit');
    		return $viewModel;
    	}
    
    	// Get the posted vars
    	$data = $form->getData();

    	// Save the data in the database
    	$record = $this->productService->save($data);
    	
    	$this->flashMessenger()->setNamespace('success')->addMessage('The information have been saved.');
    
    	return $this->redirect()->toRoute('zfcadmin/product/default', array ('action' => 'edit', 'id' => $record->getId()));
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
    		$this->productService->delete($id);
    
    		// Go back showing a message
    		$this->flashMessenger()->setNamespace('success')->addMessage('The record has been deleted!');
    		return $this->redirect()->toRoute('zfcadmin/product/default');
    	}
    
    	$this->flashMessenger()->setNamespace('danger')->addMessage('The record has been not deleted!');
    	return $this->redirect()->toRoute('zfcadmin/product/default');
    }
    
}
