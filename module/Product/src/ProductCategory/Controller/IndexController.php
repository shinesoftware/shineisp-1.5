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
use Base\Service\SettingsServiceInterface;

class IndexController extends AbstractActionController
{
    protected $category;
    protected $form;
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
                                 SettingsServiceInterface $settings)
    {
        $this->category = $category;
        $this->form = $form;
        $this->settings = $settings;
    }
    
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
}
