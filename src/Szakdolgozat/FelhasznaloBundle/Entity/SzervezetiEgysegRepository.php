<?php

namespace Szakdolgozat\FelhasznaloBundle\Entity;

use Doctrine\ORM\EntityRepository;

class SzervezetiEgysegRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->createQueryBuilder("sze")
            ->select("sze", "f", "j")
            ->leftJoin("sze.felhasznalok", "f")
            ->leftJoin("f.jogok", "j")
            ->orderBy("sze.nev", "ASC")
            ->getQuery()
            ->getResult();
    }
}
