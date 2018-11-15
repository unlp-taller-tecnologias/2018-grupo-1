<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Provincia
 *
 * @ORM\Table(name="provincia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProvinciaRepository")
 */
class Provincia
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="Nacion")
     * @ORM\JoinColumn(name="nacion_id", referencedColumnName="id")
     */
    protected $nacion;

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
     * Set nombre.
     *
     * @param string $nombre
     *
     * @return Provincia
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

    /**
     * Set nacion.
     *
     * @param \AppBundle\Entity\Nacion|null $nacion
     *
     * @return Provincia
     */
    public function setNacion(\AppBundle\Entity\Nacion $nacion = null)
    {
        $this->nacion = $nacion;

        return $this;
    }

    /**
     * Get nacion.
     *
     * @return \AppBundle\Entity\Nacion|null
     */
    public function getNacion()
    {
        return $this->nacion;
    }
}
