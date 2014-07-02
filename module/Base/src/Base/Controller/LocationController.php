<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base\Controller;

use Zend\Config\Reader\Json;

use Base\Service\ProvinceServiceInterface;
use Base\Service\RegionServiceInterface;
use Base\Service\CountryServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * 
 * @author shinesoftware
 *
 */
class LocationController extends AbstractActionController
{
	protected $country;
	protected $region;
	protected $province;
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
	
	public function __construct(CountryServiceInterface $country, RegionServiceInterface $region, ProvinceServiceInterface $province)
	{
		$this->country = $country;
		$this->region = $region;
		$this->province = $province;
	}
    
	/**
	 * default action
	 * 
	 * (non-PHPdoc)
	 * @see Zend\Mvc\Controller.AbstractActionController::indexAction()
	 */
	public function indexAction(){
		die('end');
	}
	
    /**
     * Get the regions from the database by the CountryId
     * @param $countryId
     * @return Json
     */
    public function regionsAction ()
    {
    	$rows = array();
    	$result = array();
    	$i = 0;
    	
    	$result['total'] = 0;
    	$result['rows'] = null;
    	$result['success']  = false;
    	
    	$id = $this->params()->fromRoute('id');
    	 
    	if (!empty($id)){
    		$records = $this->region->findByCountryId($id);
    		if(!empty($records)){
	    		foreach ($records as $record){
	    			$rows[$i]['id'] = $record->getId();
	    			$rows[$i]['name'] = $record->getName();
	    			$i++;
	    		}
	    		$result['total']  = count($rows);
	    		$result['rows'] = $rows;
	    		$result['success']  = true;
    		}
    	}

    	die(json_encode($result));
    }
	
    /**
     * Get the provinces from the database by the RegionId
     * @param $countryId
     * @return Json
     */
    public function provinceAction ()
    {
    	$rows = array();
    	$result = array();
    	$i = 0;
    	
    	$result['total'] = 0;
    	$result['rows'] = null;
    	$result['success']  = false;
    	
    	$id = $this->params()->fromRoute('id');
    	 
    	if (!empty($id)){
    		$records = $this->province->findByRegionId($id);
    		if(!empty($records)){
	    		foreach ($records as $record){
	    			$rows[$i]['id'] = $record->getId();
	    			$rows[$i]['name'] = $record->getName();
	    			$i++;
	    		}
	    		$result['total']  = count($rows);
	    		$result['rows'] = $rows;
	    		$result['success']  = true;
    		}
    	}

    	die(json_encode($result));
    }
}
