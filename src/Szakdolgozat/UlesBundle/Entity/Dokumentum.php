<?php

namespace Szakdolgozat\UlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="dokumentum")
 */
class Dokumentum
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ules", inversedBy="dokumentumok")
     * @ORM\JoinColumn(name="ules_id", referencedColumnName="id", nullable=false)
     */
    protected $ules;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $leiras;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $eredeti_filenev;

    public $file; // a feltoltes form hasznalja

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
     * Set leiras
     *
     * @param string $leiras
     * @return Dokumentum
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
     * Set eredeti_filenev
     *
     * @param string $eredetiFilenev
     * @return Dokumentum
     */
    public function setEredetiFilenev($eredetiFilenev)
    {
        $this->eredeti_filenev = $eredetiFilenev;
    
        return $this;
    }

    /**
     * Get eredeti_filenev
     *
     * @return string 
     */
    public function getEredetiFilenev()
    {
        return $this->eredeti_filenev;
    }

    /**
     * Set ules
     *
     * @param \Szakdolgozat\UlesBundle\Entity\Ules $ules
     * @return Dokumentum
     */
    public function setUles(Ules $ules = null)
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

    public function getUploadDir()
    {
        return __DIR__ . "/../../../../uploads/dokumentum/";
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null === $this->file) {
            return;
        }

        $this->setEredetiFilenev($this->file->getClientOriginalName());
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function uploadFile()
    {
        if (null === $this->file) {
            return;
        }

        $this->file->move($this->getUploadDir(), $this->id);

        unset($this->file);

    }

    /**
     * @ORM\PostRemove()
     */
    public function removeFile()
    {
        @unlink($this->getUploadDir() . $this->id);
    }

    public function getFilename()
    {
        return $this->getUploadDir() . $this->id;
    }
}