<?php

namespace Szakdolgozat\FelhasznaloBundle\Request\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\EntityManager;

class SzervezetiEgysegParamConverter implements ParamConverterInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function apply(Request $request, ConfigurationInterface $configuration)
    {
        $id = $request->attributes->get("id");

        $dql = 'SELECT sze FROM Szakdolgozat\FelhasznaloBundle\Entity\SzervezetiEgyseg sze WHERE sze.id = ?1';

        $sze = $this->entityManager
             ->createQuery($dql)
             ->setParameter(1, $id)
             ->getSingleResult();

        if (!$sze) {
            throw new NotFoundHttpException();
        }

        $param = $configuration->getName();
        $request->attributes->set($param, $sze);

        return true;
    }

    public function supports(ConfigurationInterface $configuration)
    {
        return 'Szakdolgozat\FelhasznaloBundle\Entity\SzervezetiEgyseg' === $configuration->getClass();
    }
}
