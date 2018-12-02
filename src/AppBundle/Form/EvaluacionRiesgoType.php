<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Form\AgresorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\ViolenciaPadecida;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use AppBundle\Form\AntecedenteJudicialType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class EvaluacionRiesgoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('agresor', AgresorType::class, array(
                'label' => 'DATOS DEL/A AGRESOR/A'))
            ->add('vinculo', TextType::class,  array('label'=>'Vinculo con el agresor'))
            ->add('cantidadTiempoVinculo')
            ->add('unidadTiempoVinculo', ChoiceType::class, array(
                'choices'  => array('Años' => 1, 'Meses' => 2, 'Días' => 3,)))
            ->add('cohabitacion', ChoiceType::class, array(
                'label'=>'Cohabitacion victima/agresor-a',
                'choices'  => array('Si' => true, 'No' => false),
                'expanded'=>true,
                'multiple'=>false,
                // 'attr'=>array('checked'=>'checked')
            ))
            ->add('violenciasPadecidas', EntityType::class, array(
            'label'    => 'Violencia padecida:',
            'required' => false,
            'attr' => array('class' => 'col-md-12'),
            'class' => 'AppBundle:ViolenciaPadecida',
            'choice_label' => function ($violenciaPadecida){
                return $violenciaPadecida->getDescripcion();}, 
            'expanded'  => true,
            'multiple'  => true,          
            ))
            ->add('cantidadTiempoMaltrato')
            ->add('unidadTiempoMaltrato', ChoiceType::class, array(
                'choices'  => array('Años' => 1, 'Meses' => 2,'Días' => 3,)))
            ->add('fechaInicio', DateType::class, array(
                'widget' => 'single_text',))
            ->add('fechaUltimoEpisodio',DateType::class, array(
                'widget' => 'single_text',))
            ->add('descripcionUltimoEpisodio', TextareaType::class, array(
                'label' => 'Descripcion ultimo episodio:', 'attr' => array('class' => 'col-md-12 ','rows'=>"15")))
            ->add('antecedentesJudiciales', CollectionType::class, array(
            'entry_type' => AntecedenteJudicialType::class,
            'entry_options' => array('label' => false),
        ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\EvaluacionRiesgo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_evaluacionriesgo';
    }


}
