<?php 
namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;

class MapHelper extends AbstractHelper
{
    public function __invoke($address)
    {
        $coords = array();
        
        if(!empty($address)){
            foreach ($address as $item){
                if(is_array($item)){
                    $coords[] = array('lat' => $item['latitude'], 'lng' => $item['longitude']);
                }else{
                    if($item->getLatitude() && $item->getLongitude()){
                        $coords[] = array('lat' => $item->getLatitude(), 'lng' => $item->getLongitude());
                    }
                }
            }
        }
        
        return $this->view->render('base/partial/map', array('coords' => $coords));
    }
}