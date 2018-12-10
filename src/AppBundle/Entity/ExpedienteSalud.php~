<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpedienteSalud
 *
 * @ORM\Table(name="expediente_salud")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExpedienteSaludRepository")
 */
class ExpedienteSalud
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Expediente", inversedBy="expedienteSalud")
     * @ORM\JoinColumn(name="expediente_id", referencedColumnName="id")
     */
    private $expedienteId;

    /**
     * @ORM\ManyToOne(targetEntity="EstadoDeSalud", inversedBy="expedienteSalud")
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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set observacion.
     *
     * @param string|null $observacion
     *
     * @return ExpedienteSalud
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
     * Set expedienteId.
     *
     * @param \AppBundle\Entity\Expediente|null $expedienteId
     *
     * @return ExpedienteSalud
     */
    public function setExpedienteId(\AppBundle\Entity\Expediente $expedienteId = null)
    {
        $this->expedienteId = $expedienteId;

        return $this;
    }

    /**
     * Get expedienteId.
     *
     * @return \AppBundle\Entity\Expediente|null
     */
    public function getExpedienteId()
    {
        return $this->expedienteId;
    }

    /**
     * Set estadoSaludId.
     *
     * @param \AppBundle\Entity\EstadoDeSalud|null $estadoSaludId
     *
     * @return ExpedienteSalud
     */
    public function setEstadoSaludId(\AppBundle\Entity\EstadoDeSalud $estadoSaludId = null)
    {
        $this->estadoSaludId = $estadoSaludId;

        return $this;
    }

    /**
     * Get estadoSaludId.
     *
     * @return \AppBundle\Entity\EstadoDeSalud|null
     */
    public function getEstadoSaludId()
    {
        return $this->estadoSaludId;
    }
}
