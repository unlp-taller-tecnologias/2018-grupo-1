<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvaluacionMedida
 *
 * @ORM\Table(name="evaluacion_medida")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluacionMedidaRepository")
 */
class EvaluacionMedida
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
     * @ORM\ManyToOne(targetEntity="EvaluacionRiesgo")     
     * @ORM\JoinColumn(name="evaluacion_id", referencedColumnName="id")
     */
    private $evaluacionId;

    /**
     * @ORM\ManyToOne(targetEntity="MedidaJudicial")     
     * @ORM\JoinColumn(name="medida_id", referencedColumnName="id")
     */
    private $medidaId;

    /**
     * @var bool
     *
     * @ORM\Column(name="denuncia", type="boolean")
     */
    private $denuncia;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cantidad_veces", type="smallint", nullable=true)
     */
    private $cantidadVeces;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="incumplimiento", type="boolean", nullable=true)
     */
    private $incumplimiento;

    /**
     * Set evaluacionId.
     *
     * @param int $evaluacionId
     *
     * @return EvaluacionMedida
     */
    public function setEvaluacionId($evaluacionId)
    {
        $this->evaluacionId = $evaluacionId;

        return $this;
    }

    /**
     * Get evaluacionId.
     *
     * @return int
     */
    public function getEvaluacionId()
    {
        return $this->evaluacionId;
    }

    /**
     * Set medidaId.
     *
     * @param int $medidaId
     *
     * @return EvaluacionMedida
     */
    public function setMedidaId($medidaId)
    {
        $this->medidaId = $medidaId;

        return $this;
    }

    /**
     * Get medidaId.
     *
     * @return int
     */
    public function getMedidaId()
    {
        return $this->medidaId;
    }

    /**
     * Set denuncia.
     *
     * @param bool $denuncia
     *
     * @return EvaluacionMedida
     */
    public function setDenuncia($denuncia)
    {
        $this->denuncia = $denuncia;

        return $this;
    }

    /**
     * Get denuncia.
     *
     * @return bool
     */
    public function getDenuncia()
    {
        return $this->denuncia;
    }

    /**
     * Set cantidadVeces.
     *
     * @param int|null $cantidadVeces
     *
     * @return EvaluacionMedida
     */
    public function setCantidadVeces($cantidadVeces = null)
    {
        $this->cantidadVeces = $cantidadVeces;

        return $this;
    }

    /**
     * Get cantidadVeces.
     *
     * @return int|null
     */
    public function getCantidadVeces()
    {
        return $this->cantidadVeces;
    }

    /**
     * Set incumplimiento.
     *
     * @param bool|null $incumplimiento
     *
     * @return EvaluacionMedida
     */
    public function setIncumplimiento($incumplimiento = null)
    {
        $this->incumplimiento = $incumplimiento;

        return $this;
    }

    /**
     * Get incumplimiento.
     *
     * @return bool|null
     */
    public function getIncumplimiento()
    {
        return $this->incumplimiento;
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
}
