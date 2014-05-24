<?php
namespace Base\Factory;

use Base\Controller\LanguagesAdminController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LanguagesControllerFactory implements FactoryInterface
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
        $languagesService = $realServiceLocator->get('LanguagesService');

        return new LanguagesAdminController($languagesService);
    }
}