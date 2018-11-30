<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * CoberturaSalud
 *
 * @ORM\Table(name="cobertura_salud")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CoberturaSaludRepository")
 * @UniqueEntity("descripcion", message="Ya existe una cobertura de salud con esa descripcion")
 */
class CoberturaSalud
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
     * @ORM\Column(name="descripcion", type="string", length=30, unique=true)
     * @Assert\NotBlank()
     */
    private $descripcion;

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;

    /**
     * @ORM\OneToMany(targetEntity="ExpedienteCobertura", mappedBy="expediente_cobertura")
     */
    protected $expedienteCobertura;

    public function __construct() {
        $this->expedienteCobertura = new ArrayCollection();
    }

    /**
     * Set activo.
     *
     * @param bool $activo
     *
     * @return CoberturaSalud
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
     * @return CoberturaSalud
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
     * Add expedienteCobertura.
     *
     * @param \AppBundle\Entity\ExpedienteCobertura $expedienteCobertura
     *
     * @return CoberturaSalud
     */
    public function addExpedienteCobertura(\AppBundle\Entity\ExpedienteCobertura $expedienteCobertura)
    {
        $this->expedienteCobertura[] = $expedienteCobertura;

        return $this;
    }

    /**
     * Remove expedienteCobertura.
     *
     * @param \AppBundle\Entity\ExpedienteCobertura $expedienteCobertura
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeExpedienteCobertura(\AppBundle\Entity\ExpedienteCobertura $expedienteCobertura)
    {
        return $this->expedienteCobertura->removeElement($expedienteCobertura);
    }

    /**
     * Get expedienteCobertura.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExpedienteCobertura()
    {
        return $this->expedienteCobertura;
    }
}
