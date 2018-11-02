<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Expediente;

/**
 * Victima
 *
 * @ORM\Table(name="victima")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VictimaRepository")
 */
class Victima
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
     * @ORM\Column(name="nombre", type="string", length=30)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=30)
     */
    private $apellido;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=25, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="nroDocumento", type="string", length=20, nullable=true)
     */
    private $nroDocumento;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaNac", type="date", nullable=true)
     */
    private $fechaNac;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="poseeDineroPropio", type="boolean", nullable=true)
     */
    private $poseeDineroPropio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="obserDineroPropio", type="string", length=255, nullable=true)
     */
    private $obserDineroPropio;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="poseePlanSocial", type="boolean", nullable=true)
     */
    private $poseePlanSocial;

    /**
     * @var string|null
     *
     * @ORM\Column(name="obserPlanSocial", type="string", length=255, nullable=true)
     */
    private $obserPlanSocial;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="poseeViviendaPropia", type="boolean", nullable=true)
     */
    private $poseeViviendaPropia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="obserViviendaPropia", type="string", length=255, nullable=true)
     */
    private $obserViviendaPropia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calle", type="string", length=30, nullable=true)
     */
    private $calle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="piso", type="string", length=20, nullable=true)
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
     * @ORM\Column(name="numero", type="string", length=15, nullable=true)
     */
    private $numero;

    /**
     * @var string|null
     *
     * @ORM\Column(name="otros", type="string", length=30, nullable=true)
     */
    private $otros;

    /**
     * Una Victima tiene Un Expediente.
     * @ORM\OneToOne(targetEntity="Expediente", mappedBy="victima")
     */
    private $expediente;

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
     * @return Victima
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
     * @return Victima
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
     * Set email.
     *
     * @param string|null $email
     *
     * @return Victima
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set nroDocumento.
     *
     * @param string $nroDocumento
     *
     * @return Victima
     */
    public function setNroDocumento($nroDocumento)
    {
        $this->nroDocumento = $nroDocumento;

        return $this;
    }

    /**
     * Get nroDocumento.
     *
     * @return string
     */
    public function getNroDocumento()
    {
        return $this->nroDocumento;
    }

    /**
     * Set fechaNac.
     *
     * @param \DateTime|null $fechaNac
     *
     * @return Victima
     */
    public function setFechaNac($fechaNac = null)
    {
        $this->fechaNac = $fechaNac;

        return $this;
    }

    /**
     * Get fechaNac.
     *
     * @return \DateTime|null
     */
    public function getFechaNac()
    {
        return $this->fechaNac;
    }

    /**
     * Set poseeDineroPropio.
     *
     * @param bool|null $poseeDineroPropio
     *
     * @return Victima
     */
    public function setPoseeDineroPropio($poseeDineroPropio = null)
    {
        $this->poseeDineroPropio = $poseeDineroPropio;

        return $this;
    }

    /**
     * Get poseeDineroPropio.
     *
     * @return bool|null
     */
    public function getPoseeDineroPropio()
    {
        return $this->poseeDineroPropio;
    }

    /**
     * Set obserDineroPropio.
     *
     * @param string|null $obserDineroPropio
     *
     * @return Victima
     */
    public function setObserDineroPropio($obserDineroPropio = null)
    {
        $this->obserDineroPropio = $obserDineroPropio;

        return $this;
    }

    /**
     * Get obserDineroPropio.
     *
     * @return string|null
     */
    public function getObserDineroPropio()
    {
        return $this->obserDineroPropio;
    }

    /**
     * Set poseePlanSocial.
     *
     * @param bool|null $poseePlanSocial
     *
     * @return Victima
     */
    public function setPoseePlanSocial($poseePlanSocial = null)
    {
        $this->poseePlanSocial = $poseePlanSocial;

        return $this;
    }

    /**
     * Get poseePlanSocial.
     *
     * @return bool|null
     */
    public function getPoseePlanSocial()
    {
        return $this->poseePlanSocial;
    }

    /**
     * Set obserPlanSocial.
     *
     * @param string|null $obserPlanSocial
     *
     * @return Victima
     */
    public function setObserPlanSocial($obserPlanSocial = null)
    {
        $this->obserPlanSocial = $obserPlanSocial;

        return $this;
    }

    /**
     * Get obserPlanSocial.
     *
     * @return string|null
     */
    public function getObserPlanSocial()
    {
        return $this->obserPlanSocial;
    }

    /**
     * Set poseeViviendaPropia.
     *
     * @param bool|null $poseeViviendaPropia
     *
     * @return Victima
     */
    public function setPoseeViviendaPropia($poseeViviendaPropia = null)
    {
        $this->poseeViviendaPropia = $poseeViviendaPropia;

        return $this;
    }

    /**
     * Get poseeViviendaPropia.
     *
     * @return bool|null
     */
    public function getPoseeViviendaPropia()
    {
        return $this->poseeViviendaPropia;
    }

    /**
     * Set obserViviendaPropia.
     *
     * @param string|null $obserViviendaPropia
     *
     * @return Victima
     */
    public function setObserViviendaPropia($obserViviendaPropia = null)
    {
        $this->obserViviendaPropia = $obserViviendaPropia;

        return $this;
    }

    /**
     * Get obserViviendaPropia.
     *
     * @return string|null
     */
    public function getObserViviendaPropia()
    {
        return $this->obserViviendaPropia;
    }

    /**
     * Set calle.
     *
     * @param string|null $calle
     *
     * @return Victima
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
     * Set piso.
     *
     * @param string|null $piso
     *
     * @return Victima
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
     * @return Victima
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
     * Set numero.
     *
     * @param string|null $numero
     *
     * @return Victima
     */
    public function setNumero($numero = null)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero.
     *
     * @return string|null
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set otros.
     *
     * @param string|null $otros
     *
     * @return Victima
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
}
