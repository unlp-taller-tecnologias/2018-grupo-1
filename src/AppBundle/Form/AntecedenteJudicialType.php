<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\TipoAbogado;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
        $builder->add('realizoDenuncia', ChoiceType::class, array(
                    'choices' => array(
                            'No' => false,
                            'Sí' => true,
                            ),
                    'label' => '¿Realizó la denuncia?',
                    'expanded'  => true,
                    'multiple'  => false,
                    'data' => false
                    ))
        ->add('fechaRealizoDenuncia' ,DateType::class, array(
                'widget' => 'single_text',
                'label' => '¿Cuándo? '))
        ->add('obsRealizoDenuncia',TextType::class ,array(
                'label'  => ': '))
        ->add('denunciaPrevia', ChoiceType::class, array(
                    'choices' => array(
                            'No' => false,
                            'Sí' => true,
                            ),
                    'label' => '¿Hay denuncias previas?',
                    'expanded'  => true,
                    'multiple'  => false,
                    'data' => false
                    ))
        ->add('obsDenunciaPrevia',TextType::class, array(
            'label'  => ': '))
        ->add('poseeAbogado', ChoiceType::class, array(
            'choices' => array(
                    'No' => false,
                    'Sí' => true,
                    ),
            'label' => '¿Tiene abogadx?',
            'expanded'  => true,
            'multiple'  => false,
            'data' => false
            ))
        ->add('tipoAbogado', EntityType::class, array(
            'class' => 'AppBundle:TipoAbogado',
            'choice_label' => function ($tipoAbogado){
                return $tipoAbogado->getDescripcion();
            },
            'expanded'  => true,
            'multiple'  => false,
            'label' => ''))
        ->add('observacion_abogado', TextareaType::class, array(
                'label' => 'Observaciones:'));
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
