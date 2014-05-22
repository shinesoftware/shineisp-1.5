<?php

namespace GoalioForgotPassword\Controller;

use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use Zend\View\Model\ViewModel;
use GoalioForgotPassword\Service\Password as PasswordService;
use GoalioForgotPassword\Options\ForgotControllerOptionsInterface;

class ForgotController extends AbstractActionController
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var PasswordService
     */
    protected $passwordService;

    /**
     * @var Form
     */
    protected $forgotForm;

    /**
     * @var Form
     */
    protected $resetForm;

    /**
     * @todo Make this dynamic / translation-friendly
     * @var string
     */
    protected $message = 'An e-mail with further instructions has been sent to you.';

    /**
     * @todo Make this dynamic / translation-friendly
     * @var string
     */
    protected $failedMessage = 'The e-mail address is not valid.';

    /**
     * @var ForgotControllerOptionsInterface
     */
    protected $options;

    /**
     * @var PasswordOptionsInterface
     */
    protected $zfcUserOptions;

    /**
     * User page
     */
    public function indexAction()
    {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute('zfcuser');
        } else {
            return $this->redirect()->toRoute('zfcuser/forgotpassword');
        }
    }

    public function forgotAction()
    {
        $service = $this->getPasswordService();
        $service->cleanExpiredForgotRequests();

        $request = $this->getRequest();
        $form    = $this->getForgotForm();

        if ( $this->getRequest()->isPost() )
        {
            $form->setData($this->getRequest()->getPost());
            if ( $form->isValid() )
            {
                $userService = $this->getUserService();

                //$email = $this->getRequest()->getPost()->get('email');
                $email = $form->get('email')->getValue();
                $user = $userService->getUserMapper()->findByEmail($email);

                //only send request when email is found
                if($user != null) {
                    $service->sendProcessForgotRequest($user->getId(), $email);
                }

                $vm = new ViewModel(array('email' => $email));
                $vm->setTemplate('goalio-forgot-password/forgot/sent');
                return $vm;
            } else {
                $this->flashMessenger()->setNamespace('goalioforgotpassword-forgot-form')->addMessage($this->failedMessage);
                return array(
                    'forgotForm' => $form,
                );
            }
        }

        // Render the form
        return array(
            'forgotForm' => $form,
        );
    }

    public function resetAction()
    {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute('zfcuser');
        }

        $service = $this->getPasswordService();
        $service->cleanExpiredForgotRequests();

        $request = $this->getRequest();
        $form    = $this->getResetForm();

        $userId    = $this->params()->fromRoute('userId', null);
        $token     = $this->params()->fromRoute('token', null);

        $passwordRequest = $service->getPasswordMapper()->findByUserIdRequestKey($userId, $token);

        //no request for a new password found
        if($passwordRequest === null || $passwordRequest == false) {
            return $this->redirect()->toRoute('zfcuser/forgotpassword');
        }

        $userService = $this->getUserService();
        $user = $userService->getUserMapper()->findById($userId);

        if ( $this->getRequest()->isPost() )
        {
            $form->setData($this->getRequest()->getPost());
            if ( $form->isValid() && $user !== null )
            {
                $service->resetPassword($passwordRequest, $user, $form->getData());

                $vm = new ViewModel(array('email' => $user->getEmail()));
                $vm->setTemplate('goalio-forgot-password/forgot/passwordchanged');
                return $vm;
            }
        }

        // Render the form
        return array(
            'resetForm' => $form,
            'userId'    => $userId,
            'token'     => $token,
            'email'     => $user->getEmail(),
        );
    }

    /**
     * Getters/setters for DI stuff
     */

    public function getUserService()
    {
        if (!$this->userService) {
            $this->userService = $this->getServiceLocator()->get('zfcuser_user_service');
        }
        return $this->userService;
    }

    public function setUserService(UserService $userService)
    {
        $this->userService = $userService;
        return $this;
    }

    public function getPasswordService()
    {
        if (!$this->passwordService) {
            $this->passwordService = $this->getServiceLocator()->get('goalioforgotpassword_password_service');
        }
        return $this->passwordService;
    }

    public function setPasswordService(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
        return $this;
    }

    public function getForgotForm()
    {
        if (!$this->forgotForm) {
            $this->setForgotForm($this->getServiceLocator()->get('goalioforgotpassword_forgot_form'));
        }
        return $this->forgotForm;
    }

    public function setForgotForm(Form $forgotForm)
    {
        $this->forgotForm = $forgotForm;
    }

    public function getResetForm()
    {
        if (!$this->resetForm) {
            $this->setResetForm($this->getServiceLocator()->get('goalioforgotpassword_reset_form'));
        }
        return $this->resetForm;
    }

    public function setResetForm(Form $resetForm)
    {
        $this->resetForm = $resetForm;
    }

    /**
     * set options
     *
     * @param ForgotControllerOptionsInterface $options
     * @return ForgotController
     */
    public function setOptions(ForgotControllerOptionsInterface $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * get options
     *
     * @return ForgotControllerOptionsInterface
     */
    public function getOptions()
    {
        if (!$this->options instanceof ForgotControllerOptionsInterface) {
            $this->setOptions($this->getServiceLocator()->get('goalioforgotpassword_module_options'));
        }
        return $this->options;
    }

    public function getZfcUserOptions()
    {
        if (!$this->zfcUserOptions instanceof PasswordOptionsInterface) {
            $this->zfcUserOptions = $this->getServiceLocator()->get('zfcuser_module_options');
        }
        return $this->zfcUserOptions;
    }
}
