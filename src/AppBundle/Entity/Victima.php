<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @Assert\NotNull(message="Se debe ingresar el nombre de la víctima")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=30)
     * @Assert\NotNull(message="Se debe ingresar el apellido de la víctima")
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
     * @ORM\OneToOne(targetEntity="Expediente", mappedBy="victima")
     */
    private $expediente;

    /**
     * @ORM\ManyToOne(targetEntity="TipoDocumento", inversedBy="victimas")
     * @ORM\JoinColumn(name="tipoDocumento_id", referencedColumnName="id")
     */
    protected $tipoDocumento;

    /**
     * @ORM\ManyToMany(targetEntity="Telefono", inversedBy="victimas", cascade={"persist"})
     * @ORM\JoinTable(name="victima_telefono")
     */
    private $telefonos; //, inversedBy="victimas", cascade={"persist"}

    /**
     * @ORM\ManyToOne(targetEntity="Telefono", cascade={"persist"})
     * @ORM\JoinColumn(name="tel_seguro_id", referencedColumnName="id")
     */
    protected $telefonoSeguro;

    /**
     * @ORM\ManyToOne(targetEntity="EstadoCivil", inversedBy="victimas")
     * @ORM\JoinColumn(name="estadoCivil_id", referencedColumnName="id")
     */
    protected $estadoCivil;

    /**
     * @ORM\OneToMany(targetEntity="VinculoSignificativo", mappedBy="victima", cascade={"persist"})
     */
    private $vinculosSignificativos;

    /**
     * @ORM\OneToMany(targetEntity="EvaluacionRiesgo", mappedBy="victima", cascade={"persist"})
     * @Assert\Valid
     */
    protected $evaluacionesDeRiesgo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nacion", type="string", length=2, nullable=true)
     */
    protected $nacion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="localidad", type="string", length=12, nullable=true)
     */
    protected $localidad;

    /**
     * @var string|null
     *
     * @ORM\Column(name="barrio", type="string", length=30, nullable=true)
     */
    protected $barrio;

    public function __construct() {
        $this->telefonos = new ArrayCollection();
        $this->vinculosSignificativos = new ArrayCollection();
        $this->evaluacionesDeRiesgo = new ArrayCollection();
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

    /**
     * Set expediente.
     *
     * @param \AppBundle\Entity\Expediente|null $expediente
     *
     * @return Victima
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
     * Set tipoDocumento.
     *
     * @param \AppBundle\Entity\TipoDocumento|null $tipoDocumento
     *
     * @return Victima
     */
    public function setTipoDocumento(\AppBundle\Entity\TipoDocumento $tipoDocumento = null)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get tipoDocumento.
     *
     * @return \AppBundle\Entity\TipoDocumento|null
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }
/*
    public function setTelefonos($telefono){
        $this->telefonos=$telefono;
    }

    public function setVinculosSignificativos($vinculos){
        $this->vinculosSignificativos=$vinculos;
    }

    public function setEvaluacionesDeRiesgo($evaluacion){
        $this->evaluacionesDeRiesgo=$evaluacion;
    }
*/
    /**
     * Add telefono.
     *
     * @param \AppBundle\Entity\Telefono $telefono
     *
     * @return Victima
     */
    public function addTelefono(\AppBundle\Entity\Telefono $telefono)
    {
        $this->telefonos->add($telefono);
        //$telefono->addVictima($this);

        return $this;
    }

    /**
     * Remove telefono.
     *
     * @param \AppBundle\Entity\Telefono $telefono
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTelefono(\AppBundle\Entity\Telefono $telefono)
    {
        return $this->telefonos->removeElement($telefono);
    }

    /**
     * Get telefonos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * Set estadoCivil.
     *
     * @param \AppBundle\Entity\EstadoCivil|null $estadoCivil
     *
     * @return Victima
     */
    public function setEstadoCivil(\AppBundle\Entity\EstadoCivil $estadoCivil = null)
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    /**
     * Get estadoCivil.
     *
     * @return \AppBundle\Entity\EstadoCivil|null
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * Add vinculosSignificativo.
     *
     * @param \AppBundle\Entity\VinculoSignificativo $vinculosSignificativo
     *
     * @return Victima
     */
    public function addVinculosSignificativo(\AppBundle\Entity\VinculoSignificativo $vinculosSignificativo)
    {
        $this->vinculosSignificativos[] = $vinculosSignificativo;
        $vinculosSignificativo->setVictima($this);
        return $this;
    }

    /**
     * Remove vinculosSignificativo.
     *
     * @param \AppBundle\Entity\VinculoSignificativo $vinculosSignificativo
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeVinculosSignificativo(\AppBundle\Entity\VinculoSignificativo $vinculosSignificativo)
    {
        return $this->vinculosSignificativos->removeElement($vinculosSignificativo);
    }

    /**
     * Get vinculosSignificativos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVinculosSignificativos()
    {
        return $this->vinculosSignificativos;
    }

    /**
     * Add evaluacionesDeRiesgo.
     *
     * @param \AppBundle\Entity\EvaluacionRiesgo $evaluacionesDeRiesgo
     *
     * @return Victima
     */
    public function addEvaluacionesDeRiesgo(\AppBundle\Entity\EvaluacionRiesgo $evaluacionDeRiesgo)
    {
        $this->evaluacionesDeRiesgo[] = $evaluacionDeRiesgo;
        $evaluacionDeRiesgo->setVictima($this);

        return $this;
    }

    /**
     * Remove evaluacionesDeRiesgo.
     *
     * @param \AppBundle\Entity\EvaluacionRiesgo $evaluacionesDeRiesgo
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeEvaluacionesDeRiesgo(\AppBundle\Entity\EvaluacionRiesgo $evaluacionesDeRiesgo)
    {
        return $this->evaluacionesDeRiesgo->removeElement($evaluacionesDeRiesgo);
    }

    /**
     * Get evaluacionesDeRiesgo.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluacionesDeRiesgo()
    {
        return $this->evaluacionesDeRiesgo;
    }

    /**
     * Set telefonoSeguro.
     *
     * @param \AppBundle\Entity\Telefono|null $telefonoSeguro
     *
     * @return Victima
     */
    public function setTelefonoSeguro(\AppBundle\Entity\Telefono $telefonoSeguro = null)
    {
        $this->telefonoSeguro = $telefonoSeguro;

        return $this;
    }

    /**
     * Get telefonoSeguro.
     *
     * @return \AppBundle\Entity\Telefono|null
     */
    public function getTelefonoSeguro()
    {
        return $this->telefonoSeguro;
    }

    /**
     * Set nacion.
     *
     * @return Victima
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
     * @return Victima
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
}
