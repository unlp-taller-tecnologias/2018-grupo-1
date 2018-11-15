<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvaluacionIntervencionJuzgado
 *
 * @ORM\Table(name="evaluacion_intervencion_juzgado")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluacionIntervencionJuzgadoRepository")
 */
class EvaluacionIntervencionJuzgado
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="EvaluacionRiesgo")     
     * @ORM\JoinColumn(name="evaluacionRiesgo_id", referencedColumnName="id")
     */
    private $evaluacionRiesgoId;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="IntervencionJudicial")     
     * @ORM\JoinColumn(name="intervencionJudicial_id", referencedColumnName="id")
     */
    private $intervencionJudicialId;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Juzgado")     
     * @ORM\JoinColumn(name="juzgado_id", referencedColumnName="id")
     */
    private $juzgadoId;

    /**
     * Set evaluacionRiesgoId.
     *
     * @param \AppBundle\Entity\EvaluacionRiesgo $evaluacionRiesgoId
     *
     * @return EvaluacionIntervencionJuzgado
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
     * Set intervencionJudicialId.
     *
     * @param \AppBundle\Entity\IntervencionJudicial $intervencionJudicialId
     *
     * @return EvaluacionIntervencionJuzgado
     */
    public function setIntervencionJudicialId(\AppBundle\Entity\IntervencionJudicial $intervencionJudicialId)
    {
        $this->intervencionJudicialId = $intervencionJudicialId;

        return $this;
    }

    /**
     * Get intervencionJudicialId.
     *
     * @return \AppBundle\Entity\IntervencionJudicial
     */
    public function getIntervencionJudicialId()
    {
        return $this->intervencionJudicialId;
    }

    /**
     * Set juzgadoId.
     *
     * @param \AppBundle\Entity\Juzgado $juzgadoId
     *
     * @return EvaluacionIntervencionJuzgado
     */
    public function setJuzgadoId(\AppBundle\Entity\Juzgado $juzgadoId)
    {
        $this->juzgadoId = $juzgadoId;

        return $this;
    }

    /**
     * Get juzgadoId.
     *
     * @return \AppBundle\Entity\Juzgado
     */
    public function getJuzgadoId()
    {
        return $this->juzgadoId;
    }
}
