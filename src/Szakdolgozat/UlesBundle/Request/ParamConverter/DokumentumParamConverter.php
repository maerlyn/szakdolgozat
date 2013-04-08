<?php

namespace Szakdolgozat\UlesBundle\Request\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\EntityManager;

class DokumentumParamConverter implements ParamConverterInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function apply(Request $request, ConfigurationInterface $configuration)
    {
        $id = $request->attributes->get("dokumentum_id");

        $dql = 'SELECT d FROM Szakdolgozat\UlesBundle\Entity\Dokumentum d WHERE d.id = ?1';

        $d = $this->entityManager
            ->createQuery($dql)
            ->setParameter(1, $id)
            ->getSingleResult();

        if (!$d) {
            throw new NotFoundHttpException();
        }

        $param = $configuration->getName();
        $request->attributes->set($param, $d);

        return true;
    }

    public function supports(ConfigurationInterface $configuration)
    {
        return 'Szakdolgozat\UlesBundle\Entity\Dokumentum' === $configuration->getClass();
    }
}
