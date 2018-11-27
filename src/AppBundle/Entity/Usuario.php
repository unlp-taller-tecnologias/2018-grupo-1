<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 */
class Usuario extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
      * @var string
      *
      * @ORM\Column(name="nombre", type="string", length=25, nullable=false)
      *
      * @Assert\NotBlank(message="Ingrese su nombre", groups={"Registration", "Profile"})
      * @Assert\Length(
      *     min=3,
      *     max=25,
      *     minMessage="El nombre es demasiado corto.",
      *     maxMessage="El nombre es demasiado largo.",
      *     groups={"Registration", "Profile"}
      * )
      */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=25, nullable=false)
     *
     * @Assert\NotBlank(message="Ingrese su apellido", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=25,
     *     minMessage="El apellido es demasiado corto.",
     *     maxMessage="El apellido es demasiado largo.",
     *     groups={"Registration", "Profile"}
     * )
     */
    private $apellido;

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
     * @ORM\ManyToMany(targetEntity="Expediente", inversedBy="usuarios", cascade={"persist"})
     * @ORM\JoinTable(name="usuario_expediente")
     */
    private $expedientes;

    public function __construct() {
        parent::__construct();
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
     * Set esAdmin.
     *
     * @param bool $esAdmin
     *
     * @return Usuario
     */
    public function setEsAdmin($esAdmin)
    {
        $this->esAdmin = $esAdmin;
        if($esAdmin){
          $this->addRole("ROLE_ADMIN");
        }
        return $this;
    }

    /**
     * Get esAdmin.
     *
     * @return bool
     */
    public function getEsAdmin()
    {
        return $this->esAdmin;
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

    /**
     * Add expediente.
     *
     * @param \AppBundle\Entity\Expediente $expediente
     *
     * @return Usuario
     */
    public function addExpediente(\AppBundle\Entity\Expediente $expediente)
    {
        $this->expedientes[] = $expediente;

        return $this;
    }

    /**
     * Remove expediente.
     *
     * @param \AppBundle\Entity\Expediente $expediente
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeExpediente(\AppBundle\Entity\Expediente $expediente)
    {
        return $this->expedientes->removeElement($expediente);
    }

    /**
     * Get expedientes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExpedientes()
    {
        return $this->expedientes;
    }

    public function setUsername($username)
    {
        $username = is_null($username) ? '' : $username;
        parent::setUsername($username);
        $this->setEmail($username.'@mail.com');

        return $this;
    }
}
