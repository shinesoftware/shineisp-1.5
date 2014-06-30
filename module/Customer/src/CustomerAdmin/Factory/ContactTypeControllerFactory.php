<?php
namespace CustomerAdmin\Factory;

use CustomerAdmin\Controller\ContactTypeController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContactTypeControllerFactory implements FactoryInterface
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
        $contactTypeService = $realServiceLocator->get('ContactTypeService');
        $settings = $realServiceLocator->get('SettingsService');

        return new ContactTypeController($contactTypeService, $settings);
    }
}