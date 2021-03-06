<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use AppBundle\Entity\Nacion;


class AgresorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombre', TextType::class, array('label' => 'Nombre (*)','attr' => array('class' => 'form-control', 'required' => true)))
        ->add('apellido', TextType::class, array('label' => 'Apellido (*)','attr' => array('class' => 'form-control','required' => true)))
        ->add('edad', IntegerType::class, array('label' => 'Edad','attr' => array('class' => 'form-control')))
        ->add('fechaNac', DateType::class, array(
                'label' => 'Fecha de nacimiento',
                'attr' => array('class' => 'form-control'),
                'widget' => 'single_text',))
        ->add('nroDocumento', TextType::class, array(
                'label' => 'N° de documento',
                'attr' => array('class' => 'form-control')))
        ->add('nacion', CountryType::class, array(
            'preferred_choices' => array('AR'),
            'label' => 'Nacionalidad',
            'attr' => array('class' => 'form-control','placeholder' => 'AR')))
        ->add('barrio', TextType::class, array(
                'label'    => 'Barrio',
                'required' => false,
                'attr' => array('class' => 'form-control'),
                ))
        ->add('calle', TextType::class, array('label' => 'Calle','attr' => array('class' => 'form-control')))
        ->add('numero', TextType::class, array('label' => 'N°','attr' => array('class' => 'form-control')))
        ->add('piso', TextType::class, array('label' => 'Piso','attr' => array('class' => 'form-control')))
        ->add('depto', TextType::class, array('label' => 'Dpto','attr' => array('class' => 'form-control')))
        ->add('otros', TextType::class, array('label' => 'Otros','attr' => array('class' => 'form-control')))
        ->add('condicionLaboral', TextareaType::class, array('label' => 'Condición Laboral','attr' => array('class' => 'form-control','col-md-12','rows'=>"2")));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Agresor',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_agresor';
    }


}
