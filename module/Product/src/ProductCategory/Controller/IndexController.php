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
use Base\Model\UrlRewrites;

class IndexController extends AbstractActionController
{
    protected $category;
    protected $form;
    protected $datagrid;
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
                                 \ZfcDatagrid\Datagrid $datagrid,
                                 SettingsServiceInterface $settings)
    {
        $this->category = $category;
        $this->form = $form;
        $this->filter = $filter;
        $this->datagrid = $datagrid;
        $this->settings = $settings;
    }
    
    /**
     * (non-PHPdoc)
     * @see Zend\Mvc\Controller.AbstractActionController::indexAction()
     */
    public function indexAction()
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
     * Edit the main product information
     */
    public function editAction ()
    {
        $id = $this->params()->fromRoute('id');

        $form = $this->form;

        // Get the record by its id
        $category = $this->category->find($id);

        if(empty($category) || $category === false){
            $this->flashMessenger()->setNamespace('danger')->addMessage('The record has been not found!');
            return $this->redirect()->toRoute('zfcadmin/category/default');
        }

        // Bind the data in the form
        if (! empty($category)) {
            $form->bind($category);
        }

        $viewModel = new ViewModel(array (
            'form' => $form,
        ));

        return $viewModel;
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
     * Add new information
     */
    public function addAction ()
    {

        $form = $this->form;

        $viewModel = new ViewModel(array (
            'form' => $form,
        ));

        $viewModel->setTemplate('product-category/index/edit');
        return $viewModel;
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
            $this->category->delete($id);

            return $this->redirect()->toRoute('zfcadmin/category');
        }

        return $this->redirect()->toRoute('zfcadmin/category/edit', array ('action' => 'index', 'id' => $id));

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
            $query = !empty($_GET['data']['term']) ? $_GET['data']['term'] : null;
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
