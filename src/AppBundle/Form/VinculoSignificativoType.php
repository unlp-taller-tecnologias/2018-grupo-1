<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;


class VinculoSignificativoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', TextType::class, array(
            'label' => 'Nombre y apellido '))
        ->add('telefono', TelType::class, array(
            'label' => 'Teléfono '))
        ->add('fechaNac',DateType::class, array(
            'widget' => 'single_text',
                    'label' => 'Fecha de nacimiento '))
        ->add('edad', NumberType::class, array(
            'label' => 'Edad '))
        ->add('parentesco', TextType::class, array(
            'label' => 'Parentesco '))
        ->add('dni', TextType::class, array(
            'label' => 'DNI '));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\VinculoSignificativo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_vinculosignificativo';
    }


}
