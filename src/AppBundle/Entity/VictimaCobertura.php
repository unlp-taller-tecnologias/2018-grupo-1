<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VictimaCobertura
 *
 * @ORM\Table(name="victima_estado_salud")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VictimaCoberturaRepository")
 */
class VictimaCobertura
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Victima")     
     * @ORM\JoinColumn(name="victima_id", referencedColumnName="id")
     */
    private $victimaId;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="CoberturaSalud")     
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
     * Set observacion.
     *
     * @param string|null $observacion
     *
     * @return VictimaCobertura
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
     * @return VictimaCobertura
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
     * Set coberturaId.
     *
     * @param \AppBundle\Entity\CoberturaSalud $coberturaId
     *
     * @return VictimaCobertura
     */
    public function setCoberturaId(\AppBundle\Entity\CoberturaSalud $coberturaId)
    {
        $this->coberturaId = $coberturaId;

        return $this;
    }

    /**
     * Get coberturaId.
     *
     * @return \AppBundle\Entity\CoberturaSalud
     */
    public function getCoberturaId()
    {
        return $this->coberturaId;
    }
}
