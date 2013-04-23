<?php

namespace Szakdolgozat\FelhasznaloBundle\Entity;

use Doctrine\ORM\EntityRepository;

class FelhasznaloRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->createQueryBuilder("f")
            ->select("f")
            ->orderBy("f.nev", "ASC")
            ->getQuery()
            ->getResult();
    }
}
