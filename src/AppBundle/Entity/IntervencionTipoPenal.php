<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IntervencionTipoPenal
 *
 * @ORM\Table(name="intervencion_tipo_penal")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IntervencionTipoPenalRepository")
 */
class IntervencionTipoPenal
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
     * @ORM\ManyToOne(targetEntity="IntervencionPenal")     
     * @ORM\JoinColumn(name="penal_id", referencedColumnName="id")
     */
    private $penal;

    /**
     * @ORM\ManyToOne(targetEntity="IntervencionJudicial")     
     * @ORM\JoinColumn(name="intervencion_id", referencedColumnName="id")
     */
    private $intervencionJudicial;

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
     * @return IntervencionTipoIntervencion
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
     * Set tipoIntervencion.
     *
     * @param \AppBundle\Entity\TipoIntervencion|null $tipoIntervencion
     *
     * @return IntervencionTipoIntervencion
     */
    public function setTipoIntervencion(\AppBundle\Entity\TipoIntervencion $tipoIntervencion = null)
    {
        $this->tipoIntervencion = $tipoIntervencion;

        return $this;
    }

    /**
     * Get tipoIntervencion.
     *
     * @return \AppBundle\Entity\TipoIntervencion|null
     */
    public function getTipoIntervencion()
    {
        return $this->tipoIntervencion;
    }

    /**
     * Set intervencionJudicial.
     *
     * @param \AppBundle\Entity\IntervencionJudicial|null $intervencionJudicial
     *
     * @return IntervencionTipoIntervencion
     */
    public function setIntervencionJudicial(\AppBundle\Entity\IntervencionJudicial $intervencionJudicial = null)
    {
        $this->intervencionJudicial = $intervencionJudicial;

        return $this;
    }

    /**
     * Get intervencionJudicial.
     *
     * @return \AppBundle\Entity\IntervencionJudicial|null
     */
    public function getIntervencionJudicial()
    {
        return $this->intervencionJudicial;
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
     * Set penal.
     *
     * @param \AppBundle\Entity\IntervencionPenal|null $penal
     *
     * @return IntervencionTipoPenal
     */
    public function setPenal(\AppBundle\Entity\IntervencionPenal $penal = null)
    {
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
}
