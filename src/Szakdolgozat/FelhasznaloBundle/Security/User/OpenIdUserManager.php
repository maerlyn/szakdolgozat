<?php

namespace Szakdolgozat\FelhasznaloBundle\Security\User;

use Doctrine\ORM\EntityManager;
use Fp\OpenIdBundle\Model\UserManager;
use Fp\OpenIdBundle\Model\IdentityManagerInterface;
use Szakdolgozat\FelhasznaloBundle\Entity\OpenIdIdentity;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class OpenIdUserManager extends UserManager
{
    /** @var EntityManager */
    protected $entityManager;

    public function __construct(IdentityManagerInterface $identityManager, EntityManager $entityManager)
    {
        parent::__construct($identityManager);

        $this->entityManager = $entityManager;
    }

    public function createUserFromIdentity($identity, array $attributes = array())
    {
        if (!isset($attributes["contact/email"])) {
            throw new \Exception("Kell az email címed!");
        }

        $user = $this->entityManager->getRepository("SzakdolgozatFelhasznaloBundle:Felhasznalo")->findOneBy(array(
            "email" => $attributes["contact/email"],
        ));

        if (!$user) {
            throw new BadCredentialsException("Nincs ilyen felhasználó!");
        }

        $openIdIdentity = new OpenIdIdentity();
        $openIdIdentity->setIdentity($identity);
        $openIdIdentity->setAttributes($attributes);
        $openIdIdentity->setUser($user);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }


}
