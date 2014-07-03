<?php
namespace CmsAdmin\Factory;

use CmsAdmin\Controller\BlockController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use CmsAdmin\Model\BlockDatagrid;

class BlockControllerFactory implements FactoryInterface
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
        $service = $realServiceLocator->get('BlockService');
        $dbAdapter = $realServiceLocator->get('Zend\Db\Adapter\Adapter');
        $datagrid = $realServiceLocator->get('ZfcDatagrid\Datagrid');
        $form = $realServiceLocator->get('FormElementManager')->get('Cms\Form\BlockForm');
        $formfilter = $realServiceLocator->get('BlockFilter');
        $settings = $realServiceLocator->get('SettingsService');

        // prepare the datagrid to handle the custom columns and data
        $theDatagrid = new BlockDatagrid($dbAdapter, $datagrid, $settings);
        $grid = $theDatagrid->getDatagrid();
        
        return new BlockController($service, $form, $formfilter, $grid, $settings);
    }
}