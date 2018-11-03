<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anexo
 *
 * @ORM\Table(name="anexo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnexoRepository")
 */
class Anexo
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
     * @var \Date
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, unique=true)
     */
    private $path;

    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="anexos")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     */
    protected $categoria;

    /**
     * @ORM\ManyToOne(targetEntity="Expediente", inversedBy="anexos")
     * @ORM\JoinColumn(name="expediente_id", referencedColumnName="id")
     */
    protected $expediente;


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
     * Set fecha.
     *
     * @param \Date $fecha
     *
     * @return Anexo
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha.
     *
     * @return \Date
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set path.
     *
     * @param string $path
     *
     * @return Anexo
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set categoria.
     *
     * @param \AppBundle\Entity\Categoria|null $categoria
     *
     * @return Anexo
     */
    public function setCategoria(\AppBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria.
     *
     * @return \AppBundle\Entity\Categoria|null
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set expediente.
     *
     * @param \AppBundle\Entity\Expediente|null $expediente
     *
     * @return Anexo
     */
    public function setExpediente(\AppBundle\Entity\Expediente $expediente = null)
    {
        $this->expediente = $expediente;

        return $this;
    }

    /**
     * Get expediente.
     *
     * @return \AppBundle\Entity\Expediente|null
     */
    public function getExpediente()
    {
        return $this->expediente;
    }
}
