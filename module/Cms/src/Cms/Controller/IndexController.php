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
    	$page = $this->pageService->findByUri($slug);
    	$parent = $this->pageService->find($page->getParentId());
		 
    	if($page){
    		$layout = new \Cms\Model\Layout($page);
    		$template = $layout->getTemplate();
	    	$viewModel  = new ViewModel(array('page' => $page, 'parent' => $parent));
	    	$viewModel->setTemplate('cms/index/' . $template);
    	}else{
    		$viewModel  = new ViewModel();
    		$viewModel->setTemplate('cms/index/notfound');
    	}
    	return $viewModel;
    }
}
