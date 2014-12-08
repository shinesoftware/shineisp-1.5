<?php 
namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Recurrence extends AbstractHelper implements ServiceLocatorAwareInterface {
	
	protected $serviceLocator;
	 
	/**
	 * Set the service locator.
	 *
	 * @param $serviceLocator ServiceLocatorInterface       	
	 * @return CustomHelper
	 */
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
		return $this;
	}
	/**
	 * Get the service locator.
	 *
	 * @return \Zend\ServiceManager\ServiceLocatorInterface
	 */
	public function getServiceLocator() {
		return $this->serviceLocator;
	}

    public function __invoke($start, $end, $recurrence)
    {
        
        if(!empty($recurrence)){
            $startDate   = new \DateTime($start);
            $endDate     = new \DateTime($end); // Optional
            
            $recurrence = str_replace("RRULE:", "", $recurrence);
            $rule        = new \Recurr\Rule($recurrence, $startDate, $endDate, 'Europe/London');
            $transformer = new \Recurr\Transformer\ArrayTransformer();
            $textTransformer = new \Recurr\Transformer\TextTransformer();
            return $textTransformer->transform($rule);
        }
        
        return false;
    }
}