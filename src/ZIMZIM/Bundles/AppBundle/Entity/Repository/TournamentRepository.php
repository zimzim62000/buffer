<?php


namespace ZIMZIM\Bundles\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\SecurityContext;

class TournamentRepository extends EntityRepository
{
    public function getListTournamentActive(\DateTime $now){

        $query = $this->createQueryBuilder('t');
        $query->where('t.dateEnd >= :dateDay')
            ->andWhere('t.enabled = 1')
            ->setParameter('dateDay', $now)
            ->orderBy('t.dateStart', 'ASC');
        return $query->getQuery()->getResult();
    }
}
