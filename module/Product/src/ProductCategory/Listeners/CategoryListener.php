<?php
namespace ProductCategory\Listeners;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

class CategoryListener implements ListenerAggregateInterface
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
//         $this->listeners[] = $sharedEvents->attach(\Zend\Mvc\MvcEvent::EVENT_FINISH, array($this, 'onFinish'), 9);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function onFinish($e)
    {
//         $data = $e->getParam('data');
        
        // Log the data
//         $this->serviceManager->get('Zend\Log\Logger')->crit($data);
    }
}