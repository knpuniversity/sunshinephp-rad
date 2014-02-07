<?php

namespace App\Entity;

use Knp\RadBundle\Doctrine\EntityRepository;

/**
 * PlayerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlayerRepository extends EntityRepository
{
    public function getCaptainForTeam(Team $team)
    {
        return $this->build()
            ->andWhere($this->getAlias().'.team = :team')
            ->setParameter('team', $team)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
