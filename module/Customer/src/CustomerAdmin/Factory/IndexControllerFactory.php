<?php
namespace CustomerAdmin\Factory;

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
        $contactService = $realServiceLocator->get('ContactService');
        $settings = $realServiceLocator->get('SettingsService');

        return new IndexController($customerService, $addressService, $contactService, $settings);
    }
}