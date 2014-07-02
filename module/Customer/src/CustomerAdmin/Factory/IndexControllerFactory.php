<?php
namespace CustomerAdmin\Factory;

use CustomerAdmin\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use CustomerAdmin\Model\CustomerDatagrid;

class IndexControllerFactory implements FactoryInterface
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
        $customerService = $realServiceLocator->get('CustomerService');
        $addressService = $realServiceLocator->get('AddressService');
        $contactService = $realServiceLocator->get('ContactService');
        $settings = $realServiceLocator->get('SettingsService');
        $dbAdapter = $realServiceLocator->get('Zend\Db\Adapter\Adapter');
        $datagrid = $realServiceLocator->get('ZfcDatagrid\Datagrid');
        $form = $realServiceLocator->get('FormElementManager')->get('CustomerAdmin\Form\CustomerForm');
        $formfilter = $realServiceLocator->get('AdminCustomerFilter');
        
		$theDatagrid = new CustomerDatagrid($dbAdapter, $datagrid, $settings);
		$grid = $theDatagrid->getDatagrid();
		
        return new IndexController($customerService, $addressService, $contactService, $form, $formfilter, $grid, $settings);
    }
}