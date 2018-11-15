<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * NivelCorruptibilidad
 *
 * @ORM\Table(name="nivel_corruptibilidad")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NivelCorruptibilidadRepository")
 */
class NivelCorruptibilidad
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
     * @ORM\Column(name="descripcion", type="string", length=80, unique=true)
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
     * Un nivel de corruptibilidad tiene muchos niveles de corruptibilidad.
     * @ORM\OneToMany(targetEntity="NivelCorruptibilidad", mappedBy="padre")
     */
    private $hijos;

    /**
     * Muchos niveles de corruptibilidad tienen como padre un nivel de corruptibilidad
     * @ORM\ManyToOne(targetEntity="NivelCorruptibilidad", inversedBy="hijos")
     * @ORM\JoinColumn(name="padre_id", referencedColumnName="id")
     */
    private $padre;
    // ...

    public function __construct() {
        $this->hijos = new ArrayCollection();
    }

    /**
     * Set activo.
     *
     * @param bool $activo
     *
     * @return NivelCorruptibilidad
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
     * @return NivelCorruptibilidad
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
     * @param int $orden
     *
     * @return NivelCorruptibilidad
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden.
     *
     * @return int
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Add hijo.
     *
     * @param \AppBundle\Entity\NivelCorruptibilidad $hijo
     *
     * @return NivelCorruptibilidad
     */
    public function addHijo(\AppBundle\Entity\NivelCorruptibilidad $hijo)
    {
        $this->hijos[] = $hijo;

        return $this;
    }

    /**
     * Remove hijo.
     *
     * @param \AppBundle\Entity\NivelCorruptibilidad $hijo
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeHijo(\AppBundle\Entity\NivelCorruptibilidad $hijo)
    {
        return $this->hijos->removeElement($hijo);
    }

    /**
     * Get hijos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHijos()
    {
        return $this->hijos;
    }

    /**
     * Set padre.
     *
     * @param \AppBundle\Entity\NivelCorruptibilidad|null $padre
     *
     * @return NivelCorruptibilidad
     */
    public function setPadre(\AppBundle\Entity\NivelCorruptibilidad $padre = null)
    {
        $this->padre = $padre;

        return $this;
    }

    /**
     * Get padre.
     *
     * @return \AppBundle\Entity\NivelCorruptibilidad|null
     */
    public function getPadre()
    {
        return $this->padre;
    }
}
