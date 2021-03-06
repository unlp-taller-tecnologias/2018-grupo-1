<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Juzgado;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class IntervencionFamiliaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('juzgado', EntityType::class, array(
            'placeholder' => 'Seleccione un juzgado',
            'class' => 'AppBundle:Juzgado',
            'query_builder' => function ($juzgado) {
              return $juzgado->createQueryBuilder('j')
                ->where('j.activo = 1');
            },
            'choice_label' => function ($juzgado){
                return $juzgado->getDescripcion();
            }));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\IntervencionFamilia'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_intervencionfamilia';
    }


}
