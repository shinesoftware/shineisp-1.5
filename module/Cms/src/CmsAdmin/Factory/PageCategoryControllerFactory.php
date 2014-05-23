<?php
namespace CmsAdmin\Factory;

use CmsAdmin\Controller\PageCategoryController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

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
        $pagecategoryService = $realServiceLocator->get('PageCategoryService');

        return new PageCategoryController($pagecategoryService);
    }
}