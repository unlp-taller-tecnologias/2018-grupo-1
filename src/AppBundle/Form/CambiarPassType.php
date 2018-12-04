<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Profesion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CambiarPassType extends AbstractType {


    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        // $builder
        // ->add('plainPassword', RepeatedType::class, array(
        //         'type' => PasswordType::class,
        //         'options' => array(
        //             'translation_domain' => 'FOSUserBundle',
        //             'attr' => array(
        //                 'autocomplete' => 'new-password',
        //                 'placeholder' => '*******',
        //             ),
        //         ),
        //         'first_options' => array('label' => 'Contraseña'),
        //         'second_options' => array('label' => 'Reingrese la contraseña'),
        //         'invalid_message' => 'Las contraseñas no coinciden',
        //     ));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults(array(
          'validation_groups' => array('ChangePassword, Default'),
      ));
  }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ChangePasswordFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }

}
