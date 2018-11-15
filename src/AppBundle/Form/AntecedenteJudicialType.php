<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\TipoAbogado;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class AntecedenteJudicialType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('realizoDenuncia')->add('fechaRealizoDenuncia')->add('obsRealizoDenuncia')->add('denunciaPrevia')->add('obsDenunciaPrevia')->add('observacion_abogado')->add('tipoAbogado', EntityType::class, array(
            'class' => 'AppBundle:TipoAbogado',
            'choice_label' => function ($tipoAbogado){
                return $tipoAbogado->getDescripcion();
            }));
        // ->add('evaluacionesDeRiesgo');
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
