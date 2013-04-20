<?php

namespace Szakdolgozat\JegyzokonyvBundle\Request\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\EntityManager;

class JegyzokonyvParamConverter implements ParamConverterInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function apply(Request $request, ConfigurationInterface $configuration)
    {
        $id = $request->attributes->get("id");

        $dql = 'SELECT j, e FROM Szakdolgozat\JegyzokonyvBundle\Entity\Jegyzokonyv j
          INNER JOIN j.elemek e WHERE j.id = ?1';

        $j = $this->entityManager
            ->createQuery($dql)
            ->setParameter(1, $id)
            ->getSingleResult();

        if (!$j) {
            throw new NotFoundHttpException();
        }

        $param = $configuration->getName();
        $request->attributes->set($param, $j);

        return true;
    }

    public function supports(ConfigurationInterface $configuration)
    {
        return 'Szakdolgozat\JegyzokonyvBundle\Entity\Jegyzokonyv' === $configuration->getClass();
    }
}
