<?php

namespace Szakdolgozat\FelhasznaloBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="jog")
 */
class Jog
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50);
     */
    protected $role;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $nev;

    /**
     * @ORM\Column()
     */
    protected $leiras;

    /**
     * @ORM\ManyToMany(targetEntity="Felhasznalo", mappedBy="jogok")
     */
    protected $felhasznalok;

    public function __construct()
    {
        $this->felhasznalok = new ArrayCollection;
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
     * Set nev
     *
     * @param string $nev
     * @return Jog
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

    /**
     * Set leiras
     *
     * @param string $leiras
     * @return Jog
     */
    public function setLeiras($leiras)
    {
        $this->leiras = $leiras;
    
        return $this;
    }

    /**
     * Get leiras
     *
     * @return string 
     */
    public function getLeiras()
    {
        return $this->leiras;
    }

    /**
     * Add felhasznalok
     *
     * @param \Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo $felhasznalok
     * @return Jog
     */
    public function addFelhasznalok(\Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo $felhasznalok)
    {
        $this->felhasznalok[] = $felhasznalok;
    
        return $this;
    }

    /**
     * Remove felhasznalok
     *
     * @param \Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo $felhasznalok
     */
    public function removeFelhasznalok(\Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo $felhasznalok)
    {
        $this->felhasznalok->removeElement($felhasznalok);
    }

    /**
     * Get felhasznalok
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFelhasznalok()
    {
        return $this->felhasznalok;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return Jog
     */
    public function setRole($role)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }
}