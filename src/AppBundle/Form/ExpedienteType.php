<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\IntervencionRealizada;
use AppBundle\Entity\RazonConsulta; 




class ExpedienteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nroExp')
        ->add('usuarios', EntityType::class, array(
            'label'    => 'Entrevistó:',
            'required' => true,
            'class' => 'AppBundle:Usuario',
            'choice_label' => function ($usuario){
                return $usuario->getNombre();}, 
            'expanded'  => true,
            'multiple'  => true,          
            ))
        ->add('razonConsulta', EntityType::class, array(
            'class' => 'AppBundle:RazonConsulta',
            'label' => '¿Por qué consulta?',
            'choice_label' => function ($razonConsulta){
                return $razonConsulta->getDescripcion();
            }))
        ->add('derivacion') 
        ->add('observacion', TextareaType::class)
        ->add('intervencionesRealizadas', EntityType::class, array(
            'label'    => 'Intervenciones realizadas: ',
            'required' => false,
            'class' => 'AppBundle:IntervencionRealizada',
            'choice_label' => function ($intervencion){
                return $intervencion->getDescripcion();},
            'expanded'  => true,
            'multiple'  => true,
            ))
        ->add('resumen', TextareaType::class);


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Expediente'
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
