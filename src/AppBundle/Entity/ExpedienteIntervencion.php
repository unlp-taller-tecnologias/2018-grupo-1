<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpedienteIntervencion
 *
 * @ORM\Table(name="intervencionRealizada_expediente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExpedienteIntervencionRepository")
 */
class ExpedienteIntervencion
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
     * @ORM\ManyToOne(targetEntity="Expediente", inversedBy="intervencionesRealizadas")     
     * @ORM\JoinColumn(name="expediente_id", referencedColumnName="id")
     */
    private $expedienteId;

    /**
     * @ORM\ManyToOne(targetEntity="IntervencionRealizada", inversedBy="expedientes")     
     * @ORM\JoinColumn(name="intervencion_realizada_id", referencedColumnName="id")
     */
    private $intervencionId;

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
     * @return ExpedienteIntervencion
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
     * @return ExpedienteIntervencion
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
     * Set intervencionId.
     *
     * @param \AppBundle\Entity\IntervencionRealizada|null $intervencionId
     *
     * @return ExpedienteIntervencion
     */
    public function setIntervencionId(\AppBundle\Entity\IntervencionRealizada $intervencionId = null)
    {
        $this->intervencionId = $intervencionId;

        return $this;
    }

    /**
     * Get intervencionId.
     *
     * @return \AppBundle\Entity\IntervencionRealizada|null
     */
    public function getIntervencionId()
    {
        return $this->intervencionId;
    }
}
