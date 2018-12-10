<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpedienteRedes
 *
 * @ORM\Table(name="expediente_redes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExpedienteRedesRepository")
 */
class ExpedienteRedes
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
     * @ORM\ManyToOne(targetEntity="Expediente", inversedBy="expedienteRedes")     
     * @ORM\JoinColumn(name="expediente_id", referencedColumnName="id")
     */
    private $expedienteId;

    /**
     * @ORM\ManyToOne(targetEntity="Redes", inversedBy="expedienteRedes")     
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
     * @return ExpedienteRedes
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
     * @return ExpedienteRedes
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
     * Set redesId.
     *
     * @param \AppBundle\Entity\Redes|null $redesId
     *
     * @return ExpedienteRedes
     */
    public function setRedesId(\AppBundle\Entity\Redes $redesId = null)
    {
        $this->redesId = $redesId;

        return $this;
    }

    /**
     * Get redesId.
     *
     * @return \AppBundle\Entity\Redes|null
     */
    public function getRedesId()
    {
        return $this->redesId;
    }
}
