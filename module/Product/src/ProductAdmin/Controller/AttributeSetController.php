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
* @package Product
* @subpackage Controller
* @author Michelangelo Turillo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Turillo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/

namespace ProductAdmin\Controller;

use Zend\InputFilter\InputFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AttributeSetController extends AbstractActionController
{
	protected $recordService;
	protected $attributes;
	protected $group;
	protected $groupIdx;
	protected $datagrid;
	protected $form;
	protected $filter;
	protected $settings;
	
	/**
	 * Class Constructor
	 * 
	 * @param \Product\Service\ProductAttributeSetServiceInterface $recordService
	 * @param \Product\Service\ProductAttributeServiceInterface $attributes
	 * @param \Product\Service\ProductAttributeGroupServiceInterface $group
	 * @param \Product\Service\ProductAttributeIdxServiceInterface $groupIdx
	 * @param \ProductAdmin\Form\AttributeSetForm $form
	 * @param \ProductAdmin\Form\AttributeSetFilter $formfilter
	 * @param \ZfcDatagrid\Datagrid $datagrid
	 * @param \Base\Service\SettingsServiceInterface $settings
	 */
	public function __construct(\Product\Service\ProductAttributeSetServiceInterface $recordService, 
								\Product\Service\ProductAttributeServiceInterface $attributes,
								\Product\Service\ProductAttributeGroupServiceInterface $group,
								\Product\Service\ProductAttributeIdxServiceInterface $groupIdx,
								\ProductAdmin\Form\AttributeSetForm $form, 
								\ProductAdmin\Form\AttributeSetFilter $formfilter, 
								\ZfcDatagrid\Datagrid $datagrid, 
								\Base\Service\SettingsServiceInterface $settings)
	{
		$this->recordService = $recordService;
		$this->attributes = $attributes;
		$this->group = $group;
		$this->groupIdx = $groupIdx;
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
    
    	$viewModel->setTemplate('product-admin/attribute-set/edit');
    	return $viewModel;
    }
    
    /**
     * Edit the main product information
     */
    public function editAction ()
    {
    	$id = $this->params()->fromRoute('id');
    	$request = $this->getRequest();
    	$server  = $request->getServer();
    	
    	$form = $this->form;
    
    	// Get the attribute set by its id
    	$attributeSet = $this->recordService->find($id);
    	
    	// get all the attributes in order to show a list of the available attributes
    	$attributes = $this->attributes->findAll();
    	
    	// get all the attribute ids attached to the attribute group
    	$attribute_selected_ids = $this->group->getAllAttributeIds($this->group->findbyAttributeSetId($id));
    	
    	// this is executed by the fancytree ajax async request (javascript)
	    if ($request->isXmlHttpRequest()) { 
	    	$attributetree = $this->group->createTree($this->group->getGroupAttributes($id));
    		die(json_encode($attributetree));
    	}

    	if(!empty($attributeSet) && $attributeSet->getId()){
			$attributeSet->setAttributes($this->recordService->findByAttributeSet($id)); // Get the attributes
    	}else{
    		$this->flashMessenger()->setNamespace('danger')->addMessage('The record has been not found!');
    		return $this->redirect()->toRoute('zfcadmin/product/sets/default');
    	}

    	// Bind the data in the form
    	if (! empty($attributeSet)) {
    		$form->bind($attributeSet);
    	}
    
    	$viewModel = new ViewModel(array (
    			'form' => $form,
    			'attributes' => $attributes,
    			'attributeselids' => $attribute_selected_ids,
    	));
    
    	return $viewModel;
    }
    
    /**
     * Json 
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function treeAction ()
    {
    	$response = array();
    	$response['status'] = "ok";
    	$response['mex'] = "";
    	
    	$request = $this->getRequest();
    	$params = $this->params()->fromPost();
    	if ($request->isXmlHttpRequest() && is_numeric($params['key'])) {
    		$response['isuserdefined'] = 0;
    		$attribute = $this->attributes->find($params['key']);
    		if ($attribute->getIsUserDefined()){
    			$response['isuserdefined'] = 1;
    		}else{
    			$response['mex'] = "This attribute cannot be deleted.";
    		}
    	}
    	die(json_encode($response));
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
    	$form = $this->form;
    	$form->setData($post);
    	
    	// get the input file filter in order to set the right file upload path
    	$inputFilter = $this->filter;

    	// set the input filter
    	$form->setInputFilter($inputFilter);
    	
    	if (!$form->isValid()) {
    		$viewModel = new ViewModel(array (
    				'error' => true,
    				'form' => $form,
    		));
    		
    		$viewModel->setTemplate('product-admin/attribute-set/edit');
    		return $viewModel;
    	}
    
    	// Get the posted vars
    	$data = $form->getData();
    	
    	$attributes = $this->getAttributesFromTree($post['attributes']);

    	// set the attributes
    	$data->setAttributes($attributes);
    	
    	// Save the data in the database
    	$record = $this->recordService->save($data);
    	
    	$attributeSetId = $record->getId();
    	
    	$this->flashMessenger()->setNamespace('success')->addMessage('The information have been saved.');
    
    	return $this->redirect()->toRoute('zfcadmin/product/sets', array ('action' => 'edit', 'id' => $attributeSetId));
    }
    
    /**
     * get the attributes posted from the form tree object
     * 
     * @param string $data
     */
    private function getAttributesFromTree($data){
    	$attributes = array();
    	$i = 0;
    	$treeData = json_decode($data, true);
    	$attrTreedata = $treeData['children'];

    	if(!empty($treeData['children'])){
	    	foreach ($treeData['children'] as $group){
	    		if(!empty($group['children'])){		
		    		foreach ($group['children'] as $item){
		    			$attributes[$i]['attribute_group_id'] = $group['key'];
		    			$attributes[$i]['attribute_group_title'] = $group['title'];
		    			$attributes[$i]['attribute_id'] = $item['key'];
			    		$attributes[$i]['attribute_name'] = $item['title'];
			    		$i++;
			    	}
			    }
	    	}
    	}
    	return $attributes;
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
    
    	    $record = $this->recordService->find($id);
    	    
    	    if(!$record->getDefault()){
        		
    	        // Delete the record informaiton
        		$this->recordService->delete($id);
        
        		// Go back showing a message
        		$this->flashMessenger()->setNamespace('success')->addMessage('The record has been deleted!');
        		return $this->redirect()->toRoute('zfcadmin/product/sets');
    	    }else{
    	        // Go back showing a message
    	        $this->flashMessenger()->setNamespace('danger')->addMessage('The attribute set selected cannot be deleted because it has been set as default!');
    	        return $this->redirect()->toRoute('zfcadmin/product/sets');
    	    }
    	}
    
    	$this->flashMessenger()->setNamespace('danger')->addMessage('The record has been not deleted!');
    	return $this->redirect()->toRoute('zfcadmin/product/sets');
    }
    
}
