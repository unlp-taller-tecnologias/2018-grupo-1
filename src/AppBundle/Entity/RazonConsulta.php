<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * RazonConsulta
 *
 * @ORM\Table(name="razon_consulta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RazonConsultaRepository")
 * @UniqueEntity("descripcion", message="Ya existe una razón de consulta con esa descripcion")
 */
class RazonConsulta
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
     * @ORM\Column(name="descripcion", type="string", length=25, unique=true)
     */
    private $descripcion;

    /**
     * One RazonConsulta has Many Expedientes.
     * @ORM\OneToMany(targetEntity="Expediente", mappedBy="razonConsulta")
     */
    private $expedientes;

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;

    public function __construct() {
        $this->expedientes = new ArrayCollection();
    }

    /**
     * Set activo.
     *
     * @param bool $activo
     *
     * @return RazonConsulta
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
     * @return RazonConsulta
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
     * @return RazonConsulta
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
