<?php
namespace Base\Factory;

use Base\Controller\LanguageSwitcherController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LanguageSwitcherControllerFactory implements FactoryInterface
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

        return new LanguageSwitcherController($languagesService);
    }
}