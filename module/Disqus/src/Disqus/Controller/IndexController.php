<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Disqus\Controller;

use Base\Service\SettingsService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	protected $baseSettings;
	protected $translator;
	
	/**
	 * preDispatch disqus of the disqus
	 * 
	 * (non-PHPdoc)
	 * @see Zend\Mvc\Controller.AbstractActionController::onDispatch()
	 */
	public function onDispatch(\Zend\Mvc\MvcEvent $e){
		$this->translator = $e->getApplication()->getServiceManager()->get('translator');
		
		return parent::onDispatch( $e );
	}
	
	/**
	 * Constructor 
	 * @param \Disqus\Service\DisqusProfileService $disqusProfile
	 * @param \Base\Service\SettingsService $settingservice
	 */
	public function __construct(\Base\Service\SettingsService $settingservice)
	{
		$this->baseSettings = $settingservice;
	}
	
}
