<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * EstadoDeSalud
 *
 * @ORM\Table(name="estado_de_salud")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EstadoDeSaludRepository")
 * @UniqueEntity("descripcion", message="Ya existe un estado de salud con esa descripcion")
 */
class EstadoDeSalud
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
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=40, unique=true)
     */
    private $descripcion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="orden", type="smallint", nullable=true)
     */
    private $orden;

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;

    /**
     * @ORM\OneToMany(targetEntity="ExpedienteSalud", mappedBy="expediente_estado_salud")
     */
    protected $expedienteSalud;
    
    public function __construct() {
        $this->expedienteSalud = new ArrayCollection();
    }

    /**
     * Set activo.
     *
     * @param bool $activo
     *
     * @return EstadoDeSalud
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo.
     *
     * @return bool
     */
    public function getActivo()
    {
        return $this->activo;
    }

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
     * Set descripcion.
     *
     * @param string $descripcion
     *
     * @return EstadoDeSalud
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion.
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set orden.
     *
     * @param int|null $orden
     *
     * @return EstadoDeSalud
     */
    public function setOrden($orden = null)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden.
     *
     * @return int|null
     */
    public function getOrden()
    {
        return $this->orden;
    }


    /**
     * Add expedienteSalud.
     *
     * @param \AppBundle\Entity\ExpedienteSalud $expedienteSalud
     *
     * @return EstadoDeSalud
     */
    public function add(\AppBundle\Entity\ExpedienteSalud $expedienteSalud)
    {
        $this->expedienteSalud[] = $expedienteSalud;

        return $this;
    }

    /**
     * Remove expedienteSalud.
     *
     * @param \AppBundle\Entity\ExpedienteSalud $expedienteSalud
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeExpedienteSalud(\AppBundle\Entity\ExpedienteSalud $expedienteSalud)
    {
        return $this->expedienteSalud->removeElement($expedienteSalud);
    }

    /**
     * Get expedienteSalud.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExpedienteSalud()
    {
        return $this->expedienteSalud;
    }

    /**
     * Add expedienteSalud.
     *
     * @param \AppBundle\Entity\ExpedienteSalud $expedienteSalud
     *
     * @return EstadoDeSalud
     */
    public function addExpedienteSalud(\AppBundle\Entity\ExpedienteSalud $expedienteSalud)
    {
        $this->expedienteSalud[] = $expedienteSalud;

        return $this;
    }
}
