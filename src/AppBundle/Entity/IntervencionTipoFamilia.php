<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IntervencionTipoFamilia
 *
 * @ORM\Table(name="intervencion_tipo_familia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IntervencionTipoFamiliaRepository")
 */
class IntervencionTipoFamilia
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
     * @ORM\ManyToOne(targetEntity="IntervencionFamilia")     
     * @ORM\JoinColumn(name="familia_id", referencedColumnName="id")
     */
    private $familia;

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
     * Set familia.
     *
     * @param \AppBundle\Entity\IntervencionFamilia|null $familia
     *
     * @return IntervencionTipoFamilia
     */
    public function setFamilia(\AppBundle\Entity\IntervencionFamilia $familia = null)
    {
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
}
