<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expediente
 *
 * @ORM\Table(name="expediente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExpedienteRepository")
 */
class Expediente
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
     * @var int
     *
     * @ORM\Column(name="nroExp", type="integer", unique=true)
     */
    private $nroExp;

    /**
     * @var \Date
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var string|null
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
     * Set nroExp.
     *
     * @param int $nroExp
     *
     * @return Expediente
     */
    public function setNroExp($nroExp)
    {
        $this->nroExp = $nroExp;

        return $this;
    }

    /**
     * Get nroExp.
     *
     * @return int
     */
    public function getNroExp()
    {
        return $this->nroExp;
    }

    /**
     * Set fecha.
     *
     * @param \Date $fecha
     *
     * @return Expediente
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha.
     *
     * @return \Date
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set observacion.
     *
     * @param string|null $observacion
     *
     * @return Expediente
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
}
