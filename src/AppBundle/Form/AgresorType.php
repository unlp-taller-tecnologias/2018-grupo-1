<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use AppBundle\Entity\Nacion;
use AppBundle\Entity\Provincia;
use AppBundle\Entity\Localidad;
use AppBundle\Entity\Barrio;

class AgresorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre')->add('apellido')
        ->add('fechaNac', BirthdayType::class)
        ->add('edad')->add('nroDocumento')
        ->add('nacion', CountryType::class)
        ->add('provincia', EntityType::class, array(
            'label'    => 'Provincia:',
            'required' => false,
            'class' => 'AppBundle:Provincia',
            'choice_label' => function ($provincia){
                return $provincia->getNombre();},           
            ))
        ->add('localidad', EntityType::class, array(
            'label'    => 'Localidad:',
            'required' => false,
            'class' => 'AppBundle:Localidad',
            'choice_label' => function ($localidad){
                return $localidad->getNombre();},          
            ))
        ->add('barrio', EntityType::class, array(
            'label'    => 'Barrio:',
            'required' => false,
            'class' => 'AppBundle:Barrio',
            'choice_label' => function ($barrio){
                return $barrio->getNombre();},          
            ))
        ->add('calle')->add('numero')->add('piso')->add('depto')->add('otros')->add('condicionLaboral');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Agresor'
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
