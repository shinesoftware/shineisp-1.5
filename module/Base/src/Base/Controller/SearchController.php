<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Common class to search records in all the services
 * You have to create your own module and inject the service of your module
 * into the /Base/Controller/SearchController object
 * Then you have to create into your service the "search" method like this: https://gist.github.com/shinesoftware/d7a758395e93c087d2bf
 * 
 * @author shinesoftware
 *
 */
class SearchController extends AbstractActionController
{
	protected $theServices = array();
	protected $translator;
	
	/**
	 * preDispatch event of the page
	 *
	 * (non-PHPdoc)
	 * @see Zend\Mvc\Controller.AbstractActionController::onDispatch()
	 */
	public function onDispatch(\Zend\Mvc\MvcEvent $e){
		$this->translator = $e->getApplication()->getServiceManager()->get('translator');
	
		return parent::onDispatch( $e );
	}
	
	public function __construct($service)
	{
		$this->theServices[] = $service;
	}
    
    /**
     * Search the page by the name
     */
    public function doAction ()
    {
    	$result = array();
    	$i = 0;
    	 
    	$searchString = $this->params()->fromRoute('query');
    	$searchString = trim($searchString);

    	if (!empty($searchString)){
    		$searchString = htmlspecialchars($searchString);
    		
    		foreach ($this->theServices as $service){
    			$records = $service->search($searchString, $this->translator->getLocale());
    		}
    	}
    	 
    	die(json_encode($records));
    }
}
