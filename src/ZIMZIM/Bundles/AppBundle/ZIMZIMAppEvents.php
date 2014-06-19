<?php

namespace ZIMZIM\Bundles\AppBundle;

final class ZIMZIMAppEvents{

    /**
     * create ZIMZIM\Bundles\WorldCupBundle\Entity\ClientGame
     * when user register on mainGame on ZIMZIM\Bundles\WorldCupBundle\Entity\MainGame
     */
    const CREATE_USERTOURNAMENT = 'zimzim_bundles_app.usertournament.create';

}