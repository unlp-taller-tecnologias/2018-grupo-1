<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 */
class Usuario
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
     * @ORM\Column(name="nombre", type="string", length=25)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=25)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column(name="dni", type="integer", unique=true)
     */
    private $dni;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="esAdmin", type="boolean", nullable=false)
     */
    private $esAdmin;

    // ...

    /**
     * @ORM\ManyToOne(targetEntity="Profesion", inversedBy="usuarios")
     * @ORM\JoinColumn(name="profesion_id", referencedColumnName="id")
     */
    protected $profesion;

    /**
     * Muchos Usuarios tienen muchos Expedientes.
     * @ManyToMany(targetEntity="Expediente", inversedBy="usuarios")
     * @JoinTable(name="usuario_expediente")
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
     * Set nombre.
     *
     * @param string $nombre
     *
     * @return Usuario
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
     * Set apellido.
     *
     * @param string $apellido
     *
     * @return Usuario
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido.
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set dni.
     *
     * @param int $dni
     *
     * @return Usuario
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni.
     *
     * @return int
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set profesion.
     *
     * @param \AppBundle\Entity\Profesion|null $profesion
     *
     * @return Usuario
     */
    public function setProfesion(\AppBundle\Entity\Profesion $profesion = null)
    {
        $this->profesion = $profesion;

        return $this;
    }

    /**
     * Get profesion.
     *
     * @return \AppBundle\Entity\Profesion|null
     */
    public function getProfesion()
    {
        return $this->profesion;
    }
}
