<?php
namespace Base\View\Helper;

use Zend\View\Helper\AbstractHelper;

class SocialSignInButton extends AbstractHelper
{
    public function __invoke($provider, $redirect = false, $icon = null)
    {
        $redirectArg = $redirect ? '?redirect=' . $redirect : '';
        
        echo "<a class=\"btn btn-md btn-primary\" href=\""
            . $this->view->url('scn-social-auth-user/login/provider', array('provider' => $provider))
            . $redirectArg . '"><i class="fa '.$icon.'"></i> ' . ucfirst($provider) . '</a>';
    }
}
