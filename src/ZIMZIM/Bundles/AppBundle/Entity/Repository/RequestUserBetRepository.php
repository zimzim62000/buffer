<?php

namespace ZIMZIM\Bundles\AppBundle\Entity\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\SecurityContext;
use ZIMZIM\Bundles\AppBundle\Entity\Game;
use ZIMZIM\Bundles\UserBundle\Entity\User;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RequestUserBetRepository extends EntityRepository
{

    public function findByGameandUser(Game $game, User $user){

        $query = $this->createQueryBuilder('rub');
        $query->join('rub.game', 'g')
            ->join('rub.requestUser', 'ru')
            ->join('ru.user', 'u')
            ->where('u.id = :id_user')
            ->andWhere('g.id = :id_game')
            ->setParameter('id_user', $user->getId())
            ->setParameter('id_game', $game->getId());

        return $query->getQuery()->getResult();
    }

}