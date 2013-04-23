<?php

namespace Szakdolgozat\JegyzokonyvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class JegyzokonyvNapirendiPont extends JegyzokonyvElem
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $cim;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $eloterjeszto;

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
     * @return JegyzokonyvNapirendiPont
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
     * @return JegyzokonyvNapirendiPont
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
     * @return JegyzokonyvNapirendiPont
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
        $this->cim          = $data["cim"];
        $this->eloterjeszto = $data["eloterjeszto"];
    }

    public function tipus()
    {
        return "napirendipont";
    }

    /**
     * Set eloterjeszto
     *
     * @param string $eloterjeszto
     * @return JegyzokonyvNapirendiPont
     */
    public function setEloterjeszto($eloterjeszto)
    {
        $this->eloterjeszto = $eloterjeszto;
    
        return $this;
    }

    /**
     * Get eloterjeszto
     *
     * @return string 
     */
    public function getEloterjeszto()
    {
        return $this->eloterjeszto;
    }
}