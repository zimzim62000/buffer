<?php

namespace ZIMZIM\Bundles\AppBundle;

final class ZIMZIMAppEvents{

    /**
     * create ZIMZIM\Bundles\AppBundle\Entity\UserTournament
     * when user register on mainGame on ZIMZIM\Bundles\AppBundle\Entity\Tournament
     */
    const CREATE_USERTOURNAMENT = 'zimzim_bundles_app.usertournament.create';

    /**
     * do action for new request requestuser ZIMZIM\Bundles\AppBundle\Entity\RequestUser
     * when user register on mainGame on ZIMZIM\Bundles\AppBundle\Entity\RequestUser
     */
    const JOIN_REQUESTUSER = 'zimzim_bundles_app.requestuser.join';

    /**
     * do action for new request requestuser ZIMZIM\Bundles\AppBundle\Entity\RequestUser
     * when user register on mainGame on ZIMZIM\Bundles\AppBundle\Entity\RequestUser
     */
    const EMAIL_REQUESTUSER = 'zimzim_bundles_app.requestuser.sendemail';


    const BET_ALL_GAME = 'zimzim_bundles_app.requestuserbet.bet';


    const UPDATE_SCORE_GAME = 'zimzim_bundles_app.game.score';
}