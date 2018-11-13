<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VictimaRedes
 *
 * @ORM\Table(name="victima_redes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VictimaRedesRepository")
 */
class VictimaRedes
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Victima")     
     * @ORM\JoinColumn(name="victima_id", referencedColumnName="id")
     */
    private $victimaId;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Redes")     
     * @ORM\JoinColumn(name="redes_id", referencedColumnName="id")
     */
    private $redesId;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=255, nullable=true)
     */
    private $observacion;


    /**
     * Set observacion.
     *
     * @param string|null $observacion
     *
     * @return VictimaRedes
     */
    public function setObservacion($observacion = null)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion.
     *
     * @return string|null
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set victimaId.
     *
     * @param \AppBundle\Entity\Victima $victimaId
     *
     * @return VictimaRedes
     */
    public function setVictimaId(\AppBundle\Entity\Victima $victimaId)
    {
        $this->victimaId = $victimaId;

        return $this;
    }

    /**
     * Get victimaId.
     *
     * @return \AppBundle\Entity\Victima
     */
    public function getVictimaId()
    {
        return $this->victimaId;
    }

    /**
     * Set redesId.
     *
     * @param \AppBundle\Entity\Redes $redesId
     *
     * @return VictimaRedes
     */
    public function setRedesId(\AppBundle\Entity\Redes $redesId)
    {
        $this->redesId = $redesId;

        return $this;
    }

    /**
     * Get redesId.
     *
     * @return \AppBundle\Entity\Redes
     */
    public function getRedesId()
    {
        return $this->redesId;
    }
}
