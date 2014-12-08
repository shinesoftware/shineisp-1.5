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
 * @package Cms
 * @subpackage Controller
 * @author Michelangelo Turillo <mturillo@shinesoftware.com>
 * @copyright 2014 Michelangelo Turillo.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @link http://shinesoftware.com
 * @version @@PACKAGE_VERSION@@
 */


namespace CmsAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PageCategoryController extends AbstractActionController
{
	protected $recordcategoryService;
	protected $datagrid;
	protected $form;
	protected $filter;
	protected $settings;
	protected $translator;
	
	/**
	 * preDispatch of the page
	 *
	 * (non-PHPdoc)
	 * @see Zend\Mvc\Controller.AbstractActionController::onDispatch()
	 */
	public function onDispatch(\Zend\Mvc\MvcEvent $e){
	    $this->translator = $e->getApplication()->getServiceManager()->get('translator');
	    return parent::onDispatch( $e );
	}
	
	/**
	 * Class constructor
	 * 
	 * @param \Cms\Service\PageCategoryServiceInterface $recordcategoryService
	 * @param \Cms\Form\PageForm $form
	 * @param \Cms\Form\PageFilter $formfilter
	 * @param \ZfcDatagrid\Datagrid $datagrid
	 * @param \Base\Service\SettingsServiceInterface $settings
	 */
	public function __construct(\Cms\Service\PageCategoryServiceInterface $recordcategoryService,
								\Cms\Form\PageCategoryForm $form, 
								\Cms\Form\PageCategoryFilter $formfilter, 
								\ZfcDatagrid\Datagrid $datagrid, 
								\Base\Service\SettingsServiceInterface $settings)
	{
		$this->pagecategoryService = $recordcategoryService;
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
	
		$viewModel->setTemplate('cms-admin/page-category/edit');
		return $viewModel;
	}
	
    /**
     * Edit the record
     */
    public function editAction ()
    {
    	$id = $this->params()->fromRoute('id');
    	 
    	$form = $this->form;
    
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
    	$form = $this->form;
    	$form->setData($post);
    	
    	$inputFilter = $this->filter;
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
    	$data = $form->getData();
    	
    	// Save the data in the database
    	$record = $this->pagecategoryService->save($data);
    
    	$this->flashMessenger()->setNamespace('success')->addMessage($this->translator->translate('The information have been saved.'));
    
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
    		$this->pagecategoryService->delete($id);
    
    		// Go back showing a message
    		$this->flashMessenger()->setNamespace('success')->addMessage($this->translator->translate('The record has been deleted!'));
    		return $this->redirect()->toRoute('zfcadmin/cmscategory');
    	}
    
    	$this->flashMessenger()->setNamespace('danger')->addMessage($this->translator->translate('The record has been not deleted!'));
    	return $this->redirect()->toRoute('zfcadmin/cmscategory');
    }
}
