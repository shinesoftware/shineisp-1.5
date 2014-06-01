<?php
namespace Dummy\Listeners;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

class CmsListener implements ListenerAggregateInterface
{
    protected $serviceManager;
    
    public function __construct(\Zend\ServiceManager\ServiceLocatorInterface $serviceManager){
        
        $this->serviceManager = $serviceManager;
    }
    
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $sharedEvents      = $events->getSharedManager();
        $this->listeners[] = $sharedEvents->attach('Cms\Service\PageService', 'save.post', array($this, 'onDispatch'), 100);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function onDispatch($e)
    {
        /*
            $data = $e->getParam('data');
            $cmsObject = $e->getParam('record');
            $id = $e->getParam('id');
        */
        
        // Log the data
        # $this->serviceManager->get('Zend\Log\Logger')->crit($data);
    }
}