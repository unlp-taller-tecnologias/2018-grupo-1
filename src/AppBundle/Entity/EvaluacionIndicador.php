<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvaluacionIndicador
 *
 * @ORM\Table(name="evaluacion_indicador")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluacionIndicadorRepository")
 */
class EvaluacionIndicador
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="EvaluacionRiesgo")     
     * @ORM\JoinColumn(name="evaluacionRiesgo_id", referencedColumnName="id")
     */
    private $evaluacionRiesgoId;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="IndicadorRiesgo")     
     * @ORM\JoinColumn(name="indicador_id", referencedColumnName="id")
     */
    private $indicadorId;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=255, nullable=true)
     */
    private $observacion;


    /**
     * Set observacion.
     *
     * @param string|null $observacion
     *
     * @return EvaluacionIndicador
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
     * Set evaluacionRiesgoId.
     *
     * @param \AppBundle\Entity\EvaluacionRiesgo $evaluacionRiesgoId
     *
     * @return EvaluacionIndicador
     */
    public function setEvaluacionRiesgoId(\AppBundle\Entity\EvaluacionRiesgo $evaluacionRiesgoId)
    {
        $this->evaluacionRiesgoId = $evaluacionRiesgoId;

        return $this;
    }

    /**
     * Get evaluacionRiesgoId.
     *
     * @return \AppBundle\Entity\EvaluacionRiesgo
     */
    public function getEvaluacionRiesgoId()
    {
        return $this->evaluacionRiesgoId;
    }

    /**
     * Set indicadorId.
     *
     * @param \AppBundle\Entity\IndicadorRiesgo $indicadorId
     *
     * @return EvaluacionIndicador
     */
    public function setIndicadorId(\AppBundle\Entity\IndicadorRiesgo $indicadorId)
    {
        $this->indicadorId = $indicadorId;

        return $this;
    }

    /**
     * Get indicadorId.
     *
     * @return \AppBundle\Entity\IndicadorRiesgo
     */
    public function getIndicadorId()
    {
        return $this->indicadorId;
    }
}
