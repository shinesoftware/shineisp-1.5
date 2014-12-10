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
        $id = $this->params()->fromRoute('id');
        $form = $this->form;
        $request = $this->getRequest();
        
        $category = $this->category->find($id);
        if($category){
            $form->bind($category);
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
    public function addAction ()
    {
        $request = $this->getRequest();
        $name = $this->params()->fromRoute('name');
        $parent = $this->params()->fromRoute('parent');
        
        // this is executed by the fancytree ajax async request (javascript)
        if ($request->isXmlHttpRequest()) {
            
            $category = new \ProductCategory\Entity\Category();
            $category->setName($name);
            if(is_numeric($parent)){
                $category->setParentId($parent);
            }else{
                $category->setParentId(0);
            }
    
            // Save the data in the database
            $record = $this->category->save($category);
            die(json_encode($record));
        }
        
        die();
    }
    
    
    /**
     * Prepare to move a category to another leaf
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function moveAction ()
    {
        $request = $this->getRequest();
        $orig = $this->params()->fromRoute('orig');
        $dest = $this->params()->fromRoute('dest');
        
        // this is executed by the fancytree ajax async request (javascript)
        if ($request->isXmlHttpRequest()) {
            $orig = str_replace("_", "", $orig);
            $dest = str_replace("_", "", $dest);
            $category = $this->category->find($orig);
            $category->setParentId($dest);
    
            // Save the data in the database
            $record = $this->category->save($category);
            die(json_encode($record));
        }
        
        die();
    }
    
    /**
     * Get the data from the table
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function getAction ()
    {
        $request = $this->getRequest();
        $id = $this->params()->fromRoute('id');
        
        // this is executed by the fancytree ajax async request (javascript)
        if ($request->isXmlHttpRequest()) {
            
            $id = str_replace("_", "", $id);
            
            // Save the data in the database
            $record = $this->category->find($id);
            die(json_encode($record));
        }
        
        die();
    }
    
    
    public function loadAction()
    {
        $attributetree = null;
        $request = $this->getRequest();
        // this is executed by the fancytree ajax async request (javascript)
        if ($request->isXmlHttpRequest()) {
            $attributetree = $this->category->createTree($this->category->getCategories());
            die(json_encode($attributetree));
        }
        die($attributetree);
    }
    
    
    /**
     * Process data
     *
     * @return \Zend\Http\Response
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
        
        // set the input filter
        $form->setInputFilter($this->filter);
        
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
    
    /**
     * Delete the records
     *
     * @return \Zend\Http\Response
     */
    public function deleteAction ()
    {
        $id = $this->params()->fromRoute('id');
        $request = $this->getRequest();
        
        // this is executed by the fancytree ajax async request (javascript)
        if ($request->isXmlHttpRequest()) {
            
            if (is_numeric($id)) {
        
                // Delete the record informaiton
                $this->category->delete($id);
                
                die(json_encode(array(true)));
            }
        
            die(json_encode(array(false)));
        }
        die();
    }
    
    
    /**
     * Search the record for the Select2 JQuery Object by ajax
     * @return json
     */
    public function getcategoryAction ()
    {
//         if($this->getRequest()->isXmlHttpRequest()){
            $i=0;
            $data = array();
            $ids = $this->params()->fromRoute('id');
            $query = !empty($_GET['term']) ? $_GET['term'] : null;
            
            if(!empty($query)){
                $records = $this->category->getCategoryByNameLike($query);
            }elseif(!empty($ids)){
                $records = $this->category->getCategoriesByIds(explode(",", $ids));
            }else{
                $records = $this->category->getCategories();
            }
            
            foreach ($records as $record){
                $data[$i]['id'] = $record->getId();
                $data[$i]['name'] = $record->getName();
                $i++;
            }
            
            die(json_encode($data));
//         }
        die();
    }
}
