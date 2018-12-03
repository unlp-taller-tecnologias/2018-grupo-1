<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;#
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\IntervencionRealizada;
use AppBundle\Entity\RazonConsulta;
use AppBundle\Form\VictimaType;
use AppBundle\Form\HogarType;
use AppBundle\Form\BotonAntipanicoType;
use AppBundle\Form\ResumenType;
use AppBundle\Form\ExpedienteRedesType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use AppBundle\Form\SelectUserType;


class ExpedienteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nroExp',NumberType::class, array('label' => 'N° de expediente','attr' => array('class' => 'form-control','min'=>'0', 'value'=>$options['nextNroExp'])))
        // ->add('nroExp')

        // ->add('usuarios', ChoiceType::class, array(
        //     'label'    => 'Entrevistó:',
        //     'required' => true,
        //     'class' => 'AppBundle:Usuario',
        //     'choice_label' => function ($usuario){
        //         return $usuario->getNombre();},
        //     'expanded'  => true,
        //     'multiple'  => true,
        //     ))
        ->add('usuarios')
        // ->add('usuarios', CollectionType::class, array(
        //     //'entry_type' => EntityType::class,
        //     //'entry_type' => SelectUserType::class,
        //     'entry_type' => ChoiceType::class,
        //     'entry_options' => array(
        //         'label' => false,
        //         //'choices' => 'AppBundle:Usuario',
        //         'choices' => array(
        //             'Nashville' => 'nashville',
        //             'Paris'     => 'paris',
        //             'Berlin'    => 'berlin',
        //             'London'    => 'london',
        //         )
        //     ),

        //     'allow_add' => true,
        //     'by_reference' => false,
        //     'prototype' => true,
        //     ))

        ->add('razonConsulta', EntityType::class, array(
            'class' => 'AppBundle:RazonConsulta',
            'label' => '¿Por qué consulta?',
            'attr' => array('class' => 'form-control'),
            'query_builder' => function ($razonConsulta) {
              return $razonConsulta->createQueryBuilder('r')
                ->where('r.activo = 1');
            },
            'choice_label' => function ($razonConsulta){
                return $razonConsulta->getDescripcion();
            }))
        ->add('derivacion', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('fecha', DateType::class, array('widget' => 'single_text', 'label' => 'Fecha inicio', 'attr' => array('class' => 'form-control')))
        // ->add('intervencionesRealizadas', ChoiceType::class, array(
        //     //'attr' => array('class' => 'col-md-12 row m-5'),
        //     'label'    => 'Intervenciones',
        //     'class' => 'AppBundle:IntervencionRealizada',
        //     'choices' => function ($intervencion){
        //         return $intervencion->getNombre();},
        //     'expanded'  => true,
        //     'multiple'  => true,
        //     ))
        ->add('victima', VictimaType::class)
        ->add('observacion', TextareaType::class, array('label' => 'Observaciones','attr' => array('class' => 'form-control','col-md-12','rows'=>"5")))
        // ->add('expedienteRedes', CollectionType::class, array(
        //     'entry_type' => ExpedienteRedesType::class,
        //     'entry_options' => array('label' => true),
        //     'allow_add' => true ,
        //     'by_reference' => false,
        //     'prototype' => true,
        //     'prototype_data' => 'New Tag Placeholder',
        // ))
        ->add('expedienteRedes', CollectionType::class, array(
            'entry_type' => ExpedienteRedesType::class,
            // 'entry_options' => array('label' => false),
            'allow_add' => true ,
            'by_reference' => false,
            'prototype' => true,))
        ->add('intervencionesRealizadas', EntityType::class, array(
            'label'    => 'Intervenciones realizadas',
            'required' => false,
            'class' => 'AppBundle:IntervencionRealizada',
            'query_builder' => function ($intervencion) {
              return $intervencion->createQueryBuilder('i')
                ->where('i.activo = 1');
            },
            'choice_label' => function ($intervencion){
                return $intervencion->getDescripcion();},
            'expanded'  => true,
            'multiple'  => true,
            ))
        ->add('botones', CollectionType::class, array(
            'entry_type' => BotonAntipanicoType::class,
            'entry_options' => array('label' => false),
            'allow_add' => true,
            'by_reference' => false,
            'prototype' => true,
            //'prototype_data' => 'Ingrese un telefono',
        ))
        ->add('ingresosHogar', CollectionType::class, array(
            'entry_type' => HogarType::class,
            'entry_options' => array('label' => false),
            'allow_add' => true,
            'by_reference' => false,
            'prototype' => true,
            //'prototype_data' => 'Ingrese un telefono',
        ))
        ->add('resumen', ResumenType::class, array('label' => false,'attr' => array('class' => 'col-md-12 ','rows'=>"25")));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Expediente',
            'required' => false,
            'nextNroExp' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_expediente';
    }


}
