<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\TipoAbogado;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class AntecedenteJudicialType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('realizoDenuncia', CheckboxType::class, array(
                'label' => '¿Realizó la denuncia?',
                'data' => false
                ))
        ->add('fechaRealizoDenuncia', DateType::class, array(
                'widget' => 'single_text',
                'label' => '¿Cuándo? '))
        ->add('obsRealizoDenuncia', TextType::class ,array(
                'required'   => false,
                'attr' => array(
                     'placeholder' => 'Observaciones',
                ),
                'label'  => false))
        ->add('denunciaPrevia', CheckboxType::class, array(
                    'label' => '¿Hay denuncias previas?',
                    'data' => false
                    ))
        ->add('obsDenunciaPrevia',TextType::class, array(
                'required'   => false,
                'attr' => array(
                     'placeholder' => 'Observaciones',
                ),
                'label'  => ': '))
        ->add('poseeAbogado', CheckboxType::class, array(
            'label' => '¿Tiene abogadx?',
            'data' => false
            ))
        ->add('tipoAbogado', EntityType::class, array(
            'class' => 'AppBundle:TipoAbogado',
            'query_builder' => function ($tipoAbogado) {
              return $tipoAbogado->createQueryBuilder('a')
                ->where('a.activo = 1');
            },
            'choice_label' => function ($tipoAbogado){
                return $tipoAbogado->getDescripcion();
            },
            'expanded'  => false,
            'multiple'  => false,
            'attr' => array('class' => 'btn btn-outline-gray'),
            'label' => false))
        ->add('observacion_abogado', TextareaType::class, array(
          'required'   => false,
          'attr' => array(
               'placeholder' => 'Observaciones','class' => 'form-control','rows'=>"1"
          ),
          'label'  => false));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\AntecedenteJudicial'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_antecedentejudicial';
    }


}
