<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IntervencionFamilia
 *
 * @ORM\Table(name="intervencion_familia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IntervencionFamiliaRepository")
 */
class IntervencionFamilia
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
     * @ORM\OneToMany(targetEntity="IntervencionTipoFamilia", mappedBy="familia")
     */
    protected $intervencionTipoFamilia;

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
     * Add intervencionTipoFamilium.
     *
     * @param \AppBundle\Entity\IntervencionTipoFamilia $intervencionTipoFamilium
     *
     * @return IntervencionFamilia
     */
    public function addIntervencionTipoFamilium(\AppBundle\Entity\IntervencionTipoFamilia $intervencionTipoFamilium)
    {
        $this->intervencionTipoFamilia[] = $intervencionTipoFamilium;

        return $this;
    }

    /**
     * Remove intervencionTipoFamilium.
     *
     * @param \AppBundle\Entity\IntervencionTipoFamilia $intervencionTipoFamilium
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIntervencionTipoFamilium(\AppBundle\Entity\IntervencionTipoFamilia $intervencionTipoFamilium)
    {
        return $this->intervencionTipoFamilia->removeElement($intervencionTipoFamilium);
    }

    /**
     * Get intervencionTipoFamilia.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIntervencionTipoFamilia()
    {
        return $this->intervencionTipoFamilia;
    }
}
