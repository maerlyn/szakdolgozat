<?php

namespace Szakdolgozat\FelhasznaloBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Entity(repositoryClass="Szakdolgozat\FelhasznaloBundle\Entity\FelhasznaloRepository")
 * @ORM\Table(name="felhasznalo")
 */
class Felhasznalo implements AdvancedUserInterface
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
     * @ORM\Column(type="string", length=100, unique=true, nullable=false)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $nev;

    /**
     * @ORM\ManyToOne(targetEntity="SzervezetiEgyseg", inversedBy="felhasznalok")
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

    /**
     * @ORM\Column(type="boolean")
     */
    protected $bejelentkezhet;


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
    public function addJogok(Jog $jogok)
    {
        $this->jogok[] = $jogok;
    
        return $this;
    }

    /**
     * Remove jogok
     *
     * @param \Szakdolgozat\FelhasznaloBundle\Entity\Jog $jogok
     */
    public function removeJogok(Jog $jogok)
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

    public function __toString()
    {
        return $this->nev;
    }

    /**
     * Set bejelentkezhet
     *
     * @param boolean $bejelentkezhet
     * @return Felhasznalo
     */
    public function setBejelentkezhet($bejelentkezhet)
    {
        $this->bejelentkezhet = $bejelentkezhet;
    
        return $this;
    }

    /**
     * Get bejelentkezhet
     *
     * @return boolean 
     */
    public function getBejelentkezhet()
    {
        return $this->bejelentkezhet;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->bejelentkezhet;
    }

    /**
     * Set szervezeti_egyseg
     *
     * @param \Szakdolgozat\FelhasznaloBundle\Entity\SzervezetiEgyseg $szervezetiEgyseg
     * @return Felhasznalo
     */
    public function setSzervezetiEgyseg(SzervezetiEgyseg $szervezetiEgyseg = null)
    {
        $this->szervezeti_egyseg = $szervezetiEgyseg;
    
        return $this;
    }

    /**
     * Get szervezeti_egyseg
     *
     * @return \Szakdolgozat\FelhasznaloBundle\Entity\SzervezetiEgyseg 
     */
    public function getSzervezetiEgyseg()
    {
        return $this->szervezeti_egyseg;
    }
}
