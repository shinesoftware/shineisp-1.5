<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ProductCategory\Controller;

use Zend\InputFilter\InputFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ProductCategory\Service\CategoryService;
use ProductCategory\Form\CategoryForm;
use ProductCategory\Form\CategoryFilter;
use Base\Service\SettingsServiceInterface;

class IndexController extends AbstractActionController
{
    protected $category;
    protected $form;
    protected $filter;
    protected $settings;
    
    /**
     * Class Constructor 
     * 
     * @param CategoryService $category
     * @param CategoryForm $form
     * @param SettingsServiceInterface $settings
     */
    public function __construct( CategoryService $category, 
                                 CategoryForm $form,  
                                 CategoryFilter $filter,  
                                 SettingsServiceInterface $settings)
    {
        $this->category = $category;
        $this->form = $form;
        $this->filter = $filter;
        $this->settings = $settings;
    }
    
    /**
     * (non-PHPdoc)
     * @see Zend\Mvc\Controller.AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $form = $this->form;
        $request = $this->getRequest();
        
        // this is executed by the fancytree ajax async request (javascript)
        if ($request->isXmlHttpRequest()) {
            $attributetree = $this->category->createTree($this->category->getCategories());
            die(json_encode($attributetree));
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
                    'controller' => 'category',
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
        @mkdir(PUBLIC_PATH . '/documents/category');
         
        // get the input file filter in order to set the right file upload path
        $inputFilter = $this->filter;
         
        // customize the path
        if(!empty($post['id'])){
            @mkdir(PUBLIC_PATH . '/documents/category/' . $post['id']);
            $path = PUBLIC_PATH . '/documents/category/' . $post['id'] . '/';
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
    
            $viewModel->setTemplate('product-category/index/index');
            return $viewModel;
        }
    
        // Get the posted vars
        $data = $form->getData();
    
        // Save the data in the database
        $record = $this->category->save($data);
         
        $this->flashMessenger()->setNamespace('success')->addMessage('The information have been saved.');
    
        return $this->redirect()->toRoute('zfcadmin/category/default', array ('action' => 'index', 'id' => $record->getId()));
    }
    
    
    public function loadAction()
    {
        $result = array();
        die(json_encode($result));
    }
    
    public function newAction()
    {
        $form = $this->form;
        
        $viewModel = new ViewModel(array (
                'form' => $form,
        ));
        
        $viewModel->setTemplate('product-category/index/index');
        
        
        return $viewModel;
    }
}
