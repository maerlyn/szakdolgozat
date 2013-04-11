<?php

namespace Szakdolgozat\UlesBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo;

/**
 * @ORM\Entity(repositoryClass="Szakdolgozat\UlesBundle\Entity\UlesRepository")
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
     * @ORM\OneToMany(targetEntity="Dokumentum", mappedBy="ules")
     */
    protected $dokumentumok;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $nyilvanos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->meghivottak = new ArrayCollection();
        $this->dokumentumok = new ArrayCollection();
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

    /**
     * Add dokumentumok
     *
     * @param \Szakdolgozat\UlesBundle\Entity\Dokumentum $dokumentumok
     * @return Ules
     */
    public function addDokumentumok(\Szakdolgozat\UlesBundle\Entity\Dokumentum $dokumentumok)
    {
        $this->dokumentumok[] = $dokumentumok;
    
        return $this;
    }

    /**
     * Remove dokumentumok
     *
     * @param \Szakdolgozat\UlesBundle\Entity\Dokumentum $dokumentumok
     */
    public function removeDokumentumok(\Szakdolgozat\UlesBundle\Entity\Dokumentum $dokumentumok)
    {
        $this->dokumentumok->removeElement($dokumentumok);
    }

    /**
     * Get dokumentumok
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDokumentumok()
    {
        return $this->dokumentumok;
    }

    /**
     * Set nyilvanos
     *
     * @param boolean $nyilvanos
     * @return Ules
     */
    public function setNyilvanos($nyilvanos)
    {
        $this->nyilvanos = $nyilvanos;
    
        return $this;
    }

    /**
     * Get nyilvanos
     *
     * @return boolean 
     */
    public function getNyilvanos()
    {
        return $this->nyilvanos;
    }
}