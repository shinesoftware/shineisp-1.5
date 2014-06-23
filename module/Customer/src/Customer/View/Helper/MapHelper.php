<?php 
namespace Customer\View\Helper;
use Zend\View\Helper\AbstractHelper;

class MapHelper extends AbstractHelper
{
    public function __invoke($addresses)
    {
        $coords = array();
        
        if(!empty($addresses)){
            foreach ($addresses as $address){
                if($address->getLatitude() && $address->getLongitude()){
                    $coords[] = array('lat' => $address->getLatitude(), 'lng' => $address->getLongitude());
                }
            }
        }
        
        return $this->view->render('customer/partial/map', array('coords' => $coords));
    }
}