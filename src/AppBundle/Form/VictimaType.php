<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use AppBundle\Form\EvaluacionRiesgoType;
use AppBundle\Form\VinculoSignificativoType;
use AppBundle\Entity\TipoDocumento;
use AppBundle\Entity\Nacion;
use AppBundle\Entity\Provincia;
use AppBundle\Entity\Localidad;
use AppBundle\Entity\Barrio;
use AppBundle\Entity\EstadoCivil;
use AppBundle\Form\TelefonoType;

class VictimaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombre', TextType::class, array('label' => 'Nombre','attr' => array('class' => 'form-control')))
        ->add('apellido', TextType::class, array('label' => 'Apellido','attr' => array('class' => 'form-control')))
        ->add('fechaNac', DateType::class, array(
                'label' => 'Fecha de nacimiento',
                'attr' => array('class' => 'form-control'),
                'widget' => 'single_text'))
        ->add('tipoDocumento', EntityType::class, array(
            'label'    => 'Tipo de documento:',
            'required' => false,
            'attr' => array('class' => 'form-control'),
            'placeholder' => 'Elija una opción',
            'class' => 'AppBundle:TipoDocumento',
            'query_builder' => function ($tipoDocumento) {
              return $tipoDocumento->createQueryBuilder('t')
                ->where('t.activo = 1');
            },
            'choice_label' => function ($tipoDocumento){
                return $tipoDocumento->getDescripcion();},
            ))
        ->add('nroDocumento', TextType::class, array(
          'label' => 'N° de documento',
          'attr' => array('class' => 'form-control')))
        ->add('calle', TextType::class, array('label' => 'Calle','attr' => array('class' => 'form-control')))
        ->add('numero', TextType::class, array('label' => 'N°','attr' => array('class' => 'form-control')))
        ->add('piso', TextType::class, array('label' => 'Piso','attr' => array('class' => 'form-control')))
        ->add('depto', TextType::class, array('label' => 'Dpto','attr' => array('class' => 'form-control')))
        ->add('otros', TextType::class, array('label' => 'Otros','attr' => array('class' => 'form-control')))
        ->add('nacion', CountryType::class, array(
            'label' => 'Nacionalidad',
            'attr' => array('class' => 'form-control')))
        ->add('provincia', EntityType::class, array(
            'label'    => 'Provincia',
            'required' => false,
            'attr' => array('class' => 'form-control'),
            'class' => 'AppBundle:Provincia',
            'choice_label' => function ($provincia){
                return $provincia->getNombre();},
            ))
        ->add('localidad', EntityType::class, array(
            'label'    => 'Localidad',
            'required' => false,
            'attr' => array('class' => 'form-control'),
            'class' => 'AppBundle:Localidad',
            'choice_label' => function ($localidad){
                return $localidad->getNombre();},
            ))
        ->add('barrio', EntityType::class, array(
            'label'    => 'Barrio',
            'required' => false,
            'attr' => array('class' => 'form-control'),
            'class' => 'AppBundle:Barrio',
            'choice_label' => function ($barrio){
                return $barrio->getNombre();},
            ))
        ->add('email', EmailType::class, array('label' => 'E-mail','attr' => array('class' => 'form-control')))
        ->add('poseeDineroPropio', CheckboxType::class, array('label' => 'Dinero propio'))
        ->add('obserDineroPropio', TextType::class, array('label' => 'Observacion','attr' => array('class' => 'form-control')))
        ->add('poseePlanSocial', CheckboxType::class, array('label' => 'Plan social'))
        ->add('obserPlanSocial', TextType::class, array('label' => 'Observacion','attr' => array('class' => 'form-control')))
        ->add('poseeViviendaPropia', CheckboxType::class, array('label' => 'Vivienda propia'))
        ->add('obserViviendaPropia', TextType::class, array('label' => 'Observacion','attr' => array('class' => 'form-control')))
        ->add('telefonoSeguro', TelefonoType::class, array('label' => 'Teléfono seguro','attr' => array('class' => 'form-control')))
        ->add('estadoCivil', EntityType::class, array(
            'label'    => 'Estado civil:',
            'required' => false,
            'attr' => array('class' => 'form-control'),
            'placeholder' => 'Elija una opción',
            'class' => 'AppBundle:EstadoCivil',
            'query_builder' => function ($estadoCivil) {
              return $estadoCivil->createQueryBuilder('e')
                ->where('e.activo = 1');
            },
            'choice_label' => function ($estadoCivil){
                return $estadoCivil->getDescripcion();},
            ));
        $builder->add('telefonos', CollectionType::class, array(
            'entry_type' => TelefonoType::class,
            'entry_options' => array('label' => false),
            'allow_add' => true,
            'by_reference' => false,
            'prototype' => true,
            //'prototype_data' => 'Ingrese un telefono',
        ))
        ->add('vinculosSignificativos', CollectionType::class, array(
            'entry_type' => VinculoSignificativoType::class,
            'entry_options' => array('label' => true),
            'allow_add' => true ,
            'by_reference' => false,
            'prototype' => true,
            //'prototype_data' => 'New Tag Placeholder',
        ))
        ->add('evaluacionesDeRiesgo', CollectionType::class, array(
            'entry_type' => EvaluacionRiesgoType::class,
            'entry_options' => array('label' => false),
            'allow_add' => true ,
            'by_reference' => false,
        ));

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Victima',
            'required' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_victima';
    }


}
