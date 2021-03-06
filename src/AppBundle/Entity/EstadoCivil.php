<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * EstadoCivil
 *
 * @ORM\Table(name="estado_civil")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EstadoCivilRepository")
 * @UniqueEntity("descripcion", message="Ya existe un estado civil con esa descripcion")
 */
class EstadoCivil
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
     * @ORM\Column(name="descripcion", type="string", length=20, unique=true)
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
     * @ORM\OneToMany(targetEntity="Victima", mappedBy="estadoCivil")
     */
    protected $victimas;

    public function __construct()
    {
        $this->victimas = new ArrayCollection();
    }


    /**
     * Set activo.
     *
     * @param bool $activo
     *
     * @return EstadoCivil
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
     * @return EstadoCivil
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
     * Add victima.
     *
     * @param \AppBundle\Entity\Victima $victima
     *
     * @return EstadoCivil
     */
    public function addVictima(\AppBundle\Entity\Victima $victima)
    {
        $this->victimas[] = $victima;

        return $this;
    }

    /**
     * Remove victima.
     *
     * @param \AppBundle\Entity\Victima $victima
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeVictima(\AppBundle\Entity\Victima $victima)
    {
        return $this->victimas->removeElement($victima);
    }

    /**
     * Get victimas.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVictimas()
    {
        return $this->victimas;
    }
}
