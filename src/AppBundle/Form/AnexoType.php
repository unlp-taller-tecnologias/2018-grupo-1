<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Categoria;

class AnexoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('path', FileType::class, array(
            'label'    => 'Seleccionar archivo',
            'required' => true))
        ->add('categoria', EntityType::class, array(
            'label'    => 'Categoría',
            'required' => true,
            'class' => 'AppBundle:Categoria',
            'query_builder' => function ($categoria) {
              return $categoria->createQueryBuilder('c')
                ->where('c.activo = 1');
            },
            'choice_label' => function ($categoria){
                return $categoria->getDescripcion();},
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Anexo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_anexo';
    }


}
