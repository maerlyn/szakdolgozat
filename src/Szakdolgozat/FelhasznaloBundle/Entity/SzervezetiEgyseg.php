<?php

namespace Szakdolgozat\FelhasznaloBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Szakdolgozat\FelhasznaloBundle\Entity\SzervezetiEgysegRepository")
 * @ORM\Table(name="szervezeti_egyseg")
 */
class SzervezetiEgyseg
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $nev;

    /**
     * @ORM\OneToMany(targetEntity="Felhasznalo", mappedBy="szervezeti_egyseg")
     */
    protected $felhasznalok;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->felhasznalok = new ArrayCollection();
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
     * @return SzervezetiEgyseg
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
     * Add felhasznalok
     *
     * @param \Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo $felhasznalok
     * @return SzervezetiEgyseg
     */
    public function addFelhasznalok(Felhasznalo $felhasznalok)
    {
        $this->felhasznalok[] = $felhasznalok;
    
        return $this;
    }

    /**
     * Remove felhasznalok
     *
     * @param \Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo $felhasznalok
     */
    public function removeFelhasznalok(Felhasznalo $felhasznalok)
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

    public function __toString()
    {
        return $this->nev;
    }
}
