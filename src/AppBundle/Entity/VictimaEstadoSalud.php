<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VictimaEstadoSalud
 *
 * @ORM\Table(name="victima_salud")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VictimaEstadoSaludRepository")
 */
class VictimaEstadoSalud
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Victima")
     * @ORM\JoinColumn(name="victima_id", referencedColumnName="id")
     */
    private $victimaId;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="EstadoDeSalud")     
     * @ORM\JoinColumn(name="estado_salud_id", referencedColumnName="id")
     */
    private $estadoSaludId;

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
     * @return VictimaEstadoSalud
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
     * @return VictimaEstadoSalud
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
     * Set estadoSaludId.
     *
     * @param \AppBundle\Entity\EstadoDeSalud $estadoSaludId
     *
     * @return VictimaEstadoSalud
     */
    public function setEstadoSaludId(\AppBundle\Entity\EstadoDeSalud $estadoSaludId)
    {
        $this->estadoSaludId = $estadoSaludId;

        return $this;
    }

    /**
     * Get estadoSaludId.
     *
     * @return \AppBundle\Entity\EstadoDeSalud
     */
    public function getEstadoSaludId()
    {
        return $this->estadoSaludId;
    }
}
