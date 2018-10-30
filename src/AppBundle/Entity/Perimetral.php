<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Perimetral
 *
 * @ORM\Table(name="perimetral")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PerimetralRepository")
 */
class Perimetral
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
     * @var \Date
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var \Date
     *
     * @ORM\Column(name="vencimiento", type="date")
     */
    private $vencimiento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="vigencia", type="string", length=10, nullable=true)
     */
    private $vigencia;


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
     * Set fecha.
     *
     * @param \Date $fecha
     *
     * @return Perimetral
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
     * Set vencimiento.
     *
     * @param \Date $vencimiento
     *
     * @return Perimetral
     */
    public function setVencimiento($vencimiento)
    {
        $this->vencimiento = $vencimiento;

        return $this;
    }

    /**
     * Get vencimiento.
     *
     * @return \Date
     */
    public function getVencimiento()
    {
        return $this->vencimiento;
    }

    /**
     * Set vigencia.
     *
     * @param string|null $vigencia
     *
     * @return Perimetral
     */
    public function setVigencia($vigencia = null)
    {
        $this->vigencia = $vigencia;

        return $this;
    }

    /**
     * Get vigencia.
     *
     * @return string|null
     */
    public function getVigencia()
    {
        return $this->vigencia;
    }
}
