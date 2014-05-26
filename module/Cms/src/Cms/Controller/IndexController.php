<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Cms\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Cms\Service\PageServiceInterface;

class IndexController extends AbstractActionController
{
	protected $pageService;
	protected $translator;
	
	/**
	 * preDispatch event of the page
	 * 
	 * (non-PHPdoc)
	 * @see Zend\Mvc\Controller.AbstractActionController::onDispatch()
	 */
	public function onDispatch(\Zend\Mvc\MvcEvent $e){
		$this->translator = $e->getApplication()->getServiceManager()->get('translator');
		
		return parent::onDispatch( $e );
	}
	
	public function __construct(PageServiceInterface $pageService)
	{
		$this->pageService = $pageService;
	}
	
    public function indexAction ()
    {
    	$viewModel  = new ViewModel(array('pages' => $this->pageService->findAll()));
    	return $viewModel;
    }
    
    public function pageAction ()
    {
    	$slug = $this->params()->fromRoute('page');
    	
    	if(empty($slug)){
    		return $this->redirect()->toRoute('home');
    	}

    	// get the page by its slug code
    	$page = $this->pageService->findByUri($slug, $this->translator->getLocale());

    	if($page){
    		
    		// get the parent page
    		$parent = $this->pageService->find($page->getParentId());
    		
    		// get the layout of the page
    		$layout = new \Cms\Model\Layout($page);

    		// get the template set for the page
    		$template = $layout->getTemplate();
	    	
    		// set the view for the page
    		$viewModel  = new ViewModel(array('page' => $page, 'parent' => $parent));
	    	$viewModel->setTemplate('cms/index/' . $template);
	    	
    	}else{
    		$viewModel  = new ViewModel();
    		$viewModel->setTemplate('cms/index/notfound');
    	}
    	
    	return $viewModel;
    }
}
