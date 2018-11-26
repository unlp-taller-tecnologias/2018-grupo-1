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
     * @var string|null
     *
     * @ORM\Column(name="derivacion", type="string", length=255, nullable=true)
     */
    private $derivacion;

    /**
     * Un Expediente tiene Una Victima.
     * @ORM\OneToOne(targetEntity="Victima", inversedBy="expediente", cascade={"persist"})
     * @ORM\JoinColumn(name="victima_id", referencedColumnName="id")
     */
    private $victima;

    /**
     * @ORM\OneToMany(targetEntity="Anexo", mappedBy="expediente")
     * @ORM\JoinColumn(nullable=false)
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
     * @ORM\OneToOne(targetEntity="Resumen", cascade={"persist"})
     * @ORM\JoinColumn(name="resumen_id", referencedColumnName="id")
     */
    private $resumen;

    /**
     * Muchos Expedientes tienen muchos Usuarios.
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="expedientes", cascade={"persist"})
     */
    private $usuarios;

    /**
     * Muchos Expedientes tienen muchos IntervencionesRealizadas.
     * @ORM\ManyToMany(targetEntity="IntervencionRealizada", mappedBy="expedientes", cascade={"persist"})
     */
    private $intervencionesRealizadas;

    /**
     * @ORM\OneToMany(targetEntity="Hogar", mappedBy="expediente")
     */
    protected $ingresosHogar;

    /**
     * @ORM\ManyToOne(targetEntity="RazonConsulta", inversedBy="expedientes")
     * @ORM\JoinColumn(name="razonConsulta_id", referencedColumnName="id")
     */
    protected $razonConsulta;

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
     * Set derivacion.
     *
     * @param string|null $derivacion
     *
     * @return Expediente
     */
    public function setDerivacion($derivacion = null)
    {
        $this->derivacion = $derivacion;

        return $this;
    }

    /**
     * Get derivacion.
     *
     * @return string|null
     */
    public function getDerivacion()
    {
        return $this->derivacion;
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

    /**
     * Set victima.
     *
     * @param \AppBundle\Entity\Victima|null $victima
     *
     * @return Expediente
     */
    public function setVictima(\AppBundle\Entity\Victima $victima = null)
    {
        $this->victima = $victima;

        return $this;
    }

    /**
     * Get victima.
     *
     * @return \AppBundle\Entity\Victima|null
     */
    public function getVictima()
    {
        return $this->victima;
    }

    /**
     * Add anexo.
     *
     * @param \AppBundle\Entity\Anexo $anexo
     *
     * @return Expediente
     */
    public function addAnexo(\AppBundle\Entity\Anexo $anexo)
    {
        $this->anexos[] = $anexo;

        return $this;
    }

    /**
     * Remove anexo.
     *
     * @param \AppBundle\Entity\Anexo $anexo
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAnexo(\AppBundle\Entity\Anexo $anexo)
    {
        return $this->anexos->removeElement($anexo);
    }

    /**
     * Get anexos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnexos()
    {
        return $this->anexos;
    }

    /**
     * Add seguimiento.
     *
     * @param \AppBundle\Entity\Seguimiento $seguimiento
     *
     * @return Expediente
     */
    public function addSeguimiento(\AppBundle\Entity\Seguimiento $seguimiento)
    {
        $this->seguimientos[] = $seguimiento;

        return $this;
    }

    /**
     * Remove seguimiento.
     *
     * @param \AppBundle\Entity\Seguimiento $seguimiento
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSeguimiento(\AppBundle\Entity\Seguimiento $seguimiento)
    {
        return $this->seguimientos->removeElement($seguimiento);
    }

    /**
     * Get seguimientos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeguimientos()
    {
        return $this->seguimientos;
    }

    /**
     * Add botone.
     *
     * @param \AppBundle\Entity\BotonAntipanico $botone
     *
     * @return Expediente
     */
    public function addBotone(\AppBundle\Entity\BotonAntipanico $botone)
    {
        $this->botones[] = $botone;

        return $this;
    }

    /**
     * Remove botone.
     *
     * @param \AppBundle\Entity\BotonAntipanico $botone
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBotone(\AppBundle\Entity\BotonAntipanico $botone)
    {
        return $this->botones->removeElement($botone);
    }

    /**
     * Get botones.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBotones()
    {
        return $this->botones;
    }

    /**
     * Set resumen.
     *
     * @param \AppBundle\Entity\Resumen|null $resumen
     *
     * @return Expediente
     */
    public function setResumen(\AppBundle\Entity\Resumen $resumen = null)
    {
        $this->resumen = $resumen;

        return $this;
    }

    /**
     * Get resumen.
     *
     * @return \AppBundle\Entity\Resumen|null
     */
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * Add usuario.
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Expediente
     */
    public function addUsuario(\AppBundle\Entity\Usuario $usuario)
    {
        $this->usuarios[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario.
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUsuario(\AppBundle\Entity\Usuario $usuario)
    {
        return $this->usuarios->removeElement($usuario);
    }

    /**
     * Get usuarios.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Add intervencionesRealizada.
     *
     * @param \AppBundle\Entity\IntervencionRealizada $intervencionesRealizada
     *
     * @return Expediente
     */
    public function addIntervencionesRealizada(\AppBundle\Entity\IntervencionRealizada $intervencionesRealizada)
    {
        $this->intervencionesRealizadas[] = $intervencionesRealizada;

        return $this;
    }

    /**
     * Remove intervencionesRealizada.
     *
     * @param \AppBundle\Entity\IntervencionRealizada $intervencionesRealizada
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIntervencionesRealizada(\AppBundle\Entity\IntervencionRealizada $intervencionesRealizada)
    {
        return $this->intervencionesRealizadas->removeElement($intervencionesRealizada);
    }

    /**
     * Get intervencionesRealizadas.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIntervencionesRealizadas()
    {
        return $this->intervencionesRealizadas;
    }

    /**
     * Add ingresosHogar.
     *
     * @param \AppBundle\Entity\Hogar $ingresosHogar
     *
     * @return Expediente
     */
    public function addIngresosHogar(\AppBundle\Entity\Hogar $ingresosHogar)
    {
        $this->ingresosHogar[] = $ingresosHogar;

        return $this;
    }

    /**
     * Remove ingresosHogar.
     *
     * @param \AppBundle\Entity\Hogar $ingresosHogar
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIngresosHogar(\AppBundle\Entity\Hogar $ingresosHogar)
    {
        return $this->ingresosHogar->removeElement($ingresosHogar);
    }

    /**
     * Get ingresosHogar.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngresosHogar()
    {
        return $this->ingresosHogar;
    }

    /**
     * Set razonConsulta.
     *
     * @param \AppBundle\Entity\RazonConsulta|null $razonConsulta
     *
     * @return Expediente
     */
    public function setRazonConsulta(\AppBundle\Entity\RazonConsulta $razonConsulta = null)
    {
        $this->razonConsulta = $razonConsulta;

        return $this;
    }

    /**
     * Get razonConsulta.
     *
     * @return \AppBundle\Entity\RazonConsulta|null
     */
    public function getRazonConsulta()
    {
        return $this->razonConsulta;
    }
}
