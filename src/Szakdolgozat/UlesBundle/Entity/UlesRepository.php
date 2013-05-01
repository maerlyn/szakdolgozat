<?php

namespace Szakdolgozat\UlesBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UlesRepository extends EntityRepository
{
    public function kovetkezoUleseim($felhasznalo)
    {
        $qb = $this->createQueryBuilder("u");

        return $qb
            ->select("u")
            ->innerJoin("u.meghivottak", "m")
            ->where("u.datum >= ?1")
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->eq("u.nyilvanos", "1"),
                    $qb->expr()->eq("u.felhasznalo", "?2"),
                    $qb->expr()->eq("m", "?3")
                )
            )
            ->orderBy("u.datum", "ASC")
            ->setParameter(1, new \DateTime())
            ->setParameter(2, $felhasznalo)
            ->setParameter(3, $felhasznalo)
            ->getQuery()
            ->getResult()
            ;
    }

    public function jegyzokonyvNelkuliUleseim($felhasznalo)
    {
        $qb = $this->createQueryBuilder("u");

        $mult = new \DateTime();
        $mult->modify("-3 weeks");

        return $qb
            ->select("u")
            ->innerJoin("u.meghivottak", "m")
            ->where("u.datum <= ?1")
            ->andWhere("u.datum >= ?2")
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->eq("u.nyilvanos", "1"),
                    $qb->expr()->eq("u.felhasznalo", "?3"),
                    $qb->expr()->eq("m", "?4")
                )
            )
            ->andWhere($qb->expr()->isNull("u.jegyzokonyv"))
            ->orderBy("u.datum", "ASC")
            ->setParameter(1, new \DateTime())
            ->setParameter(2, $mult)
            ->setParameter(3, $felhasznalo)
            ->setParameter(4, $felhasznalo)
            ->getQuery()
            ->getResult()
            ;

    }

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
