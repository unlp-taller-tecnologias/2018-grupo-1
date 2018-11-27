<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * TipoDocumento
 *
 * @ORM\Table(name="tipo_documento")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TipoDocumentoRepository")
 * @UniqueEntity("descripcion", message="Ya existe un tipo de documento con esa descripcion")
 */
class TipoDocumento
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
     */
    private $descripcion;

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;


    /**
     * @ORM\OneToMany(targetEntity="Victima", mappedBy="tipoDocumento")
     */
    private $victimas;

    public function __construct() {
        $this->victimas = new ArrayCollection();
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
     * @return TipoDocumento
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
     * Set activo.
     *
     * @param bool $activo
     *
     * @return TipoDocumento
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
     * Add victima.
     *
     * @param \AppBundle\Entity\Victima $victima
     *
     * @return TipoDocumento
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
