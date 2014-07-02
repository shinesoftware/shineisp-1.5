<?php
namespace Base\Factory;

use Base\Controller\LocationController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LocationControllerFactory implements FactoryInterface
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
        $country = $realServiceLocator->get('CountryService');
        $region = $realServiceLocator->get('RegionService');
        $province = $realServiceLocator->get('ProvinceService');

        return new LocationController($country, $region, $province);
    }
}