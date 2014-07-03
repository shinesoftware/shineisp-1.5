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
use Cms\Model\UrlRewrites as UrlRewrites;

class BlockController extends AbstractActionController
{
	protected $blockService;
	protected $datagrid;
	protected $form;
	protected $filter;
	protected $settings;
	
	/**
	 * Class constructor
	 * 
	 * @param \Cms\Service\BlockServiceInterface $blockService
	 * @param \Cms\Form\BlockForm $form
	 * @param \Cms\Form\BlockFilter $formfilter
	 * @param \ZfcDatagrid\Datagrid $datagrid
	 * @param \Base\Service\SettingsServiceInterface $settings
	 */
	public function __construct(\Cms\Service\BlockServiceInterface $blockService,
								\Cms\Form\BlockForm $form, 
								\Cms\Form\BlockFilter $formfilter, 
								\ZfcDatagrid\Datagrid $datagrid, 
								\Base\Service\SettingsServiceInterface $settings)
	{
		$this->blockService = $blockService;
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
    
    	$viewModel->setTemplate('cms-admin/block/edit');
    	return $viewModel;
    }
    
    /**
     * Edit the main block information
     */
    public function editAction ()
    {
    	$id = $this->params()->fromRoute('id');
    	 
    	$form = $this->form;
    
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
