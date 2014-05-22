<?php

namespace GoalioForgotPassword\Service;

use Zend\Mail\Transport\TransportInterface;

use ZfcUser\Options\PasswordOptionsInterface;

use GoalioForgotPassword\Options\ForgotOptionsInterface;

use Zend\ServiceManager\ServiceManager;

use Zend\ServiceManager\ServiceManagerAwareInterface;

use ZfcUser\Mapper\UserInterface as UserMapperInterface;
use GoalioForgotPassword\Mapper\Password as PasswordMapper;

use Zend\Crypt\Password\Bcrypt;
use Zend\Form\Form;

use ZfcBase\EventManager\EventProvider;

class Password extends EventProvider implements ServiceManagerAwareInterface
{
    /**
     * @var ModelMapper
     */
    protected $passwordMapper;
    protected $userMapper;
    protected $serviceLocator;
    protected $options;
    protected $zfcUserOptions;
    protected $emailRenderer;
    protected $emailTransport;

    public function findByRequestKey($token)
    {
        return $this->getPasswordMapper()->findByRequestKey($token);
    }

    public function findByEmail($email)
    {
        return $this->getPasswordMapper()->findByEmail($email);
    }

    public function cleanExpiredForgotRequests()
    {
        // TODO: reset expiry time from options
        return $this->getPasswordMapper()->cleanExpiredForgotRequests();
    }

    public function cleanPriorForgotRequests($userId)
    {
        return $this->getPasswordMapper()->cleanPriorForgotRequests($userId);
    }

    public function remove($m)
    {
        return $this->getPasswordMapper()->remove($m);
    }

    public function sendProcessForgotRequest($userId, $email)
    {
        //Invalidate all prior request for a new password
        $this->cleanPriorForgotRequests($userId);

        $class = $this->getOptions()->getPasswordEntityClass();
        $model = new $class;
        $model->setUserId($userId);
        $model->setRequestTime(new \DateTime('now'));
        $model->generateRequestKey();
        $this->getEventManager()->trigger(__FUNCTION__, $this, array('record' => $model, 'userId' => $userId));
        $this->getPasswordMapper()->persist($model);

        $this->sendForgotEmailMessage($email, $model);
    }

    public function sendForgotEmailMessage($to, $model)
    {
        $mailService = $this->getServiceManager()->get('goaliomailservice_message');

        $from = $this->getOptions()->getEmailFromAddress();
        $subject = $this->getOptions()->getResetEmailSubjectLine();
        $template = $this->getOptions()->getResetEmailTemplate();

        $message = $mailService->createTextMessage($from, $to, $subject, $template, array('record' => $model));

        $mailService->send($message);
    }

    public function resetPassword($password, $user, array $data)
    {
        $newPass = $data['newCredential'];

        $bcrypt = new Bcrypt;
        $bcrypt->setCost($this->getZfcUserOptions()->getPasswordCost());

        $pass = $bcrypt->create($newPass);
        $user->setPassword($pass);

        $this->getEventManager()->trigger(__FUNCTION__, $this, array('user' => $user));
        $this->getUserMapper()->update($user);
        $this->remove($password);
        $this->getEventManager()->trigger(__FUNCTION__.'.post', $this, array('user' => $user));

        return true;
    }

    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * getUserMapper
     *
     * @return UserMapperInterface
     */
    public function getUserMapper()
    {
        if (null === $this->userMapper) {
            $this->userMapper = $this->getServiceManager()->get('zfcuser_user_mapper');
        }
        return $this->userMapper;
    }

    /**
     * setUserMapper
     *
     * @param UserMapperInterface $userMapper
     * @return User
     */
    public function setUserMapper(UserMapperInterface $userMapper)
    {
        $this->userMapper = $userMapper;
        return $this;
    }

    public function setPasswordMapper(PasswordMapper $passwordMapper)
    {
        $this->passwordMapper = $passwordMapper;
        return $this;
    }

    public function getPasswordMapper()
    {
        if (null === $this->passwordMapper) {
            $this->setPasswordMapper($this->getServiceManager()->get('goalioforgotpassword_password_mapper'));
        }

        return $this->passwordMapper;
    }

    public function setMessageRenderer(ViewRenderer $emailRenderer)
    {
        $this->emailRenderer = $emailRenderer;
        return $this;
    }

    public function getMessageTransport()
    {
        if (!$this->emailTransport instanceof TransportInterface) {
            $this->setEmailTransport($this->getServiceManager()->get('goalioforgotpassword_email_transport'));
        }

        return $this->emailTransport;
    }

    public function setMessageTransport(EmailTransport $emailTransport)
    {
        $this->emailTransport = $emailTransport;
        return $this;
    }

    public function getOptions()
    {
        if (!$this->options instanceof ForgotOptionsInterface) {
            $this->setOptions($this->getServiceManager()->get('goalioforgotpassword_module_options'));
        }
        return $this->options;
    }

    public function setOptions(ForgotOptionsInterface $opt)
    {
        $this->options = $opt;
        return $this;
    }

    public function getZfcUserOptions()
    {
        if (!$this->zfcUserOptions instanceof PasswordOptionsInterface) {
            $this->setZfcUserOptions($this->getServiceManager()->get('zfcuser_module_options'));
        }
        return $this->zfcUserOptions;
    }

    public function setZfcUserOptions(PasswordOptionsInterface $zfcUserOptions)
    {
        $this->zfcUserOptions = $zfcUserOptions;
        return $this;
    }
}
