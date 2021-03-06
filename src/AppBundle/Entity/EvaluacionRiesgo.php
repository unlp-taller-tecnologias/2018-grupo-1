<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * EvaluacionRiesgo
 *
 * @ORM\Table(name="evaluacion_riesgo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluacionRiesgoRepository")
 */
class EvaluacionRiesgo
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
     * @var bool
     *
     * @ORM\Column(name="cohabitacion", type="boolean")
     */
    private $cohabitacion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cantidadTiempoVinculo", type="smallint", nullable=true)
     */
    private $cantidadTiempoVinculo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="unidadTiempoVinculo", type="string", length=10, nullable=true)
     */
    private $unidadTiempoVinculo;

    /**
     * @var \Date|null
     *
     * @ORM\Column(name="fechaInicio", type="date", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \Date|null
     *
     * @ORM\Column(name="fechaUltimoEpisodio", type="date", nullable=true)
     */
    private $fechaUltimoEpisodio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="vinculo", type="string", length=25, nullable=true)
     */
    private $vinculo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="unidadTiempoMaltrato", type="string", length=10, nullable=true)
     */
    private $unidadTiempoMaltrato;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cantidadTiempoMaltrato", type="smallint", nullable=true)
     */
    private $cantidadTiempoMaltrato;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcionUltimoEpisodio", type="string", length=255, nullable=true)
     */
    private $descripcionUltimoEpisodio;

    /**
     * @ORM\ManyToOne(targetEntity="Victima", inversedBy="evaluacionesDeRiesgo")
     * @ORM\JoinColumn(name="victima_id", referencedColumnName="id")
     */
    protected $victima;

     /**
     * @ORM\ManyToOne(targetEntity="Agresor", cascade={"persist"})
     * @ORM\JoinColumn(name="agresor_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $agresor;


    /**
     * @ORM\ManyToMany(targetEntity="ViolenciaPadecida", inversedBy="evaluacionesDeRiesgo")
     * @ORM\JoinTable(name="evaluacion_violencia")
     */
    private $violenciasPadecidas;

    /**
     * @ORM\ManyToMany(targetEntity="AntecedenteJudicial", inversedBy="evaluacionesDeRiesgo", cascade={"persist"})
     * @ORM\JoinTable(name="evaluacion_antecedente")
     */
    private $antecedentesJudiciales;

    /**
     * @ORM\OneToOne(targetEntity="IntervencionFamilia", mappedBy="evaluacionRiesgo", cascade={"persist"})
     * @ORM\JoinColumn(name="familia", referencedColumnName="id")
     */
    private $familia;

    /**
     * @ORM\OneToOne(targetEntity="IntervencionPenal", mappedBy="evaluacionRiesgo", cascade={"persist"})
     * @ORM\JoinColumn(name="penal", referencedColumnName="id")
     */
    private $penal;

    /**
     * @ORM\OneToMany(targetEntity="EvaluacionIndicador", mappedBy="evaluacionRiesgoId")
     */
    protected $evaluacionIndicador;

    /**
     * @ORM\OneToOne(targetEntity="Perimetral", inversedBy="evaluacionRiesgo", cascade={"persist"})
     * @ORM\JoinColumn(name="perimetral_id", referencedColumnName="id")
     */
    private $perimetral;

    /**
    * @ORM\OneToMany(targetEntity="EvaluacionMedida", mappedBy="evaluacionId")
    */
   protected $evaluacionMedida;

    public function __construct() {
        $this->violenciasPadecidas = new ArrayCollection();
        $this->antecedentesJudiciales = new ArrayCollection();
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
     * Set cohabitacion.
     *
     * @param bool $cohabitacion
     *
     * @return EvaluacionRiesgo
     */
    public function setCohabitacion($cohabitacion)
    {
        $this->cohabitacion = $cohabitacion;

        return $this;
    }

    /**
     * Get cohabitacion.
     *
     * @return bool
     */
    public function getCohabitacion()
    {
        return $this->cohabitacion;
    }

    /**
     * Set cantidadTiempoVinculo.
     *
     * @param int|null $cantidadTiempoVinculo
     *
     * @return EvaluacionRiesgo
     */
    public function setCantidadTiempoVinculo($cantidadTiempoVinculo = null)
    {
        $this->cantidadTiempoVinculo = $cantidadTiempoVinculo;

        return $this;
    }

    /**
     * Get cantidadTiempoVinculo.
     *
     * @return int|null
     */
    public function getCantidadTiempoVinculo()
    {
        return $this->cantidadTiempoVinculo;
    }

    /**
     * Set unidadTiempoVinculo.
     *
     * @param string|null $unidadTiempoVinculo
     *
     * @return EvaluacionRiesgo
     */
    public function setUnidadTiempoVinculo($unidadTiempoVinculo = null)
    {
        $this->unidadTiempoVinculo = $unidadTiempoVinculo;

        return $this;
    }

    /**
     * Get unidadTiempoVinculo.
     *
     * @return string|null
     */
    public function getUnidadTiempoVinculo()
    {
        return $this->unidadTiempoVinculo;
    }

    /**
     * Set fechaInicio.
     *
     * @param \Date|null $fechaInicio
     *
     * @return EvaluacionRiesgo
     */
    public function setFechaInicio($fechaInicio = null)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio.
     *
     * @return \Date|null
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaUltimoEpisodio.
     *
     * @param \Date|null $fechaUltimoEpisodio
     *
     * @return EvaluacionRiesgo
     */
    public function setFechaUltimoEpisodio($fechaUltimoEpisodio = null)
    {
        $this->fechaUltimoEpisodio = $fechaUltimoEpisodio;

        return $this;
    }

    /**
     * Get fechaUltimoEpisodio.
     *
     * @return \Date|null
     */
    public function getFechaUltimoEpisodio()
    {
        return $this->fechaUltimoEpisodio;
    }

    /**
     * Set vinculo.
     *
     * @param string|null $vinculo
     *
     * @return EvaluacionRiesgo
     */
    public function setVinculo($vinculo = null)
    {
        $this->vinculo = $vinculo;

        return $this;
    }

    /**
     * Get vinculo.
     *
     * @return string|null
     */
    public function getVinculo()
    {
        return $this->vinculo;
    }

    /**
     * Set unidadTiempoMaltrato.
     *
     * @param string|null $unidadTiempoMaltrato
     *
     * @return EvaluacionRiesgo
     */
    public function setUnidadTiempoMaltrato($unidadTiempoMaltrato = null)
    {
        $this->unidadTiempoMaltrato = $unidadTiempoMaltrato;

        return $this;
    }

    /**
     * Get unidadTiempoMaltrato.
     *
     * @return string|null
     */
    public function getUnidadTiempoMaltrato()
    {
        return $this->unidadTiempoMaltrato;
    }

    /**
     * Set cantidadTiempoMaltrato.
     *
     * @param int|null $cantidadTiempoMaltrato
     *
     * @return EvaluacionRiesgo
     */
    public function setCantidadTiempoMaltrato($cantidadTiempoMaltrato = null)
    {
        $this->cantidadTiempoMaltrato = $cantidadTiempoMaltrato;

        return $this;
    }

    /**
     * Get cantidadTiempoMaltrato.
     *
     * @return int|null
     */
    public function getCantidadTiempoMaltrato()
    {
        return $this->cantidadTiempoMaltrato;
    }

    /**
     * Set descripcionUltimoEpisodio.
     *
     * @param string|null $descripcionUltimoEpisodio
     *
     * @return EvaluacionRiesgo
     */
    public function setDescripcionUltimoEpisodio($descripcionUltimoEpisodio = null)
    {
        $this->descripcionUltimoEpisodio = $descripcionUltimoEpisodio;

        return $this;
    }

    /**
     * Get descripcionUltimoEpisodio.
     *
     * @return string|null
     */
    public function getDescripcionUltimoEpisodio()
    {
        return $this->descripcionUltimoEpisodio;
    }

    /**
     * Set victima.
     *
     * @param \AppBundle\Entity\Victima|null $victima
     *
     * @return EvaluacionRiesgo
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
     * Set agresor.
     *
     * @param \AppBundle\Entity\Agresor|null $agresor
     *
     * @return EvaluacionRiesgo
     */
    public function setAgresor(\AppBundle\Entity\Agresor $agresor = null)
    {
        $this->agresor = $agresor;

        return $this;
    }

    /**
     * Get agresor.
     *
     * @return \AppBundle\Entity\Agresor|null
     */
    public function getAgresor()
    {
        return $this->agresor;
    }

    /**
     * Add violenciasPadecida.
     *
     * @param \AppBundle\Entity\ViolenciaPadecida $violenciasPadecida
     *
     * @return EvaluacionRiesgo
     */
    public function addViolenciasPadecida(\AppBundle\Entity\ViolenciaPadecida $violenciasPadecida)
    {
        $this->violenciasPadecidas[] = $violenciasPadecida;

        return $this;
    }

    /**
     * Remove violenciasPadecida.
     *
     * @param \AppBundle\Entity\ViolenciaPadecida $violenciasPadecida
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeViolenciasPadecida(\AppBundle\Entity\ViolenciaPadecida $violenciasPadecida)
    {
        return $this->violenciasPadecidas->removeElement($violenciasPadecida);
    }

    /**
     * Get violenciasPadecidas.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getViolenciasPadecidas()
    {
        return $this->violenciasPadecidas;
    }

    /**
     * Add antecedentesJudiciale.
     *
     * @param \AppBundle\Entity\AntecedenteJudicial $antecedentesJudiciale
     *
     * @return EvaluacionRiesgo
     */
    public function addAntecedentesJudiciale(\AppBundle\Entity\AntecedenteJudicial $antecedentesJudiciale)
    {
        $this->antecedentesJudiciales[] = $antecedentesJudiciale;

        return $this;
    }

    /**
     * Remove antecedentesJudiciale.
     *
     * @param \AppBundle\Entity\AntecedenteJudicial $antecedentesJudiciale
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAntecedentesJudiciale(\AppBundle\Entity\AntecedenteJudicial $antecedentesJudiciale)
    {
        return $this->antecedentesJudiciales->removeElement($antecedentesJudiciale);
    }

    /**
     * Get antecedentesJudiciales.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAntecedentesJudiciales()
    {
        return $this->antecedentesJudiciales;
    }

    /**
     * Set familia.
     *
     * @param \AppBundle\Entity\IntervencionFamilia|null $familia
     *
     * @return EvaluacionRiesgo
     */
    public function setFamilia(\AppBundle\Entity\IntervencionFamilia $familia = null)
    {
        $familia->setEvaluacionRiesgo($this);
        $this->familia = $familia;

        return $this;
    }

    /**
     * Get familia.
     *
     * @return \AppBundle\Entity\IntervencionFamilia|null
     */
    public function getFamilia()
    {
        return $this->familia;
    }

    /**
     * Set penal.
     *
     * @param \AppBundle\Entity\IntervencionPenal|null $penal
     *
     * @return EvaluacionRiesgo
     */
    public function setPenal(\AppBundle\Entity\IntervencionPenal $penal = null)
    {
        $penal->setEvaluacionRiesgo($this);
        $this->penal = $penal;

        return $this;
    }

    /**
     * Get penal.
     *
     * @return \AppBundle\Entity\IntervencionPenal|null
     */
    public function getPenal()
    {
        return $this->penal;
    }

    /**
     * Add evaluacionIndicador.
     *
     * @param \AppBundle\Entity\EvaluacionIndicador $evaluacionIndicador
     *
     * @return EvaluacionRiesgo
     */
    public function addEvaluacionIndicador(\AppBundle\Entity\EvaluacionIndicador $evaluacionIndicador)
    {
        $this->evaluacionIndicador[] = $evaluacionIndicador;

        return $this;
    }

    /**
     * Remove evaluacionIndicador.
     *
     * @param \AppBundle\Entity\EvaluacionIndicador $evaluacionIndicador
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeEvaluacionIndicador(\AppBundle\Entity\EvaluacionIndicador $evaluacionIndicador)
    {
        return $this->evaluacionIndicador->removeElement($evaluacionIndicador);
    }

    /**
     * Get evaluacionIndicador.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluacionIndicador()
    {
        return $this->evaluacionIndicador;
    }

    /**
     * Add evaluacionMedida.
     *
     * @param \AppBundle\Entity\EvaluacionMedida $evaluacionMedida
     *
     * @return EvaluacionRiesgo
     */
    public function addEvaluacionMedida(\AppBundle\Entity\EvaluacionMedida $evaluacionMedida)
    {
        $this->evaluacionMedida[] = $evaluacionMedida;
    }

    /* Set perimetral.
     *
     * @param \AppBundle\Entity\Perimetral|null $perimetral
     *
     * @return EvaluacionRiesgo
     */
    public function setPerimetral(\AppBundle\Entity\Perimetral $perimetral = null)
    {
        $perimetral->setEvaluacionRiesgo($this);
        $this->perimetral = $perimetral;

        return $this;
    }

    /**
     * Remove evaluacionMedida.
     *
     * @param \AppBundle\Entity\EvaluacionMedida $evaluacionMedida
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeEvaluacionMedida(\AppBundle\Entity\EvaluacionMedida $evaluacionMedida)
    {
        return $this->evaluacionMedida->removeElement($evaluacionMedida);
    }

    /**
     * Get evaluacionMedida.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluacionMedida()
    {
        return $this->evaluacionMedida;
    }
     /* Get perimetral.
     *
     * @return \AppBundle\Entity\Perimetral|null
     */
    public function getPerimetral()
    {
        return $this->perimetral;
    }
}
