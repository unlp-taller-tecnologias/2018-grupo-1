<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * IntervencionRealizada
 *
 * @ORM\Table(name="intervencion_realizada")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IntervencionRealizadaRepository")
 * @UniqueEntity("descripcion", message="Ya existe una intervencion realizada con esa descripcion")
 */
class IntervencionRealizada
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
     * @ORM\Column(name="descripcion", type="string", length=70, unique=true)
     */
    private $descripcion;

    /**
     * Muchas Intervenciones Realizadas tienen muchos Expedientes.
     * @ORM\ManyToMany(targetEntity="Expediente", inversedBy="intervencionesRealizadas", cascade={"persist"})
     * @ORM\JoinTable(name="intervencionRealizada_expediente")
     */
    private $expedientes;

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;


    /**
     * Set activo.
     *
     * @param bool $activo
     *
     * @return IntervencionRealizada
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

    public function __construct() {
        $this->expedientes = new ArrayCollection();
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
     * @return IntervencionRealizada
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
     * Add expediente.
     *
     * @param \AppBundle\Entity\Expediente $expediente
     *
     * @return IntervencionRealizada
     */
    public function addExpediente(\AppBundle\Entity\Expediente $expediente)
    {
        $this->expedientes[] = $expediente;

        return $this;
    }

    /**
     * Remove expediente.
     *
     * @param \AppBundle\Entity\Expediente $expediente
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeExpediente(\AppBundle\Entity\Expediente $expediente)
    {
        return $this->expedientes->removeElement($expediente);
    }

    /**
     * Get expedientes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExpedientes()
    {
        return $this->expedientes;
    }
}
