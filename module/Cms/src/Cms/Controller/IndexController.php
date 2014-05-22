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

class IndexController extends AbstractActionController
{
    public function indexAction ()
    {
    	$pageTable = $this->getServiceLocator()->get('PageTable');
    	$viewModel  = new ViewModel(array('pages' => $pageTable->fetchAll()));
    	return $viewModel;
    }
    
    public function pageAction ()
    {
    	$uri = $this->params()->fromRoute('page');
    	$pageTable = $this->getServiceLocator()->get('PageTable');
    	$page = $pageTable->getRecordByUri($uri);
    	$parent = $pageTable->getRecordById($page->getParentId());

    	if($page){
	    	$viewModel  = new ViewModel(array('page' => $page, 'parent' => $parent));
    	}else{
    		$viewModel  = new ViewModel();
    		$viewModel->setTemplate('cms/index/notfound');
    	}
    	return $viewModel;
    }
}
