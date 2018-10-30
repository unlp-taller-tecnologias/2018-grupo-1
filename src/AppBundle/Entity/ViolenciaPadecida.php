<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ViolenciaPadecida
 *
 * @ORM\Table(name="violencia_padecida")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ViolenciaPadecidaRepository")
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
     * @ORM\Column(name="orden", type="integer", nullable=true)
     */
    private $orden;


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
}
