<?php
// src/AppBundle/Form/RegistroType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Profesion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RegistroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre')->add('apellido')->add('esAdmin')->add('profesion', EntityType::class, array(
            'class' => 'AppBundle:Profesion',
            'choice_label' => function ($profesion){
                return $profesion->getDescripcion();
            }
        )
    );

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

}