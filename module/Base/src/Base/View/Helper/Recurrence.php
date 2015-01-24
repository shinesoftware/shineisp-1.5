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
            
            $translator = $this->getServiceLocator()->getServiceLocator()->get('translator');
            $locale = $translator->getTranslator()->getLocale();
            $fallbackLocale = $translator->getTranslator()->getFallbackLocale();
            setlocale (LC_TIME, $locale);
            
            $recurrence = str_replace("RRULE:", "", $recurrence);
            $rule        = new \Recurr\Rule($recurrence, $startDate, $endDate, 'Europe/London');
            $transformer = new \Recurr\Transformer\ArrayTransformer();
            
            $trans = new \Recurr\Transformer\Translator();
            try{
                $trans->loadLocale(substr($locale, 0, 2));
            }catch(\Exception $e){
                $trans->loadLocale(substr($fallbackLocale, 0, 2));
            }
            
            $textTransformer = new \Recurr\Transformer\TextTransformer($trans);
            return $textTransformer->transform($rule);
        }
        
        return false;
    }
}