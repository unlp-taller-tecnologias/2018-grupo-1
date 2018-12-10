<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgresorCorruptibilidad
 *
 * @ORM\Table(name="agresor_corruptibilidad")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AgresorCorruptibilidadRepository")
 */
class AgresorCorruptibilidad
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
     * @ORM\ManyToOne(targetEntity="Agresor", inversedBy="agresorCorruptibilidad")     
     * @ORM\JoinColumn(name="agresor_id", referencedColumnName="id")
     */
    private $agresorId;

    /**
     * @ORM\ManyToOne(targetEntity="NivelCorruptibilidad")     
     * @ORM\JoinColumn(name="corruptibilidad_id", referencedColumnName="id")
     */
    private $corruptibilidadId;

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
     * @return AgresorCorruptibilidad
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
     * Set agresorId.
     *
     * @param \AppBundle\Entity\Agresor $agresorId
     *
     * @return AgresorCorruptibilidad
     */
    public function setAgresorId(\AppBundle\Entity\Agresor $agresorId)
    {
        $agresorId->addAgresorCorruptibilidad($this);
        $this->agresorId = $agresorId;

        return $this;
    }

    /**
     * Get agresorId.
     *
     * @return \AppBundle\Entity\Agresor
     */
    public function getAgresorId()
    {
        return $this->agresorId;
    }

    /**
     * Set corruptibilidadId.
     *
     * @param \AppBundle\Entity\NivelCorruptibilidad $corruptibilidadId
     *
     * @return AgresorCorruptibilidad
     */
    public function setCorruptibilidadId(\AppBundle\Entity\NivelCorruptibilidad $corruptibilidadId)
    {
        $this->corruptibilidadId = $corruptibilidadId;

        return $this;
    }

    /**
     * Get corruptibilidadId.
     *
     * @return \AppBundle\Entity\NivelCorruptibilidad
     */
    public function getCorruptibilidadId()
    {
        return $this->corruptibilidadId;
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
