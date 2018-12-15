<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;



/**
 * Agresor
 *
 * @ORM\Table(name="agresor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AgresorRepository")
 */
class Agresor
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
     * @var int|null
     *
     * @ORM\Column(name="edad", type="smallint", nullable=true)
     */
    private $edad;

    /**
     * @var string
     *
     * @ORM\Column(name="nroDocumento", type="string", length=20, nullable=true)
     */
    private $nroDocumento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="condicionLaboral", type="string", length=255, nullable=true)
     */
    private $condicionLaboral;

    /**
     * @var \Date|null
     *
     * @ORM\Column(name="fechaNac", type="date", nullable=true)
     */
    private $fechaNac;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calle", type="string", length=30, nullable=true)
     */
    private $calle;

    /**
     * @var int|null
     *
     * @ORM\Column(name="numero", type="smallint", nullable=true)
     */
    private $numero;

    /**
     * @var string|null
     *
     * @ORM\Column(name="piso", type="string", length=10, nullable=true)
     */
    private $piso;

    /**
     * @var string|null
     *
     * @ORM\Column(name="depto", type="string", length=10, nullable=true)
     */
    private $depto;

    /**
     * @var string|null
     *
     * @ORM\Column(name="otros", type="string", length=20, nullable=true)
     */
    private $otros;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=25)
     * @Assert\NotNull(message="Se debe ingresar el apellido del agresor")
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=25)
     * @Assert\NotNull(message="Se debe ingresar el nombre del agresor")
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nacion", type="string", length=2, nullable=true)
     */
    protected $nacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="localidad", type="string", nullable=true)
     */
    protected $localidad;

    /**
     * @var string|null
     *
     * @ORM\Column(name="provincia", type="string", nullable=true)
     */
    protected $provincia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="partido", type="string", nullable=true)
     */
    protected $partido;

    /**
     * @var string|null
     *
     * @ORM\Column(name="barrio", type="string", length=30, nullable=true)
     */
    protected $barrio;


    /**
     * @ORM\OneToMany(targetEntity="AgresorCorruptibilidad", mappedBy="agresorId")
     */
    protected $agresorCorruptibilidad;

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
     * Set edad.
     *
     * @param int|null $edad
     *
     * @return Agresor
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

    /**
     * Set condicionLaboral.
     *
     * @param string|null $condicionLaboral
     *
     * @return Agresor
     */
    public function setCondicionLaboral($condicionLaboral = null)
    {
        $this->condicionLaboral = $condicionLaboral;

        return $this;
    }

    /**
     * Get condicionLaboral.
     *
     * @return string|null
     */
    public function getCondicionLaboral()
    {
        return $this->condicionLaboral;
    }

    /**
     * Set fechaNac.
     *
     * @param \Date|null $fechaNac
     *
     * @return Agresor
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
     * Set calle.
     *
     * @param string|null $calle
     *
     * @return Agresor
     */
    public function setCalle($calle = null)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get calle.
     *
     * @return string|null
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set numero.
     *
     * @param int|null $numero
     *
     * @return Agresor
     */
    public function setNumero($numero = null)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero.
     *
     * @return int|null
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set piso.
     *
     * @param string|null $piso
     *
     * @return Agresor
     */
    public function setPiso($piso = null)
    {
        $this->piso = $piso;

        return $this;
    }

    /**
     * Get piso.
     *
     * @return string|null
     */
    public function getPiso()
    {
        return $this->piso;
    }

    /**
     * Set depto.
     *
     * @param string|null $depto
     *
     * @return Agresor
     */
    public function setDepto($depto = null)
    {
        $this->depto = $depto;

        return $this;
    }

    /**
     * Get depto.
     *
     * @return string|null
     */
    public function getDepto()
    {
        return $this->depto;
    }

    /**
     * Set otros.
     *
     * @param string|null $otros
     *
     * @return Agresor
     */
    public function setOtros($otros = null)
    {
        $this->otros = $otros;

        return $this;
    }

    /**
     * Get otros.
     *
     * @return string|null
     */
    public function getOtros()
    {
        return $this->otros;
    }

    /**
     * Set apellido.
     *
     * @param string $apellido
     *
     * @return Agresor
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
     * Set nombre.
     *
     * @param string $nombre
     *
     * @return Agresor
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
     * Set nroDocumento.
     *
     * @param string|null $nroDocumento
     *
     * @return Agresor
     */
    public function setNroDocumento($nroDocumento = null)
    {
        $this->nroDocumento = $nroDocumento;

        return $this;
    }

    /**
     * Get nroDocumento.
     *
     * @return string|null
     */
    public function getNroDocumento()
    {
        return $this->nroDocumento;
    }

    /**
     * Set nacion.
     *
     * @return Agresor
     */
    public function setNacion($nacion = null)
    {
        $this->nacion = $nacion;

        return $this;
    }

    /**
     * Get nacion.
     *
     * @return string|null
     */
    public function getNacion()
    {
        return $this->nacion;
    }

    /**
     * Set localidad.
     *
     * @param string|null $localidad
     *
     * @return Agresor
     */
    public function setLocalidad($localidad = null)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad.
     *
     * @return string|null
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set barrio.
     *
     * @param string|null $barrio
     *
     * @return Agresor
     */
    public function setBarrio($barrio = null)
    {
        $this->barrio = $barrio;

        return $this;
    }

    /**
     * Get barrio.
     *
     * @return string|null
     */
    public function getBarrio()
    {
        return $this->barrio;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->agresorCorruptibilidad = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add agresorCorruptibilidad.
     *
     * @param \AppBundle\Entity\AgresorCorruptibilidad $agresorCorruptibilidad
     *
     * @return Agresor
     */
    public function addAgresorCorruptibilidad(\AppBundle\Entity\AgresorCorruptibilidad $agresorCorruptibilidad)
    {
        $this->agresorCorruptibilidad[] = $agresorCorruptibilidad;

        return $this;
    }

    /**
     * Remove agresorCorruptibilidad.
     *
     * @param \AppBundle\Entity\AgresorCorruptibilidad $agresorCorruptibilidad
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAgresorCorruptibilidad(\AppBundle\Entity\AgresorCorruptibilidad $agresorCorruptibilidad)
    {
        return $this->agresorCorruptibilidad->removeElement($agresorCorruptibilidad);
    }

    /**
     * Get agresorCorruptibilidad.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAgresorCorruptibilidad()
    {
        return $this->agresorCorruptibilidad;
    }

    /**
     * Set provincia.
     *
     * @param string|null $provincia
     *
     * @return Agresor
     */
    public function setProvincia($provincia = null)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia.
     *
     * @return string|null
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set partido.
     *
     * @param string|null $partido
     *
     * @return Agresor
     */
    public function setPartido($partido = null)
    {
        $this->partido = $partido;

        return $this;
    }

    /**
     * Get partido.
     *
     * @return string|null
     */
    public function getPartido()
    {
        return $this->partido;
    }

    public function voidAgresorCorruptibilidad()
    {
        $this->agresorCorruptibilidad= new ArrayCollection();
    }

}
