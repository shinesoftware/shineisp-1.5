<?php
/**
* Copyright (c) 2014 Shine Software.
* All rights reserved.
*
* Redistribution and use in source and binary forms, with or without
* modification, are permitted provided that the following conditions
* are met:
*
* * Redistributions of source code must retain the above copyright
* notice, this list of conditions and the following disclaimer.
*
* * Redistributions in binary form must reproduce the above copyright
* notice, this list of conditions and the following disclaimer in
* the documentation and/or other materials provided with the
* distribution.
*
* * Neither the names of the copyright holders nor the names of the
* contributors may be used to endorse or promote products derived
* from this software without specific prior written permission.
*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
* "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
* LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
* FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
* COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
* INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
* BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
* LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
* CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
* LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
* ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
* POSSIBILITY OF SUCH DAMAGE.
*
* @package Customer
* @subpackage Controller
* @author Michelangelo Turillo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Turillo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/

namespace CustomerAdmin\Controller;

use Zend\InputFilter\InputFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	protected $recordService;
	protected $addressService;
	protected $contactService;
	protected $datagrid;
	protected $form;
	protected $filter;
	protected $settings;
	
	/**
	 * Class Constructor
	 * 
	 * @param \Customer\Service\CustomerServiceInterface $recordService
	 * @param \Customer\Service\AddressServiceInterface $addressService
	 * @param \Customer\Service\ContactServiceInterface $contactService
	 * @param \CustomerAdmin\Form\CustomerForm $form
	 * @param \CustomerAdmin\Form\CustomerFilter $formfilter
	 * @param \ZfcDatagrid\Datagrid $datagrid
	 * @param \Base\Service\SettingsServiceInterface $settings
	 */
	public function __construct(\Customer\Service\CustomerServiceInterface $recordService, 
								\Customer\Service\AddressServiceInterface $addressService, 
								\Customer\Service\ContactServiceInterface $contactService, 
								\CustomerAdmin\Form\CustomerForm $form, 
								\CustomerAdmin\Form\CustomerFilter $formfilter, 
								\ZfcDatagrid\Datagrid $datagrid, 
								\Base\Service\SettingsServiceInterface $settings)
	{
		$this->customerService = $recordService;
		$this->addressService = $addressService;
		$this->contactService = $contactService;
		$this->datagrid = $datagrid;
		$this->form = $form;
		$this->filter = $formfilter;
		$this->settings = $settings;
	}
	
	
	/**
	 * List of all records
	 */
	public function indexAction ()
	{
		// prepare the datagrid
		$this->datagrid->render();
		
		// get the datagrid ready to be shown in the template view
		$response = $this->datagrid->getResponse();
		
		if ($this->datagrid->isHtmlInitReponse()) {
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
    	 
    	$form = $this->form;
    
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
    	$contact = null;
    	
    	$form = $this->form;
    
    	// Get the record by its id
    	$customer = $this->customerService->find($id);
    	
    	// Get the address of the customer
    	if(!empty($customer) && $customer->getId()){
    		$address = $this->addressService->findByParameter('customer_id', $customer->getId());
    		$contact = $this->contactService->findByParameter('customer_id', $customer->getId());
    	}else{
    		$this->flashMessenger()->setNamespace('danger')->addMessage('The record has been not found!');
    		return $this->redirect()->toRoute('zfcadmin/customer/default');
    	}

    	// Bind the data in the form
    	if (! empty($customer)) {
    		$form->bind($customer);
    	}
    
    	$viewModel = new ViewModel(array (
    			'form' => $form,
    			'address' => $address,
    			'contact' => $contact,
    	));
    
    	return $viewModel;
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
    	
    	$request = $this->getRequest();
    	$post = $this->request->getPost();
    	$form = $this->form;
    	
    	$post = array_merge_recursive(
    			$request->getPost()->toArray(),
    			$request->getFiles()->toArray()
    	);
    	
    	$form->setData($post);
    	
    	// create the customer upload directories
    	@mkdir(PUBLIC_PATH . '/documents/');
    	@mkdir(PUBLIC_PATH . '/documents/customers');
    	
    	// get the input file filter in order to set the right file upload path
    	$inputFilter = $this->formfilter;
    	
    	// customize the path
    	if(!empty($post['id'])){
    		@mkdir(PUBLIC_PATH . '/documents/customers/' . $post['id']);
    		$path = PUBLIC_PATH . '/documents/customers/' . $post['id'] . '/';
    		$fileFilter = $inputFilter->get('file')->getFilterChain()->getFilters()->toArray();
    		$fileFilter[0]->setTarget($path);
    	}
    	
    	// set the input filter
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
    	$address = $data->getAddress();

    	// Save the data in the database
    	$record = $this->customerService->save($data);
    	
    	// Check if the contact has been set
    	if(!empty($post['contact'])){
    		$contact = new \Customer\Entity\Contact();
    		$contact->setContact($post['contact']);
    		$contact->setTypeId($post['contacttype']);
    		$contact->setCustomerId($record->getId());
    		$this->contactService->save($contact);
    	}
    	
    	// Check if the address has been set
    	if($address->getStreet() && $address->getCity()){
	
	    	// Set the id of the customer
	    	$address->setCustomerId($record->getId());
	    	
	    	// Save the address of the customer
	    	$this->addressService->save($data->getAddress());
    	}
    	
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
    		
    		// Delete the record information
    		$this->addressService->delete($id);
    
    		// Go back showing a message
    		$this->flashMessenger()->setNamespace('success')->addMessage('The record has been deleted!');
    		return $this->redirect()->toRoute('zfcadmin/customer/default', array('action' => 'edit', 'id' => $customerId));
    	}
    
    	$this->flashMessenger()->setNamespace('danger')->addMessage('The record has been not deleted!');
    	return $this->redirect()->toRoute('zfcadmin/customer/default');
    }
    
    /**
     * Delete the contact 
     *
     * @return \Zend\Http\Response
     */
    public function delcontactAction ()
    {
    	$id = $this->params()->fromRoute('id');
    
    	if (is_numeric($id)) {
    
    		$contact = $this->contactService->find($id);
    		$customerId = $contact->getCustomerId();
    		
    		// Delete the record information
    		$this->contactService->delete($id);
    
    		// Go back showing a message
    		$this->flashMessenger()->setNamespace('success')->addMessage('The record has been deleted!');
    		return $this->redirect()->toRoute('zfcadmin/customer/default', array('action' => 'edit', 'id' => $customerId));
    	}
    
    	$this->flashMessenger()->setNamespace('danger')->addMessage('The record has been not deleted!');
    	return $this->redirect()->toRoute('zfcadmin/customer/default');
    }
}
