<?php

namespace Szakdolgozat\FelhasznaloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fp\OpenIdBundle\Entity\UserIdentity as BaseUserIdentity;
use Fp\OpenIdBundle\Model\UserIdentityInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="openid_identity")
 */
class OpenIdIdentity extends BaseUserIdentity
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var UserInterface
     *
     * @ORM\ManyToOne(targetEntity="Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    protected $user;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param UserInterface $user
     * @return OpenIdIdentity
     */
    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo 
     */
    public function getUser()
    {
        return $this->user;
    }
}