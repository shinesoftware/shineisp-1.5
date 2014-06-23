<?php
namespace Customer\Factory;

use CustomerAdmin\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

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
        $settings = $realServiceLocator->get('SettingsService');

        return new IndexController($customerService, $addressService, $settings);
    }
}