<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IntervencionRealizada
 *
 * @ORM\Table(name="intervencion_realizada")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IntervencionRealizadaRepository")
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
     * @ManyToMany(targetEntity="Expediente", inversedBy="intervencionesRealizadas")
     * @JoinTable(name="intervencionRealizada_expediente")
     */
    private $expedientes;
    

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
}
