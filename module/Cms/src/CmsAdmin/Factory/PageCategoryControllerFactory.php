<?php
namespace CmsAdmin\Factory;

use CmsAdmin\Controller\PageCategoryController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use CmsAdmin\Model\PageCategoryDatagrid;

class PageCategoryControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $service = $realServiceLocator->get('PageCategoryService');
        $dbAdapter = $realServiceLocator->get('Zend\Db\Adapter\Adapter');
        $datagrid = $realServiceLocator->get('ZfcDatagrid\Datagrid');
        $form = $realServiceLocator->get('FormElementManager')->get('Cms\Form\PageCategoryForm');
        $formfilter = $realServiceLocator->get('PageCategoryFilter');
        $settings = $realServiceLocator->get('SettingsService');
        
        // prepare the datagrid to handle the custom columns and data
        $theDatagrid = new PageCategoryDatagrid($dbAdapter, $datagrid, $settings);
        $grid = $theDatagrid->getDatagrid();
        
        return new PageCategoryController($service, $form, $formfilter, $grid, $settings);
    }
}