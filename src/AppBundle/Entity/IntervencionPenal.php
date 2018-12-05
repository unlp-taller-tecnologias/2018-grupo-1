<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IntervencionPenal
 *
 * @ORM\Table(name="intervencion_penal")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IntervencionPenalRepository")
 */
class IntervencionPenal
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
     * @ORM\Column(name="nombre", type="string", length=20)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="Juzgado", inversedBy="intervenciones")     
     * @ORM\JoinColumn(name="juzgado_id", referencedColumnName="id")
     */
    private $juzgado;

    /**
     * 
     * @ORM\OneToOne(targetEntity="EvaluacionRiesgo", cascade={"persist"})
     * @ORM\JoinColumn(name="evaluacionRiesgo_id", referencedColumnName="id")
     */
    private $evaluacionRiesgo;

    /**
     * @ORM\OneToMany(targetEntity="IntervencionTipoPenal", mappedBy="penal")
     */
    protected $intervencionTipoPenal;

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
     * @return TipoIntervencionJudicial
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
     * Constructor
     */
    public function __construct()
    {
        $this->intervencionTipoIntervencion = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set juzgado.
     *
     * @param \AppBundle\Entity\Juzgado|null $juzgado
     *
     * @return TipoIntervencionJudicial
     */
    public function setJuzgado(\AppBundle\Entity\Juzgado $juzgado = null)
    {
        $this->juzgado = $juzgado;

        return $this;
    }

    /**
     * Get juzgado.
     *
     * @return \AppBundle\Entity\Juzgado|null
     */
    public function getJuzgado()
    {
        return $this->juzgado;
    }

    /**
     * Set evaluacionRiesgo.
     *
     * @param \AppBundle\Entity\EvaluacionRiesgo|null $evaluacionRiesgo
     *
     * @return TipoIntervencionJudicial
     */
    public function setEvaluacionRiesgo(\AppBundle\Entity\EvaluacionRiesgo $evaluacionRiesgo = null)
    {
        $this->evaluacionRiesgo = $evaluacionRiesgo;

        return $this;
    }

    /**
     * Get evaluacionRiesgo.
     *
     * @return \AppBundle\Entity\EvaluacionRiesgo|null
     */
    public function getEvaluacionRiesgo()
    {
        return $this->evaluacionRiesgo;
    }

    

    /**
     * Add intervencionTipoPenal.
     *
     * @param \AppBundle\Entity\IntervencionTipoPenal $intervencionTipoPenal
     *
     * @return IntervencionPenal
     */
    public function addIntervencionTipoPenal(\AppBundle\Entity\IntervencionTipoPenal $intervencionTipoPenal)
    {
        $this->intervencionTipoPenal[] = $intervencionTipoPenal;

        return $this;
    }

    /**
     * Remove intervencionTipoPenal.
     *
     * @param \AppBundle\Entity\IntervencionTipoPenal $intervencionTipoPenal
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIntervencionTipoPenal(\AppBundle\Entity\IntervencionTipoPenal $intervencionTipoPenal)
    {
        return $this->intervencionTipoPenal->removeElement($intervencionTipoPenal);
    }

    /**
     * Get intervencionTipoPenal.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIntervencionTipoPenal()
    {
        return $this->intervencionTipoPenal;
    }
}
