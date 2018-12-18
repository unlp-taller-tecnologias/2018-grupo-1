<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Form\AgresorType;
use AppBundle\Form\AntecedenteJudicialType;
use AppBundle\Form\IntervencionPenalType;
use AppBundle\Form\IntervencionFamiliaType;
use AppBundle\Form\Perimetral;
use AppBundle\Entity\ViolenciaPadecida;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;



class EvaluacionRiesgoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('agresor', AgresorType::class, array(
                'label' => 'DATOS DEL/A AGRESOR/A'))
            ->add('vinculo', TextType::class, array('label' => 'Vínculo con el agresor','attr' => array('class' => 'form-control')))
            ->add('cantidadTiempoVinculo', IntegerType::class, array('label' => 'Tiempo vínculo con el agresor','attr' => array('class' => 'form-control')))
            ->add('unidadTiempoVinculo', ChoiceType::class, array(
                'attr' => array('class' => 'btn btn-outline-gray dropdown-toggle'),
                'label' => false,
                'choices'  => array('Años' => 1, 'Meses' => 2, 'Días' => 3)))
            ->add('cohabitacion', CheckboxType::class, array(
                'label'=>'Cohabitación víctima/agresor-a',
                ))
            ->add('violenciasPadecidas', EntityType::class, array(
                'label'    => 'Violencia padecida:',
                'required' => false,
                'attr' => array('class' => 'col-md-12'),
                'class' => 'AppBundle:ViolenciaPadecida',
                'query_builder' => function ($violenciaPadecida) {
                  return $violenciaPadecida->createQueryBuilder('v')
                    ->where('v.activo = 1');
                },
                'choice_label' => function ($violenciaPadecida){
                    return $violenciaPadecida->getDescripcion();},
                'expanded'  => true,
                'multiple'  => true,
                ))
            ->add('cantidadTiempoMaltrato', IntegerType::class, array('label' => 'Tiempo maltrato','attr' => array('class' => 'form-control')))
            ->add('unidadTiempoMaltrato', ChoiceType::class, array(
                'attr' => array('class' => 'btn btn-outline-gray dropdown-toggle'),
                'label' => false,
                'choices'  => array('Años' => 1, 'Meses' => 2,'Días' => 3)))
            ->add('fechaInicio', DateType::class, array(
                'attr' => array('class' => 'form-control'),
                'label' => '¿Cuándo comenzó?',
                'widget' => 'single_text',))
            ->add('fechaUltimoEpisodio',DateType::class, array(
                'attr' => array('class' => 'form-control'),
                'label' => 'Último episodio de violencia',
                'widget' => 'single_text',))
            ->add('descripcionUltimoEpisodio', TextareaType::class, array(
                'label' => 'Descripción del último episodio de violencia',
                'attr' => array('class' => 'form-control','col-md-12 ','rows'=>"15")))
            ->add('antecedentesJudiciales', CollectionType::class, array(
            'entry_type' => AntecedenteJudicialType::class,
            'entry_options' => array('label' => false),))
            ->add('familia', IntervencionFamiliaType::class, array('label' => false))
            ->add('penal', IntervencionPenalType::class, array('label' => false))
            ->add('perimetral', PerimetralType::class, array());
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\EvaluacionRiesgo',
            'required' => false,
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
