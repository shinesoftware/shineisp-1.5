<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace CustomerAdmin\Controller;

use Customer\Service\AddressServiceInterface;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ZfcDatagrid\Column;
use ZfcDatagrid\Column\Type;
use ZfcDatagrid\Column\Style;
use ZfcDatagrid\Column\Formatter;
use ZfcDatagrid\Filter;
use Zend\Db\Sql\Select;
use Customer\Model\UrlRewrites as UrlRewrites;
use Customer\Service\CustomerServiceInterface;

class IndexController extends AbstractActionController
{
	protected $recordService;
	protected $addressService;
	
	public function __construct(CustomerServiceInterface $recordService, AddressServiceInterface $addressService)
	{
		$this->customerService = $recordService;
		$this->addressService = $addressService;
	}
	
    /**
     * Add new information
     */
    public function addAction ()
    {
    	 
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('Customer\Form\CustomerForm');
    
    	$viewModel = new ViewModel(array (
    			'form' => $form,
    	));
    
    	$viewModel->setTemplate('customer-admin/index/edit');
    	return $viewModel;
    }
    
    /**
     * Edit the main customer information
     */
    public function editAction ()
    {
    	$id = $this->params()->fromRoute('id');
    	$address = null;
    	
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('Customer\Form\CustomerForm');
    
    	// Get the record by its id
    	$customer = $this->customerService->find($id);
    	
    	// Get the address of the customer
    	if(!empty($customer) && $customer->getId()){
    		$address = $this->addressService->findByParameter('customer_id', $customer->getId());
    	}

    	// Bind the data in the form
    	if (! empty($customer)) {
    		$form->bind($customer);
    	}
    
    	$viewModel = new ViewModel(array (
    			'form' => $form,
    			'address' => $address,
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
    	$select->from(array ('c' => 'customer'));

    	$grid = $this->getServiceLocator()->get('ZfcDatagrid\Datagrid');
    	$grid->setDefaultItemsPerPage(10);
    	$grid->setDataSource($select, $dbAdapter);
    
    	$colId = new Column\Select('id', 'c');
    	$colId->setLabel('Id');
    	$colId->setIdentity();
    	$grid->addColumn($colId);
    	
    	$col = new Column\Select('company', 'c');
    	$col->setLabel(_('Company'));
    	$col->setWidth(15);
    	$grid->addColumn($col);
    	
    	$col = new Column\Select('firstname', 'c');
    	$col->setLabel(_('Last name'));
    	$col->setWidth(15);
    	$grid->addColumn($col);
    	
    	$col = new Column\Select('lastname', 'c');
    	$col->setLabel(_('First name'));
    	$col->setWidth(15);
    	$grid->addColumn($col);
    	
    	$colType = new Type\DateTime('Y-m-d H:i:s', \IntlDateFormatter::SHORT, \IntlDateFormatter::SHORT);
    	$colType->setSourceTimezone('Europe/Rome');
    	$colType->setOutputTimezone('UTC');
    	$colType->setLocale('it_IT');
    
    	$col = new Column\Select('createdat', 'c');
    	$col->setType($colType);
    	$col->setLabel(_('Created At'));
    	$grid->addColumn($col);
    
//     	$col = new Column\Select('visible', 'c');
//     	$col->setType(new \ZfcDatagrid\Column\Type\String());
//     	$col->setLabel(_('Visible'));
//     	$col->setTranslationEnabled(true);
//     	$col->setFilterSelectOptions(array (
//     			'' => '-',
//     			'0' => 'No',
//     			'1' => 'Yes'
//     	));
//     	$col->setReplaceValues(array (
//     			'' => '-',
//     			'0' => 'No',
//     			'1' => 'Yes'
//     	));
//     	$grid->addColumn($col);
    
    	// Add actions to the grid
    	$showaction = new Column\Action\Button();
    	$showaction->setAttribute('href', "/admin/customer/edit/" . $showaction->getColumnValuePlaceholder(new Column\Select('id', 'c')));
    	$showaction->setAttribute('class', 'btn btn-xs btn-success');
    	$showaction->setLabel(_('edit'));
    
    	$delaction = new Column\Action\Button();
    	$delaction->setAttribute('href', '/admin/customer/delete/' . $delaction->getRowIdPlaceholder());
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
    				'controller' => 'customer',
    				'action' => 'index'
    		));
    	}
    
    	$post = $this->request->getPost();
    	$form = $this->getServiceLocator()->get('FormElementManager')->get('Customer\Form\CustomerForm');
    	$form->setData($post);
    	$inputFilter = $this->getServiceLocator()->get('CustomerFilter');
    	$form->setInputFilter($inputFilter);
    	
    	if (!$form->isValid()) {
    		$viewModel = new ViewModel(array (
    				'error' => true,
    				'form' => $form,
    		));
    		
    		$viewModel->setTemplate('customer-admin/index/edit');
    		return $viewModel;
    	}
    
    	// Get the posted vars
    	$data = $form->getData();
    	
    	// Save the data in the database
    	$record = $this->customerService->save($data);
    	$record = $this->addressService->save($data['address']);
    
    	$this->flashMessenger()->setNamespace('success')->addMessage('The information have been saved.');
    
    	return $this->redirect()->toRoute('zfcadmin/customer/default', array ('action' => 'edit', 'id' => $record->getId()));
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
    		$this->customerService->delete($id);
    
    		// Go back showing a message
    		$this->flashMessenger()->setNamespace('success')->addMessage('The record has been deleted!');
    		return $this->redirect()->toRoute('zfcadmin/customer/default');
    	}
    
    	$this->flashMessenger()->setNamespace('danger')->addMessage('The record has been not deleted!');
    	return $this->redirect()->toRoute('zfcadmin/customer/default');
    }
    
    /**
     * Delete the address 
     *
     * @return \Zend\Http\Response
     */
    public function deladdressAction ()
    {
    	$id = $this->params()->fromRoute('id');
    
    	if (is_numeric($id)) {
    
    		$address = $this->addressService->find($id);
    		$customerId = $address->getCustomerId();
    		
    		// Delete the record informaiton
    		$this->addressService->delete($id);
    
    		// Go back showing a message
    		$this->flashMessenger()->setNamespace('success')->addMessage('The record has been deleted!');
    		return $this->redirect()->toRoute('zfcadmin/customer/default', array('action' => 'edit', 'id' => $customerId));
    	}
    
    	$this->flashMessenger()->setNamespace('danger')->addMessage('The record has been not deleted!');
    	return $this->redirect()->toRoute('zfcadmin/customer/default');
    }
}
