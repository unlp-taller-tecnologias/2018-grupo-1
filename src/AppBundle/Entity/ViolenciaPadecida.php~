<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ViolenciaPadecida
 *
 * @ORM\Table(name="violencia_padecida")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ViolenciaPadecidaRepository")
 * @UniqueEntity("descripcion", message="Ya existe una violencia padecida con esa descripcion")
 */
class ViolenciaPadecida
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
     * @ORM\Column(name="descripcion", type="string", length=60, unique=true)
     */
    private $descripcion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="orden", type="smallint", nullable=true)
     * @Assert\NotBlank
     * @Assert\LessThan(100)
     * @Assert\GreaterThan(0)
     */
    private $orden;

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;


    /**
     * @ORM\ManyToMany(targetEntity="EvaluacionRiesgo", mappedBy="violenciasPadecidas")
     */
    private $evaluacionesDeRiesgo;

    public function __construct() {
        $this->evaluacionesDeRiesgo = new ArrayCollection();
    }

    /**
     * Set activo.
     *
     * @param bool $activo
     *
     * @return ViolenciaPadecida
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
     * @return ViolenciaPadecida
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
     * @return ViolenciaPadecida
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
     * Add evaluacionesDeRiesgo.
     *
     * @param \AppBundle\Entity\EvaluacionRiesgo $evaluacionesDeRiesgo
     *
     * @return ViolenciaPadecida
     */
    public function addEvaluacionesDeRiesgo(\AppBundle\Entity\EvaluacionRiesgo $evaluacionesDeRiesgo)
    {
        $this->evaluacionesDeRiesgo[] = $evaluacionesDeRiesgo;

        return $this;
    }

    /**
     * Remove evaluacionesDeRiesgo.
     *
     * @param \AppBundle\Entity\EvaluacionRiesgo $evaluacionesDeRiesgo
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeEvaluacionesDeRiesgo(\AppBundle\Entity\EvaluacionRiesgo $evaluacionesDeRiesgo)
    {
        return $this->evaluacionesDeRiesgo->removeElement($evaluacionesDeRiesgo);
    }

    /**
     * Get evaluacionesDeRiesgo.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluacionesDeRiesgo()
    {
        return $this->evaluacionesDeRiesgo;
    }
}
