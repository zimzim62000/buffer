<?php

namespace ZIMZIM\Bundles\AppBundle\Calculate;


use Doctrine\ORM\EntityManager;
use ZIMZIM\Bundles\AppBundle\Entity\Game;
use ZIMZIM\Bundles\AppBundle\Entity\RequestUserRanking;

class CalculateRanking
{
    private $em;
    private $requestUserRanking;

    public function __construct(EntityManager $em, RequestUserRanking $requestUserRanking)
    {
        $this->em = $em;
        $this->requestUserRanking = $requestUserRanking;
    }


    public function calcul(Game $game)
    {

        $requestsUser = $this->em->getRepository('ZIMZIMBundlesAppBundle:RequestUser')->getEnabledByGame($game);

        foreach ($requestsUser as $requestUser) {

            $scoreUser = 0;
            $maxScoreUser = 0;

            foreach ($requestUser->getScores() as $score) {

                $scoreUser += $score->getScore();
                if ($score->getScore() === CalculateGamePoint::MAX_POINT) {
                    $maxScoreUser++;
                }

            }

            $requestUserRanking = $this->em->getRepository('ZIMZIMBundlesAppBundle:RequestUserRanking')->findOneBy(
                array('requestUser' => $requestUser)
            );

            if(!$requestUserRanking instanceOf RequestUserRanking){
                $requestUserRanking = clone $this->requestUserRanking;
                $requestUserRanking->setRequestUser($requestUser);
            }
            $requestUserRanking->setScore($scoreUser);
            $requestUserRanking->setNbMaxScore($maxScoreUser);
            $this->em->persist($requestUserRanking);
        }

        $this->em->flush();

    }

}