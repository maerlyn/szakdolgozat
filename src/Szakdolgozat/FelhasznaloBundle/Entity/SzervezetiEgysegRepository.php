<?php

namespace Szakdolgozat\FelhasznaloBundle\Entity;

use Doctrine\ORM\EntityRepository;

class SzervezetiEgysegRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->createQueryBuilder("sze")
            ->select("sze")
            ->orderBy("sze.nev", "ASC")
            ->getQuery()
            ->getResult();
    }
}
