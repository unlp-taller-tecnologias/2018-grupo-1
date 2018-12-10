<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seguimiento
 *
 * @ORM\Table(name="seguimiento")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SeguimientoRepository")
 */
class Seguimiento
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
     * @var \Date
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;

    
    /**
     * @var string
     *
     * @ORM\Column(name="texto", type="text")
     */
    private $texto;

    /**
     * @ORM\ManyToOne(targetEntity="Expediente", inversedBy="seguimientos")
     * @ORM\JoinColumn(name="expediente_id", referencedColumnName="id")
     */
    protected $expediente;

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
     * Set fecha.
     *
     * @param \Date $fecha
     *
     * @return Seguimiento
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha.
     *
     * @return \Date
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set texto.
     *
     * @param string $texto
     *
     * @return Seguimiento
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto.
     *
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set expediente.
     *
     * @param \AppBundle\Entity\Expediente|null $expediente
     *
     * @return Seguimiento
     */
    public function setExpediente(\AppBundle\Entity\Expediente $expediente = null)
    {
        $this->expediente = $expediente;

        return $this;
    }

    /**
     * Get expediente.
     *
     * @return \AppBundle\Entity\Expediente|null
     */
    public function getExpediente()
    {
        return $this->expediente;
    }

    /**
     * Set nombre.
     *
     * @param string $nombre
     *
     * @return Seguimiento
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}
