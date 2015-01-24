<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace BaseSettings\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	protected $recordService;
	protected $translator;
	
	/**
	 * preDispatch of the index
	 *
	 * (non-PHPdoc)
	 * @see Zend\Mvc\Controller.AbstractActionController::onDispatch()
	 */
	public function onDispatch(\Zend\Mvc\MvcEvent $e){
	    $this->translator = $e->getApplication()->getServiceManager()->get('translator');
	    return parent::onDispatch( $e );
	}
	
	public function __construct(\Base\Service\SettingsServiceInterface $recordService)
	{
		$this->recordService = $recordService;
	}
	
    public function indexAction ()
    {
    	$formData = array();
		$form = $this->getServiceLocator()->get('FormElementManager')->get('BaseSettings\Form\GenericForm');
    
		// Get the custom settings of this module: "Base"
		$records = $this->recordService->findByModule('Base');
		
		if(!empty($records)){
			foreach ($records as $record){
				$formData[$record->getParameter()] = $record->getValue(); 
			}
		}
		
		// Fill the form with the data
		$form->setData($formData);
		
    	$viewModel = new ViewModel(array (
    			'form' => $form,
    	));
    
    	$viewModel->setTemplate('base-settings/index/index');
    	return $viewModel;
    }
	
    public function processAction ()
    {
    	if (! $this->request->isPost()) {
    		return $this->redirect()->toRoute('zfcadmin/base');
    	}
    	
    	try{
	    	$settingsEntity = new \Base\Entity\Settings();
	    	
	    	$post = $this->request->getPost();
	    	$form = $this->getServiceLocator()->get('FormElementManager')->get('BaseSettings\Form\GenericForm');
	    	$form->setData($post);
	    	
	    	if (!$form->isValid()) {
	    	
	    		// Get the record by its id
	    		$viewModel = new ViewModel(array (
	    				'error' => true,
	    				'form' => $form,
	    		));
	    		$viewModel->setTemplate('base-settings/index/index');
	    		return $viewModel;
	    	}
	    	
	    	$data = $form->getData();
	    	
	    	// Cleanup the custom settings
	   		$this->recordService->cleanup('Base');
	    	
	    	foreach ($data as $parameter => $value){
	    		if($parameter == "submit"){
	    			continue;
	    		}
	
	    		$settingsEntity->setModule('Base');
	    		$settingsEntity->setParameter($parameter);
	    		$settingsEntity->setValue($value);
	    		$this->recordService->save($settingsEntity); // Save the data in the database
	    		
	    	}
	    	
	    	$this->flashMessenger()->setNamespace('success')->addMessage($this->translator->translate('The information have been saved.'));
    		
    	}catch(\Exception $e){
    		$this->flashMessenger()->setNamespace('error')->addMessage($e->getMessage());
    	}
    	
    	return $this->redirect()->toRoute('zfcadmin/base');
    }
}
