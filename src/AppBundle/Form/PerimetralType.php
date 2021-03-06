<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PerimetralType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       //$expediente = $options['expediente'];
        //$evaluacionesRiesgo = $expediente->getVictima()->getEvaluacionesDeRiesgo();
        $builder->add('fecha', DateType::class, array(
                'widget' => 'single_text',
                'label' => 'Fecha en que se ordenó'
              ))
                ->add('vencimiento', DateType::class, array(
                'widget' => 'single_text',
                'label' => 'Vencimiento de la medida'
              ))
                ->add('vigencia', DateType::class, array(
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Plazo de vigencia de la medida'
              ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Perimetral'

        ));

        //$resolver -> setRequired('expediente');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_perimetral';
    }


}
