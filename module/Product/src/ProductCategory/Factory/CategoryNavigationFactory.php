<?php
namespace ProductCategory\Factory;

use Zend\Navigation\Service\AbstractNavigationFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class CategoryNavigationFactory extends AbstractNavigationFactory
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return array
     * @throws \Zend\Navigation\Exception\InvalidArgumentException
     */
    protected function getPages(ServiceLocatorInterface $serviceLocator)
    {
        if (null === $this->pages) {

            $application = $serviceLocator->get('Application');
            $routeMatch  = $application->getMvcEvent()->getRouteMatch();
            $router      = $application->getMvcEvent()->getRouter();

            $configuration = $serviceLocator->get('Config');
            $pages       = $this->getPagesFromConfig($configuration['navigation'][$this->getName()]);
            
            $category = $serviceLocator->get('CategoryService');
            $categories = $category->getCategories();
            
            foreach ($categories as $category){
                if(0 == $category->getParentId()){ // get the root categories
                    $pages[$category->getSlug()] = array('label' => $category->getName(), 'route' => "category/slug", 'params' => array('slug' => $category->getSlug()));
                }
            }
            $this->pages = $this->injectComponents($pages, $routeMatch, $router);
        }
        return $this->pages;
    }

    public function getName()
    { 
         return 'default';
    }
}