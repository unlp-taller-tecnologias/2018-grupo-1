<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VinculoSignificativo
 *
 * @ORM\Table(name="vinculo_significativo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VinculoSignificativoRepository")
 */
class VinculoSignificativo
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
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=25, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telefono", type="string", length=15, nullable=true)
     */
    private $telefono;

    /**
     * @var \Date|null
     *
     * @ORM\Column(name="fechaNac", type="date", nullable=true)
     */
    private $fechaNac;

    /**
     * @var string|null
     *
     * @ORM\Column(name="parentesco", type="string", length=30, nullable=true)
     */
    private $parentesco;

    /**
     * @var int|null
     *
     * @ORM\Column(name="dni", type="integer", nullable=true)
     */
    private $dni;

    /**
     * @var int|null
     *
     * @ORM\Column(name="edad", type="integer", nullable=true)
     */
    private $edad;


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
     * @param string|null $nombre
     *
     * @return VinculoSignificativo
     */
    public function setNombre($nombre = null)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre.
     *
     * @return string|null
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set telefono.
     *
     * @param string|null $telefono
     *
     * @return VinculoSignificativo
     */
    public function setTelefono($telefono = null)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono.
     *
     * @return string|null
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set fechaNac.
     *
     * @param \Date|null $fechaNac
     *
     * @return VinculoSignificativo
     */
    public function setFechaNac($fechaNac = null)
    {
        $this->fechaNac = $fechaNac;

        return $this;
    }

    /**
     * Get fechaNac.
     *
     * @return \Date|null
     */
    public function getFechaNac()
    {
        return $this->fechaNac;
    }

    /**
     * Set parentesco.
     *
     * @param string|null $parentesco
     *
     * @return VinculoSignificativo
     */
    public function setParentesco($parentesco = null)
    {
        $this->parentesco = $parentesco;

        return $this;
    }

    /**
     * Get parentesco.
     *
     * @return string|null
     */
    public function getParentesco()
    {
        return $this->parentesco;
    }

    /**
     * Set dni.
     *
     * @param int|null $dni
     *
     * @return VinculoSignificativo
     */
    public function setDni($dni = null)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni.
     *
     * @return int|null
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set edad.
     *
     * @param int|null $edad
     *
     * @return VinculoSignificativo
     */
    public function setEdad($edad = null)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad.
     *
     * @return int|null
     */
    public function getEdad()
    {
        return $this->edad;
    }
}
