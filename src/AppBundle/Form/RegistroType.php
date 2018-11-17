<?php
// src/AppBundle/Form/RegistroType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Profesion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class RegistroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->remove('email');
        $builder->remove('plainPassword');

        $builder->add('nombre')->add('apellido')
        ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                        'placeholder' => '*******',
                    ),
                ),
                'first_options' => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Reingrese la contraseña'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))

        ->add('esAdmin')->add('profesion', EntityType::class, array(
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