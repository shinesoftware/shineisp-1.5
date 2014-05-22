<?php
namespace GoalioMailService\Mail\Transport\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class TransportFactory implements FactoryInterface {


    public function createService(ServiceLocatorInterface $serviceLocator) {

        $config = $serviceLocator->get('Config');

        $transportOptions = (isset($config['goaliomailservice']) ? $config['goaliomailservice'] : array());

        if(!isset($transportOptions['transport_class'])) {
            throw new Exception('Transport class has to be configured');
        }

        $transportClass = $transportOptions['transport_class'];
        $transport = new $transportClass();

        if(isset($transportOptions['options_class'])) {
            $optionsClass = $transportOptions['options_class'];
            $options = new $optionsClass($transportOptions['options']);
            $transport->setOptions($options);
        }

        return $transport;
    }
}