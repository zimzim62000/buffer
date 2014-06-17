<?php

namespace ZIMZIM\Bundles\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ZIMZIMBundlesUserBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }
}
