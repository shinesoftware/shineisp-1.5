<?php
/**
* Copyright (c) 2014 Shine Software.
* All rights reserved.
*
* Redistribution and use in source and binary forms, with or without
* modification, are permitted provided that the following conditions
* are met:
*
* * Redistributions of source code must retain the above copyright
* notice, this list of conditions and the following disclaimer.
*
* * Redistributions in binary form must reproduce the above copyright
* notice, this list of conditions and the following disclaimer in
* the documentation and/or other materials provided with the
* distribution.
*
* * Neither the names of the copyright holders nor the names of the
* contributors may be used to endorse or promote products derived
* from this software without specific prior written permission.
*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
* "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
* LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
* FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
* COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
* INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
* BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
* LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
* CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
* LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
* ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
* POSSIBILITY OF SUCH DAMAGE.
*
* @package Base
* @subpackage Model
* @author Michelangelo Turillo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Turillo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/

namespace Base\Service;

class MailService {
    
    protected $mailservice;
    protected $translator;
    
    /**
     * Constructor
     * @param \GoalioMailService\Mail\Service\Message $mailservice
     * @param \Zend\Mvc\I18n\Translator $translator
     */
    public function __construct(\GoalioMailService\Mail\Service\Message $mailservice, \Zend\Mvc\I18n\Translator $translator  ){
        $this->mailservice = $mailservice;
        $this->translator = $translator;
    }
    
    /**
     * Send a mail message
     * 
     * Example
     * 
     * $mailcontent = array('record' => array('var1' => '', 'var2' => '...'));
     * $mailservice->send('FROM EMAIL', 'TO EMAIL', 'SUBJECT', $mailcontent, 'emails/googlecalendar-error');
     * 
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param array $values
     * @param string $template > is the view template path until the view file located in the view folder 
     */
    public function send($from, $to, $subject, $values = array(), $template="emails/generic")
    {
        $mailService = $this->mailservice;
        $message = $mailService->createHtmlMessage($from, $to, $subject, $template, $values);
        return $mailService->send($message);
    }
}
?>