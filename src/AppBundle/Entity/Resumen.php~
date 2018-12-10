<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resumen
 *
 * @ORM\Table(name="resumen")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResumenRepository")
 */
class Resumen
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
     * @ORM\Column(name="texto", type="text")
     */
    private $texto;


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
     * Set texto.
     *
     * @param string $texto
     *
     * @return Resumen
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto.
     *
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }
}
