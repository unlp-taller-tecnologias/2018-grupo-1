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
        echo "transform---   ";

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
        echo "reverseTransform---   ";
        var_dump($telefonoNumber);
        // no issue number? It's optional, so that's ok
        if (!$telefonoNumber) {
            return;
        }

        $telefono = $this->entityManager
            ->getRepository(Telefono::class)
            // query for the issue with this id
            ->findBy(array('numero'=>$telefonoNumber));
/*
        if (null === $telefono) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'An issue with number "%s" does not exist!',
                $telefonoNumber
            ));
        }
*/
        //var_dump($telefono);
        echo "                         ";
        //echo ($telefono[0]->getNumero());
        if (isset($telefono[0])){
            return $telefono[0];
        } else {
            return ((new Telefono)->setNumero($telefonoNumber));
        }
    }
}