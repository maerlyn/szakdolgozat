<?php

namespace Szakdolgozat\UlesBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UlesRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->createQueryBuilder("u")
            ->select("u, f")
            ->leftJoin("u.felhasznalo", "f")
            ->orderBy("u.datum", "ASC")
            ->getQuery()
            ->getResult();
    }
}
