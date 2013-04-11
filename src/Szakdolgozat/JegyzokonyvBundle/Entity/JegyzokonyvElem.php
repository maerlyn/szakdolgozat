<?php

namespace Szakdolgozat\JegyzokonyvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="jegyzokonyv_elem")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\DiscriminatorMap({
 *     "napirendi_pont" = "JegyzokonyvNapirendiPont",
 *     "felszolalas" = "JegyzokonyvFelszolalas",
 *     "szavazas" = "JegyzokonyvSzavazas"
 * })
 */
class JegyzokonyvElem
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Jegyzokonyv")
     * @ORM\JoinColumn(name="jegyzokonyv_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    protected $jegyzokonyv;

    /**
     * @ORM\Column(type="integer")
     */
    protected $pozicio;

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
     * @return JegyzokonyvElem
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
     * @return JegyzokonyvElem
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
}
