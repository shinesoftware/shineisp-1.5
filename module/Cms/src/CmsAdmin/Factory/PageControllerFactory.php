<?php
namespace CmsAdmin\Factory;

use CmsAdmin\Controller\PageController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use CmsAdmin\Model\PageDatagrid;

class PageControllerFactory implements FactoryInterface
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
        $service = $realServiceLocator->get('PageService');
        $settings = $realServiceLocator->get('SettingsService');
        $dbAdapter = $realServiceLocator->get('Zend\Db\Adapter\Adapter');
        $datagrid = $realServiceLocator->get('ZfcDatagrid\Datagrid');
        $form = $realServiceLocator->get('FormElementManager')->get('Cms\Form\PageForm');
        $formfilter = $realServiceLocator->get('PageFilter');
        
        // prepare the datagrid to handle the custom columns and data
        $theDatagrid = new PageDatagrid($dbAdapter, $datagrid, $settings);
        $grid = $theDatagrid->getDatagrid();
        
        return new PageController($service, $form, $formfilter, $grid, $settings);
    }
}