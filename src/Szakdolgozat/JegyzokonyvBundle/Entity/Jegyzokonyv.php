<?php

namespace Szakdolgozat\JegyzokonyvBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Szakdolgozat\JegyzokonyvBundle\Entity\JegyzokonyvRepository")
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
     * @ORM\Column(type="time")
     */
    protected $ules_vege;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $helyszin;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $ules_hatarozatkepes;

    /**
     * @ORM\Column(type="integer")
     */
    protected $szavazati_jogu_tagok_szama;

    /**
     * @ORM\Column(type="integer")
     */
    protected $jelen_levo_szavazati_joguak;

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
     * @ORM\OneToMany(targetEntity="JegyzokonyvElem", mappedBy="jegyzokonyv")
     * @ORM\OrderBy({"pozicio"="ASC"})
     */
    protected $elemek;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $lezarva;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $hitelesitve_1;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $hitelesitve_2;

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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->elemek = new ArrayCollection();
    }

    /**
     * Add elemek
     *
     * @param \Szakdolgozat\JegyzokonyvBundle\Entity\JegyzokonyvElem $elemek
     * @return Jegyzokonyv
     */
    public function addElemek(\Szakdolgozat\JegyzokonyvBundle\Entity\JegyzokonyvElem $elemek)
    {
        $this->elemek[] = $elemek;

        return $this;
    }

    public function clearElemek()
    {
        $this->elemek = new ArrayCollection();

        return $this;
    }

    /**
     * Remove elemek
     *
     * @param \Szakdolgozat\JegyzokonyvBundle\Entity\JegyzokonyvElem $elemek
     */
    public function removeElemek(\Szakdolgozat\JegyzokonyvBundle\Entity\JegyzokonyvElem $elemek)
    {
        $this->elemek->removeElement($elemek);
    }

    /**
     * Get elemek
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getElemek()
    {
        return $this->elemek;
    }

    /**
     * Set ules_vege
     *
     * @param \DateTime $ulesVege
     * @return Jegyzokonyv
     */
    public function setUlesVege($ulesVege)
    {
        $this->ules_vege = $ulesVege;
    
        return $this;
    }

    /**
     * Get ules_vege
     *
     * @return \DateTime 
     */
    public function getUlesVege()
    {
        return $this->ules_vege;
    }

    /**
     * Set ules_hatarozatkepes
     *
     * @param boolean $ulesHatarozatkepes
     * @return Jegyzokonyv
     */
    public function setUlesHatarozatkepes($ulesHatarozatkepes)
    {
        $this->ules_hatarozatkepes = $ulesHatarozatkepes;
    
        return $this;
    }

    /**
     * Get ules_hatarozatkepes
     *
     * @return boolean 
     */
    public function getUlesHatarozatkepes()
    {
        return $this->ules_hatarozatkepes;
    }

    /**
     * Set szavazati_jogu_tagok_szama
     *
     * @param integer $szavazatiJoguTagokSzama
     * @return Jegyzokonyv
     */
    public function setSzavazatiJoguTagokSzama($szavazatiJoguTagokSzama)
    {
        $this->szavazati_jogu_tagok_szama = $szavazatiJoguTagokSzama;
    
        return $this;
    }

    /**
     * Get szavazati_jogu_tagok_szama
     *
     * @return integer 
     */
    public function getSzavazatiJoguTagokSzama()
    {
        return $this->szavazati_jogu_tagok_szama;
    }

    /**
     * Set jelen_levo_szavazati_joguak
     *
     * @param integer $jelenLevoSzavazatiJoguak
     * @return Jegyzokonyv
     */
    public function setJelenLevoSzavazatiJoguak($jelenLevoSzavazatiJoguak)
    {
        $this->jelen_levo_szavazati_joguak = $jelenLevoSzavazatiJoguak;
    
        return $this;
    }

    /**
     * Get jelen_levo_szavazati_joguak
     *
     * @return integer 
     */
    public function getJelenLevoSzavazatiJoguak()
    {
        return $this->jelen_levo_szavazati_joguak;
    }

    /**
     * Set lezarva
     *
     * @param \DateTime $lezarva
     * @return Jegyzokonyv
     */
    public function setLezarva($lezarva)
    {
        $this->lezarva = $lezarva;
    
        return $this;
    }

    /**
     * Get lezarva
     *
     * @return \DateTime 
     */
    public function getLezarva()
    {
        return $this->lezarva;
    }

    /**
     * Set hitelesitve_1
     *
     * @param \DateTime $hitelesitve1
     * @return Jegyzokonyv
     */
    public function setHitelesitve1($hitelesitve1)
    {
        $this->hitelesitve_1 = $hitelesitve1;
    
        return $this;
    }

    /**
     * Get hitelesitve_1
     *
     * @return \DateTime 
     */
    public function getHitelesitve1()
    {
        return $this->hitelesitve_1;
    }

    /**
     * Set hitelesitve_2
     *
     * @param \DateTime $hitelesitve2
     * @return Jegyzokonyv
     */
    public function setHitelesitve2($hitelesitve2)
    {
        $this->hitelesitve_2 = $hitelesitve2;
    
        return $this;
    }

    /**
     * Get hitelesitve_2
     *
     * @return \DateTime 
     */
    public function getHitelesitve2()
    {
        return $this->hitelesitve_2;
    }
}