<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * Redes
 *
 * @ORM\Table(name="redes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RedesRepository")
 * @UniqueEntity("descripcion", message="Ya existe una red con esa descripcion")
 */
class Redes
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
     * @ORM\Column(name="descripcion", type="string", length=45, unique=true)
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
     * @ORM\OneToMany(targetEntity="ExpedienteRedes", mappedBy="redesId")
     */
    protected $expedienteRedes;

    public function __construct() {
        $this->expedienteRedes = new ArrayCollection();
    }

    /**
     * Set activo.
     *
     * @param bool $activo
     *
     * @return Redes
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
     * @return Redes
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
     * @return Redes
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
     * Add expedienteRede.
     *
     * @param \AppBundle\Entity\ExpedienteRedes $expedienteRede
     *
     * @return Redes
     */
    public function addExpedienteRede(\AppBundle\Entity\ExpedienteRedes $expedienteRede)
    {
        $this->expedienteRedes[] = $expedienteRede;

        return $this;
    }

    /**
     * Remove expedienteRede.
     *
     * @param \AppBundle\Entity\ExpedienteRedes $expedienteRede
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeExpedienteRede(\AppBundle\Entity\ExpedienteRedes $expedienteRede)
    {
        return $this->expedienteRedes->removeElement($expedienteRede);
    }

    /**
     * Get expedienteRedes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExpedienteRedes()
    {
        return $this->expedienteRedes;
    }
}
