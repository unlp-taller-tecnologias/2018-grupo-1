<?php

// src/AppBundle/Form/DataTransformer/StringToTelefonoTransformer.php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Telefono;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringToTelefonoTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function transform($telefono)
    {
        if (null === $telefono) {
            return '';
        }
        if ($telefono instanceof Telefono){
            return $telefono->getNumero();
        } else {
            return $telefono;
        }
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $issueNumber
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($telefonoNumber)
    {
        if (!$telefonoNumber) {
            return;
        }

        $telefono = $this->entityManager
            ->getRepository(Telefono::class)
            ->findBy(array('numero'=>$telefonoNumber));
        if (isset($telefono[0])){
            return $telefono[0];
        } else {
            return ((new Telefono)->setNumero($telefonoNumber));
        }
    }
}