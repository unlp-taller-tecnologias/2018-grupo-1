<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Redes;


class ExpedienteRedesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        ;
        $builder->add('redesId', ChoiceType::class, array(
                    'choices' => array(
                            'No' => false,
                            'Sí' => true,
                            ),
                    'label' => 'label en el type',
                    'expanded'  => true,
                    'multiple'  => false,
                    'data' => false,
                    ))
        ->add('observacion');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ExpedienteRedes'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_expedienteredes';
    }


}
