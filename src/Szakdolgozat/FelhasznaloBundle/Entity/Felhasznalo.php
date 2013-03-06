<?php

namespace Szakdolgozat\FelhasznaloBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="felhasznalo")
 */
class Felhasznalo implements UserInterface
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $nev;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $szervezeti_egyseg;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $pozicio;

    /**
     * @ORM\ManyToMany(targetEntity="Jog", inversedBy="felhasznalok")
     * @ORM\JoinTable(name="felhasznalo_jog")
     */
    protected $jogok;

    public function getRoles()
    {
        $ret = array("ROLE_USER");

        foreach ($this->jogok as $jog) { /** @var Jog $jog */
            $ret[] = $jog->getRole();
        }

        return $ret;
    }

    public function __construct()
    {
        $this->jogok = new ArrayCollection();
    }

    public function getPassword()
    {
       return;
    }

    public function getSalt()
    {
        return;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }


    public function eraseCredentials()
    {
        return;
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
     * Set email
     *
     * @param string $email
     * @return Felhasznalo
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set szervezeti_egyseg
     *
     * @param string $szervezetiEgyseg
     * @return Felhasznalo
     */
    public function setSzervezetiEgyseg($szervezetiEgyseg)
    {
        $this->szervezeti_egyseg = $szervezetiEgyseg;
    
        return $this;
    }

    /**
     * Get szervezeti_egyseg
     *
     * @return string 
     */
    public function getSzervezetiEgyseg()
    {
        return $this->szervezeti_egyseg;
    }

    /**
     * Set pozicio
     *
     * @param string $pozicio
     * @return Felhasznalo
     */
    public function setPozicio($pozicio)
    {
        $this->pozicio = $pozicio;
    
        return $this;
    }

    /**
     * Get pozicio
     *
     * @return string 
     */
    public function getPozicio()
    {
        return $this->pozicio;
    }

    /**
     * Add jogok
     *
     * @param \Szakdolgozat\FelhasznaloBundle\Entity\Jog $jogok
     * @return Felhasznalo
     */
    public function addJogok(\Szakdolgozat\FelhasznaloBundle\Entity\Jog $jogok)
    {
        $this->jogok[] = $jogok;
    
        return $this;
    }

    /**
     * Remove jogok
     *
     * @param \Szakdolgozat\FelhasznaloBundle\Entity\Jog $jogok
     */
    public function removeJogok(\Szakdolgozat\FelhasznaloBundle\Entity\Jog $jogok)
    {
        $this->jogok->removeElement($jogok);
    }

    /**
     * Get jogok
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJogok()
    {
        return $this->jogok;
    }

    /**
     * Set nev
     *
     * @param string $nev
     * @return Felhasznalo
     */
    public function setNev($nev)
    {
        $this->nev = $nev;
    
        return $this;
    }

    /**
     * Get nev
     *
     * @return string 
     */
    public function getNev()
    {
        return $this->nev;
    }
}