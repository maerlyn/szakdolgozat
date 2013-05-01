<?php

namespace Szakdolgozat\JegyzokonyvBundle\Entity;

use Doctrine\ORM\EntityRepository;

class JegyzokonyvRepository extends EntityRepository
{
    public function lezaratlanJegyzokonyveim($felhasznalo)
    {
        $qb = $this->createQueryBuilder("j");

        return $qb
            ->select("j")
            ->where($qb->expr()->isNull("j.lezarva"))
            ->andWhere($qb->expr()->eq("j.jegyzokonyviro", "?1"))
            ->setParameter(1, $felhasznalo)
            ->getQuery()
            ->getResult()
            ;
    }

    public function hitelesitesreVaroJegyzokonyveim($felhasznalo)
    {
        $qb = $this->createQueryBuilder("j");

        return $qb
            ->select("j")
            ->where($qb->expr()->isNotNull("j.lezarva"))
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->andX(
                        $qb->expr()->isNull("j.hitelesitve_1"),
                        $qb->expr()->eq("j.hitelesito_1", "?1")
                    ),
                    $qb->expr()->andX(
                        $qb->expr()->isNull("j.hitelesitve_2"),
                        $qb->expr()->eq("j.hitelesito_2", "?2")
                    )
                )
            )
            ->setParameter("1", $felhasznalo)
            ->setParameter("2", $felhasznalo)
            ->getQuery()
            ->getResult()
            ;
    }
}
