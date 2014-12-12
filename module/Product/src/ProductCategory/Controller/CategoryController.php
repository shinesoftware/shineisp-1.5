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
use Product\Service\ProductService;
use ProductCategory\Service\CategoryService;
use Base\Service\SettingsServiceInterface;

class CategoryController extends AbstractActionController
{
    protected $product;
    protected $category;
    protected $settings;
    
    /**
     * Class Constructor 
     * 
     * @param CategoryService $category
     * @param CategoryForm $form
     * @param SettingsServiceInterface $settings
     */
    public function __construct( ProductService $product, CategoryService $category, 
                                 SettingsServiceInterface $settings)
    {
        $this->product = $product;
        $this->category = $category;
        $this->settings = $settings;
    }
    
    /**
     * (non-PHPdoc)
     * @see Zend\Mvc\Controller.AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $slug = $this->params()->fromRoute('slug');
        
        $category = $this->category->getCategoryBySlug($slug);
        if($category){
            $category_id = $category->getId();
            
             $products = $this->product->findbyCategory($category_id);
            
        }
        
    	$viewModel = new ViewModel(array (
    			'category' => $category,
    			'products' => $products,
    	));
    
    	return $viewModel;
    }
    
}
