<?php

namespace Szakdolgozat\FelhasznaloBundle\Request\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\EntityManager;

class FelhasznaloParamConverter implements ParamConverterInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function apply(Request $request, ConfigurationInterface $configuration)
    {
        $id = $request->attributes->get("id");

        $dql = 'SELECT f, j FROM Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo f
            JOIN f.jogok j WHERE f.id = ?1';

        $f = $this->entityManager
            ->createQuery($dql)
            ->setParameter(1, $id)
            ->getSingleResult();

        if (!$f) {
            throw new NotFoundHttpException();
        }

        $param = $configuration->getName();
        $request->setAttribute($param, $f);

        return true;
    }

    public function supports(ConfigurationInterface $configuration)
    {
        return 'Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo' === $configuration->getClass();
    }
}
