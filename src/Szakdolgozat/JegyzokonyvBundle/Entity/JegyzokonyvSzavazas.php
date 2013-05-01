<?php

namespace Szakdolgozat\JegyzokonyvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormFactory;
use Szakdolgozat\JegyzokonyvBundle\Form\SzavazasType;

/**
 * @ORM\Entity
 */
class JegyzokonyvSzavazas extends JegyzokonyvElem
{
    /**
     * @ORM\Column(type="string")
     */
    protected $cim;

    /**
     * @ORM\Column(type="integer")
     */
    protected $mellette;

    /**
     * @ORM\Column(type="integer")
     */
    protected $ellene;

    /**
     * @ORM\Column(type="integer")
     */
    protected $tartozkodott;

    /**
     * @ORM\Column(type="integer")
     */
    protected $ervenytelen;
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $pozicio;

    /**
     * @var \Szakdolgozat\JegyzokonyvBundle\Entity\Jegyzokonyv
     */
    protected $jegyzokonyv;


    /**
     * Set cim
     *
     * @param string $cim
     * @return JegyzokonyvSzavazas
     */
    public function setCim($cim)
    {
        $this->cim = $cim;
    
        return $this;
    }

    /**
     * Get cim
     *
     * @return string 
     */
    public function getCim()
    {
        return $this->cim;
    }

    /**
     * Set mellette
     *
     * @param integer $mellette
     * @return JegyzokonyvSzavazas
     */
    public function setMellette($mellette)
    {
        $this->mellette = $mellette;
    
        return $this;
    }

    /**
     * Get mellette
     *
     * @return integer 
     */
    public function getMellette()
    {
        return $this->mellette;
    }

    /**
     * Set ellene
     *
     * @param integer $ellene
     * @return JegyzokonyvSzavazas
     */
    public function setEllene($ellene)
    {
        $this->ellene = $ellene;
    
        return $this;
    }

    /**
     * Get ellene
     *
     * @return integer 
     */
    public function getEllene()
    {
        return $this->ellene;
    }

    /**
     * Set tartozkodott
     *
     * @param integer $tartozkodott
     * @return JegyzokonyvSzavazas
     */
    public function setTartozkodott($tartozkodott)
    {
        $this->tartozkodott = $tartozkodott;
    
        return $this;
    }

    /**
     * Get tartozkodott
     *
     * @return integer 
     */
    public function getTartozkodott()
    {
        return $this->tartozkodott;
    }

    /**
     * Set ervenytelen
     *
     * @param integer $ervenytelen
     * @return JegyzokonyvSzavazas
     */
    public function setErvenytelen($ervenytelen)
    {
        $this->ervenytelen = $ervenytelen;
    
        return $this;
    }

    /**
     * Get ervenytelen
     *
     * @return integer 
     */
    public function getErvenytelen()
    {
        return $this->ervenytelen;
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
     * Set pozicio
     *
     * @param integer $pozicio
     * @return JegyzokonyvSzavazas
     */
    public function setPozicio($pozicio)
    {
        $this->pozicio = $pozicio;
    
        return $this;
    }

    /**
     * Get pozicio
     *
     * @return integer 
     */
    public function getPozicio()
    {
        return $this->pozicio;
    }

    /**
     * Set jegyzokonyv
     *
     * @param \Szakdolgozat\JegyzokonyvBundle\Entity\Jegyzokonyv $jegyzokonyv
     * @return JegyzokonyvSzavazas
     */
    public function setJegyzokonyv(\Szakdolgozat\JegyzokonyvBundle\Entity\Jegyzokonyv $jegyzokonyv = null)
    {
        $this->jegyzokonyv = $jegyzokonyv;
    
        return $this;
    }

    /**
     * Get jegyzokonyv
     *
     * @return \Szakdolgozat\JegyzokonyvBundle\Entity\Jegyzokonyv 
     */
    public function getJegyzokonyv()
    {
        return $this->jegyzokonyv;
    }

    public function fromArray(array $data)
    {
        $this->cim          =   $data["cim"];
        $this->mellette     =   $data["mellette"];
        $this->ellene       =   $data["ellene"];
        $this->tartozkodott =   $data["tartozkodott"];
        $this->ervenytelen  =   $data["ervenytelen"];
    }

    public function tipus()
    {
        return "szavazas";
    }

    public function szerkesztesAdatok(FormFactory $factory)
    {
        return array(
            "id"    =>  $this->getId(),
            "tipus" =>  "szavazas",
            "form"  =>  $factory->create(new SzavazasType(), $this),
        );
    }

}
