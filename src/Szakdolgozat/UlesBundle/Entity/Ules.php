<?php

namespace Szakdolgozat\UlesBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo;

/**
 * @ORM\Entity
 * @ORM\Table(name="ules")
 */
class Ules
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo")
     * @ORM\JoinColumn(name="felhasznalo_id", referencedColumnName="id")
     */
    protected $felhasznalo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $nev;

    /**
     * @ORM\Column(type="text")
     */
    protected $leiras;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $datum;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $helyszin;

    /**
     * @ORM\ManyToMany(targetEntity="Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo")
     * @ORM\JoinTable(name="ules_meghivott")
     */
    protected $meghivottak;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->meghivottak = new ArrayCollection();
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
     * @return Ules
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
     * @return Ules
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
     * Set datum
     *
     * @param \DateTime $datum
     * @return Ules
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;
    
        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime 
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set helyszin
     *
     * @param string $helyszin
     * @return Ules
     */
    public function setHelyszin($helyszin)
    {
        $this->helyszin = $helyszin;
    
        return $this;
    }

    /**
     * Get helyszin
     *
     * @return string 
     */
    public function getHelyszin()
    {
        return $this->helyszin;
    }

    /**
     * Set felhasznalo
     *
     * @param \Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo $felhasznalo
     * @return Ules
     */
    public function setFelhasznalo(Felhasznalo $felhasznalo = null)
    {
        $this->felhasznalo = $felhasznalo;
    
        return $this;
    }

    /**
     * Get felhasznalo
     *
     * @return \Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo 
     */
    public function getFelhasznalo()
    {
        return $this->felhasznalo;
    }

    /**
     * Add meghivottak
     *
     * @param \Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo $meghivottak
     * @return Ules
     */
    public function addMeghivottak(Felhasznalo $meghivottak)
    {
        $this->meghivottak[] = $meghivottak;
    
        return $this;
    }

    /**
     * Remove meghivottak
     *
     * @param \Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo $meghivottak
     */
    public function removeMeghivottak(Felhasznalo $meghivottak)
    {
        $this->meghivottak->removeElement($meghivottak);
    }

    /**
     * Get meghivottak
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMeghivottak()
    {
        return $this->meghivottak;
    }
}