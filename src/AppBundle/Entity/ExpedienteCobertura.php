<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpedienteCobertura
 *
 * @ORM\Table(name="expediente_cobertura")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExpedienteCoberturaRepository")
 */
class ExpedienteCobertura
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
     * @ORM\ManyToOne(targetEntity="Expediente", inversedBy="expedienteCobertura")
     * @ORM\JoinColumn(name="expediente_id", referencedColumnName="id")
     */
    private $expedienteId;

    /**
     * @ORM\ManyToOne(targetEntity="CoberturaSalud", inversedBy="expedienteCobertura")
     * @ORM\JoinColumn(name="cobertura_id", referencedColumnName="id")
     */
    private $coberturaId;

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
     * @return ExpedienteCobertura
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
     * @return ExpedienteCobertura
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
     * Set coberturaId.
     *
     * @param \AppBundle\Entity\CoberturaSalud|null $coberturaId
     *
     * @return ExpedienteCobertura
     */
    public function setCoberturaId(\AppBundle\Entity\CoberturaSalud $coberturaId = null)
    {
        $this->coberturaId = $coberturaId;
        $coberturaId->addExpedienteCobertura($this);
        return $this;
    }

    /**
     * Get coberturaId.
     *
     * @return \AppBundle\Entity\CoberturaSalud|null
     */
    public function getCoberturaId()
    {
        return $this->coberturaId;
    }
}
