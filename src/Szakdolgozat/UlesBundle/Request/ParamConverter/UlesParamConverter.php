<?php

namespace Szakdolgozat\UlesBundle\Request\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\EntityManager;

class UlesParamConverter implements ParamConverterInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function apply(Request $request, ConfigurationInterface $configuration)
    {
        $id = $request->attributes->get("id");

        $dql = 'SELECT u FROM Szakdolgozat\UlesBundle\Entity\Ules u WHERE u.id = ?1';

        $u = $this->entityManager
            ->createQuery($dql)
            ->setParameter(1, $id)
            ->getSingleResult();

        if (!$u) {
            throw new NotFoundHttpException();
        }

        $param = $configuration->getName();
        $request->attributes->set($param, $u);

        return true;
    }

    public function supports(ConfigurationInterface $configuration)
    {
        return 'Szakdolgozat\UlesBundle\Entity\Ules' === $configuration->getClass();
    }
}
