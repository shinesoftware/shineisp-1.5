<?php

namespace GoalioMailService\Mail\View;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;

class MailPhpRendererFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $renderer = new PhpRenderer();

        $helperManager = $serviceLocator->get('ViewHelperManager');
        $resolver      = $serviceLocator->get('ViewResolver');

        $renderer->setHelperPluginManager($helperManager);
        $renderer->setResolver($resolver);

        $model = $serviceLocator->get('Application')->getMvcEvent()->getViewModel();

        $modelHelper = $renderer->plugin('view_model');
        $modelHelper->setRoot($model);

        return $renderer;
    }
}