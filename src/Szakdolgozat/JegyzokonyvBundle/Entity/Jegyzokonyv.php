<?php

namespace Szakdolgozat\JegyzokonyvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="jegyzokonyv")
 */
class Jegyzokonyv
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo")
     * @ORM\JoinColumn(name="jegyzokonyviro_id", referencedColumnName="id", nullable=false)
     */
    protected $jegyzokonyviro;

    /**
     * @ORM\OneToOne(targetEntity="Szakdolgozat\UlesBundle\Entity\Ules", mappedBy="jegyzokonyv")
     */
    protected $ules;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $nev;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $datum;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $helyszin;

    /**
     * @ORM\ManyToOne(targetEntity="Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo")
     * @ORM\JoinColumn(name="hitelesito_1_id", referencedColumnName="id")
     */
    protected $hitelesito_1;

    /**
     * @ORM\ManyToOne(targetEntity="Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo")
     * @ORM\JoinColumn(name="hitelesito_2_id", referencedColumnName="id")
     */
    protected $hitelesito_2;

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
     * @return Jegyzokonyv
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
     * Set datum
     *
     * @param \DateTime $datum
     * @return Jegyzokonyv
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
     * @return Jegyzokonyv
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
     * Set jegyzokonyviro
     *
     * @param \Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo $jegyzokonyviro
     * @return Jegyzokonyv
     */
    public function setJegyzokonyviro(\Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo $jegyzokonyviro = null)
    {
        $this->jegyzokonyviro = $jegyzokonyviro;
    
        return $this;
    }

    /**
     * Get jegyzokonyviro
     *
     * @return \Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo 
     */
    public function getJegyzokonyviro()
    {
        return $this->jegyzokonyviro;
    }

    /**
     * Set ules
     *
     * @param \Szakdolgozat\UlesBundle\Entity\Ules $ules
     * @return Jegyzokonyv
     */
    public function setUles(\Szakdolgozat\UlesBundle\Entity\Ules $ules = null)
    {
        $this->ules = $ules;
    
        return $this;
    }

    /**
     * Get ules
     *
     * @return \Szakdolgozat\UlesBundle\Entity\Ules 
     */
    public function getUles()
    {
        return $this->ules;
    }

    /**
     * Set hitelesito_1
     *
     * @param \Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo $hitelesito1
     * @return Jegyzokonyv
     */
    public function setHitelesito1(\Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo $hitelesito1 = null)
    {
        $this->hitelesito_1 = $hitelesito1;
    
        return $this;
    }

    /**
     * Get hitelesito_1
     *
     * @return \Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo 
     */
    public function getHitelesito1()
    {
        return $this->hitelesito_1;
    }

    /**
     * Set hitelesito_2
     *
     * @param \Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo $hitelesito2
     * @return Jegyzokonyv
     */
    public function setHitelesito2(\Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo $hitelesito2 = null)
    {
        $this->hitelesito_2 = $hitelesito2;
    
        return $this;
    }

    /**
     * Get hitelesito_2
     *
     * @return \Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo 
     */
    public function getHitelesito2()
    {
        return $this->hitelesito_2;
    }
}
