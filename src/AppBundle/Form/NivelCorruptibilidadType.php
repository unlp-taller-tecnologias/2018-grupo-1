<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NivelCorruptibilidadType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', TextType::class)
            ->add('orden', IntegerType::class, array('label' => 'Orden (entre 1 y 99)'))
            ->add('padre', EntityType::class, array(
            'class' => 'AppBundle:NivelCorruptibilidad',
            'label' => 'Es subconsulta de:',
            'required'   => false,
            'attr' => array('class' => 'form-control'),
            'placeholder' => 'Elija una opción si es subconsulta',
            'query_builder' => function ($razonConsulta) {
              return $razonConsulta->createQueryBuilder('r')
                ->where('r.activo = 1 and r.padre IS NULL');
            },
            'choice_label' => function ($razonConsulta){
                return $razonConsulta->getDescripcion();
            }));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\NivelCorruptibilidad'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_nivelcorruptibilidad';
    }


}