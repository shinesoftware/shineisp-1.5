<?php
namespace GoalioMailService\Mail\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\Mail\Message as MailMessage;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

class Message implements ServiceManagerAwareInterface {

    /**
     *
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     *
     * @param ServiceManager $serviceManager
     * @return AbstractService
     */
    public function setServiceManager(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     *
     * @return ServiceManager
     */
    public function getServiceManager() {
        return $this->serviceManager;
    }

    /**
     *
     * @var \Zend\View\Renderer\RendererInterface
     */
    protected $renderer;

    /**
     *
     * @var \Zend\Mail\Transport\TransportInterface
     */
    protected $transport;

    /**
     * Return a HTML message ready to be sent
     *
     * @param array|string $from
     *            A string containing the sender e-mail address, or if array with keys email and name
     * @param array|string $to
     *            An array containing the recipients of the mail
     * @param string $subject
     *            Subject of the mail
     * @param string|\Zend\View\Model\ModelInterface $nameOrModel
     *            Either the template to use, or a ViewModel
     * @param null|array $values
     *            Values to use when the template is rendered
     * @return Message
     */
    public function createHtmlMessage($from, $to, $subject, $nameOrModel, $values = array()) {
        $renderer = $this->getRenderer();
        $content = $renderer->render($nameOrModel, $values);

        $text = new MimePart('');
        $text->type = "text/plain";

        $html = new MimePart($content);
        $html->type = "text/html";

        $body = new MimeMessage();
        $body->setParts(array($text, $html));

        return $this->getDefaultMessage($from, 'utf-8', $to, $subject, $body);
    }

    /**
     * Return a text message ready to be sent
     *
     * @param array|string $from
     *            A string containing the sender e-mail address, or if array with keys email and name
     * @param array|string $to
     *            An array containing the recipients of the mail
     * @param string $subject
     *            Subject of the mail
     * @param string|\Zend\View\Model\ModelInterface $nameOrModel
     *            Either the template to use, or a ViewModel
     * @param null|array $values
     *            Values to use when the template is rendered
     * @return Message
     */
    public function createTextMessage($from, $to, $subject, $nameOrModel, $values = array()) {
        $renderer = $this->getRenderer();
        $content = $renderer->render($nameOrModel, $values);

        return $this->getDefaultMessage($from, 'UTF-8', $to, $subject, $content);
    }

    /**
     * Send the message
     *
     * @param Message $message
     */
    public function send(MailMessage $message) {
        $this->getTransport()
            ->send($message);
    }

    /**
     * Get the renderer
     *
     * @return \Zend\View\Renderer\RendererInterface
     */
    protected function getRenderer() {
        if($this->renderer === null) {
            $serviceManager = $this->getServiceManager();
            $this->renderer = $serviceManager->get('goaliomailservice_renderer');
        }

        return $this->renderer;
    }

    /**
     * Get the transport
     *
     * @return \Zend\Mail\Transport\TransportInterface
     */
    protected function getTransport() {
        if($this->transport === null) {
            $this->transport = $this->getServiceManager()
                ->get('goaliomailservice_transport');
        }

        return $this->transport;
    }

    /**
     *
     * @return Message
     */
    protected function getDefaultMessage($from, $encoding, $to, $subject, $body) {
        if(is_string($from)) {
            $from = array('email' => $from, 'name' => $from);
        }

        $message = new MailMessage();
        $message->setFrom($from['email'], $from['name'])
            ->setEncoding($encoding)
            ->setSubject($subject)
            ->setBody($body)
            ->setTo($to);

        return $message;
    }
}