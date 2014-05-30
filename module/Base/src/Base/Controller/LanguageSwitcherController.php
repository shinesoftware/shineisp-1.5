<?php

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Base\Service\LanguagesService;

class LanguageSwitcherController extends AbstractActionController
{
    
    protected $languagesService;
    
    public function __construct(LanguagesService $languagesService)
    {
        $this->languagesService = $languagesService;
    }
    
    /**
     * This action handles the selection of the language
     *
     * @return \Zend\Http\Response
     */
    public function changelngAction ()
    {
        $session = new Container('base');
        $langid = $this->params()->fromRoute('id');
    
        if(!empty($langid) && is_numeric($langid)){
            $locale = $this->languagesService->find($langid)->getLocale();
            $session->offsetSet('locale', $locale);
        }
         
        if($this->getRequest()->getHeader('Referer')){
            $url = $this->getRequest()->getHeader('Referer')->getUri();
            return $this->redirect()->toUrl($url);
        }else{
            return $this->redirect()->toRoute('home');
        }
    }
}