<?php

namespace Szakdolgozat\JegyzokonyvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class JegyzokonyvFelszolalas extends JegyzokonyvElem
{
    /**
     * @ORM\Column(type="text")
     */
    protected $szoveg;
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
     * Set szoveg
     *
     * @param string $szoveg
     * @return JegyzokonyvFelszolalas
     */
    public function setSzoveg($szoveg)
    {
        $this->szoveg = $szoveg;
    
        return $this;
    }

    /**
     * Get szoveg
     *
     * @return string 
     */
    public function getSzoveg()
    {
        return $this->szoveg;
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
     * @return JegyzokonyvFelszolalas
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
     * @return JegyzokonyvFelszolalas
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
        $this->szoveg = $data["szoveg"];
    }
}
