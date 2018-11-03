<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriaRepository")
 */
class Categoria
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
     * @return AntecedenteJudicial
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
     * @ORM\OneToMany(targetEntity="Anexo", mappedBy="categoria")
     */
    protected $anexos;

    public function __construct()
    {
        $this->anexos = new ArrayCollection();
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
     * @return Categoria
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
     * Add anexo.
     *
     * @param \AppBundle\Entity\Anexo $anexo
     *
     * @return Categoria
     */
    public function addAnexo(\AppBundle\Entity\Anexo $anexo)
    {
        $this->anexos[] = $anexo;

        return $this;
    }

    /**
     * Remove anexo.
     *
     * @param \AppBundle\Entity\Anexo $anexo
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAnexo(\AppBundle\Entity\Anexo $anexo)
    {
        return $this->anexos->removeElement($anexo);
    }

    /**
     * Get anexos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnexos()
    {
        return $this->anexos;
    }
}
