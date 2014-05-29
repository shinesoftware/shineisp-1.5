<?php
namespace Base\Listeners;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

class UserRegisterListener implements ListenerAggregateInterface
{
    protected $adapter;
    
    public function __construct(\Zend\Db\Adapter\Adapter $adapter){
        $this->adapter = $adapter;
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
        $this->listeners[] = $sharedEvents->attach('Base\Service\MyUser', 'register.post', array($this, 'onRegister'), 100);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function onRegister($e)
    {
        $user = $e->getParam('user');
        
        if(!empty($user)){
            $id = $user->getId();
            if(!empty($id) && is_numeric($id)){
                $this->adapter->query('INSERT INTO user_role_linker (user_id, role_id) VALUES (' . $id . ', 2)', \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE);
                return true;
            }
        }
        
        return false;
    }
}