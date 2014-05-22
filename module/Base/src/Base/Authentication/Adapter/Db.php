<?php
namespace Base\Authentication\Adapter;
use Zend\Authentication\Result as AuthenticationResult;
use ZfcUser\Authentication\Adapter\AdapterChainEvent as AuthEvent;
use ZfcUser\Authentication\Adapter\Db as BaseDb;
use Zend\Session\Container as SessionContainer;

class Db extends BaseDb
{

    public function authenticate (AuthEvent $e)
    {
        if ($this->isSatisfied()) {
            $storage = $this->getStorage()->read();
            $e->setIdentity($storage['identity'])->setCode(AuthenticationResult::SUCCESS)->setMessages(array ( 
                    'Authentication successful.'
            ));
            return;
        }
        
        $identity = $e->getRequest()->getPost()->get('identity');
        $credential = $e->getRequest()->getPost()->get('credential');
        $credential = $this->preProcessCredential($credential);
        $userObject = NULL;
        
        // Cycle through the configured identity sources and test each
        $fields = $this->getOptions()->getAuthIdentityFields();
        while (! is_object($userObject) && count($fields) > 0) {
            $mode = array_shift($fields);
            switch ($mode) {
                case 'username':
                    $userObject = $this->getMapper()->findByUsername($identity);
                    break;
                case 'email':
                    $userObject = $this->getMapper()->findByEmail($identity);
                    break;
            }
        }
        
        if (! $userObject) {
            $e->setCode(AuthenticationResult::FAILURE_IDENTITY_NOT_FOUND)->setMessages(array ( 
                    'A record with the supplied identity could not be found.'
            ));
            $this->setSatisfied(false);
            return false;
        }
        
        if ($this->getOptions()->getEnableUserState()) {
            // Don't allow user to login if state is not in allowed list
            if (! in_array($userObject->getState(), $this->getOptions()->getAllowedLoginStates())) {
                $e->setCode(AuthenticationResult::FAILURE_UNCATEGORIZED)->setMessages(array ( 
                        'A record with the supplied identity is not active.'
                ));
                $this->setSatisfied(false);
                return false;
            }
        }
        
        $password_posted = md5($credential);
        
        if ($password_posted != $userObject->getPassword()) {
            // Password does not match
            $e->setCode(AuthenticationResult::FAILURE_CREDENTIAL_INVALID)->setMessages(array ( 
                    'Supplied credential is invalid.'
            ));
            $this->setSatisfied(false);
            return false;
        }
        
        // regen the id
        $session = new SessionContainer($this->getStorage()->getNameSpace());
        $session->getManager()->regenerateId();
        
        // Success!
        $e->setIdentity($userObject->getId());
        $this->setSatisfied(true);
        $storage = $this->getStorage()->read();
        $storage['identity'] = $e->getIdentity();
        $this->getStorage()->write($storage);
        $e->setCode(AuthenticationResult::SUCCESS)->setMessages(array ( 
                'Authentication successful.'
        ));
    }
}