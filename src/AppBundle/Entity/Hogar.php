<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hogar
 *
 * @ORM\Table(name="hogar")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HogarRepository")
 */
class Hogar
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
     * @ORM\Column(name="ingreso", type="date")
     */
    private $ingreso;

    /**
     * @var \Date|null
     *
     * @ORM\Column(name="egreso", type="date", nullable=true)
     */
    private $egreso;

    /**
     * @ORM\ManyToOne(targetEntity="Expediente", inversedBy="ingresosHogar", cascade={"persist"})
     * @ORM\JoinColumn(name="expediente_id", referencedColumnName="id")
     */
    protected $expediente;

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
     * Set ingreso.
     *
     * @param \Date $ingreso
     *
     * @return Hogar
     */
    public function setIngreso($ingreso)
    {
        $this->ingreso = $ingreso;

        return $this;
    }

    /**
     * Get ingreso.
     *
     * @return \Date
     */
    public function getIngreso()
    {
        return $this->ingreso;
    }

    /**
     * Set egreso.
     *
     * @param \Date|null $egreso
     *
     * @return Hogar
     */
    public function setEgreso($egreso = null)
    {
        $this->egreso = $egreso;

        return $this;
    }

    /**
     * Get egreso.
     *
     * @return \Date|null
     */
    public function getEgreso()
    {
        return $this->egreso;
    }

    /**
     * Set expediente.
     *
     * @param \AppBundle\Entity\Expediente|null $expediente
     *
     * @return Hogar
     */
    public function setExpediente(\AppBundle\Entity\Expediente $expediente = null)
    {
        $this->expediente = $expediente;

        return $this;
    }

    /**
     * Get expediente.
     *
     * @return \AppBundle\Entity\Expediente|null
     */
    public function getExpediente()
    {
        return $this->expediente;
    }
}
