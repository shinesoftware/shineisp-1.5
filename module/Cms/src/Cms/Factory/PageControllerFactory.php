<?php
namespace Cms\Factory;

use Cms\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

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
        $pageService = $realServiceLocator->get('PageService');
        $cmsSettings = $realServiceLocator->get('SettingsService');

        return new IndexController($pageService, $cmsSettings);
    }
}