<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Expediente
 *
 * @ORM\Table(name="expediente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExpedienteRepository")
 */
class Expediente
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
     * @var int
     *
     * @ORM\Column(name="nroExp", type="integer", unique=true)
     */
    private $nroExp;

    /**
     * @var \Date
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observacion", type="string", length=255, nullable=true)
     */
    private $observacion;

    /**
     * Un Expediente tiene Una Victima.
     * @OneToOne(targetEntity="Victima", inversedBy="expediente")
     * @JoinColumn(name="victima_id", referencedColumnName="id")
     */
    private $victima;

    /**
     * @ORM\OneToMany(targetEntity="Anexo", mappedBy="expediente")
     */
    protected $anexos;
    
    /**
     * @ORM\OneToMany(targetEntity="Seguimiento", mappedBy="expediente")
     */
    protected $seguimientos;

    /**
     * @ORM\OneToMany(targetEntity="BotonAntipanico", mappedBy="expediente")
     */
    protected $botones;
    
    /**
     * Un Expediente tiene un Resumen.
     * @OneToOne(targetEntity="Resumen")
     * @JoinColumn(name="resumen_id", referencedColumnName="id")
     */
    private $resumen;

    /**
     * Muchos Expedientes tienen muchos Usuarios.
     * @ManyToMany(targetEntity="Usuario", mappedBy="expedientes")
     */
    private $usuarios;

    /**
     * Muchos Expedientes tienen muchos IntervencionesRealizadas.
     * @ManyToMany(targetEntity="IntervencionRealizada", mappedBy="expedientes")
     */

    private $intervencionesRealizadas;

    /**
     * @ORM\OneToMany(targetEntity="Hogar", mappedBy="expediente")
     */
    protected $ingresosHogar;


    public function __construct() {
        $this->usuarios = new ArrayCollection();
        $this->anexos = new ArrayCollection();
        $this->seguimientos = new ArrayCollection();
        $this->botones = new ArrayCollection();
        $this->intervencionesRealizadas = new ArrayCollection();
        $this->ingresosHogar = new ArrayCollection();
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
     * Set nroExp.
     *
     * @param int $nroExp
     *
     * @return Expediente
     */
    public function setNroExp($nroExp)
    {
        $this->nroExp = $nroExp;

        return $this;
    }

    /**
     * Get nroExp.
     *
     * @return int
     */
    public function getNroExp()
    {
        return $this->nroExp;
    }

    /**
     * Set fecha.
     *
     * @param \Date $fecha
     *
     * @return Expediente
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
     * Set observacion.
     *
     * @param string|null $observacion
     *
     * @return Expediente
     */
    public function setObservacion($observacion = null)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion.
     *
     * @return string|null
     */
    public function getObservacion()
    {
        return $this->observacion;
    }
}
