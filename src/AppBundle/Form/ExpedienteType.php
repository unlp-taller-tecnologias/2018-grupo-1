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
        ->add('nroExp',NumberType::class, array('label' => 'N° de expediente (*)','attr' => array('class' => 'form-control','min'=>'0', 'value'=>$options['nextNroExp'], 'required' => true)))
        ->add('usuarios')
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
        ->add('derivacion', TextType::class, array('label'=>'¿Viene derivada de alguna institución? ¿Cuál?','attr' => array('class' => 'form-control')))
        ->add('fecha', DateType::class, array('widget' => 'single_text', 'label' => 'Fecha', 'attr' => array('class' => 'form-control')))
        ->add('victima', VictimaType::class)
        ->add('observacion', TextareaType::class, array('label' => 'Observaciones','attr' => array('class' => 'form-control','col-md-12','rows'=>"5")))
        ->add('expedienteRedes', CollectionType::class, array(
            'entry_type' => ExpedienteRedesType::class,
            'allow_add' => true ,
            'by_reference' => false,
            'prototype' => true,))
        ->add('botones', CollectionType::class, array(
            'label' => false,
            'entry_type' => BotonAntipanicoType::class,
            'entry_options' => array('label' => false),
            'allow_add' => true,
            'by_reference' => false,
            'prototype' => true,
        ))
        ->add('ingresosHogar', CollectionType::class, array(
            'label' => false,
            'entry_type' => HogarType::class,
            'entry_options' => array('label' => false),
            'allow_add' => true,
            'by_reference' => false,
            'prototype' => true,
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
            'cascade_validation' => true,
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
