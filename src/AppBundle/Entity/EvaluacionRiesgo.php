<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}
