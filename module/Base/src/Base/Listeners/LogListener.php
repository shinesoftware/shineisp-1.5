<?php
namespace Base\Listeners;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

class LogListener implements ListenerAggregateInterface
{
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();
    protected $logger;

    /**
	 * @return the $logger
	 */
	public function getLogger() {
		return $this->logger;
	}

	/**
	 * @param field_type $logger
	 */
	public function setLogger($logger) {
		$this->logger = $logger;
	}

	/**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $sharedEvents      = $events->getSharedManager();
        $this->listeners[] = $sharedEvents->attach('Zend\Mvc\Application', 'dispatch.error', array($this, 'onError'), 100);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function onError($e)
    {
       if ($e->getParam('exception')){
            $this->getLogger()->crit($e->getParam('exception'));
        }
    }
}