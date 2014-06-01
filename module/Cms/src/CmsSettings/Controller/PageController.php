<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace CmsSettings\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PageController extends AbstractActionController
{
	protected $recordService;
	
	public function __construct(\Base\Service\SettingsServiceInterface $recordService)
	{
		$this->pageService = $recordService;
	}
	
    public function indexAction ()
    {
		$form = $this->getServiceLocator()->get('FormElementManager')->get('CmsSettings\Form\PageForm');
    
    	$viewModel = new ViewModel(array (
    			'form' => $form,
    	));
    
    	$viewModel->setTemplate('cms-settings/page/index');
    	return $viewModel;
    }
}
