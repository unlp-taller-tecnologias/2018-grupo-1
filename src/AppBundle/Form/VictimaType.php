<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use AppBundle\Entity\TipoDocumento;
use AppBundle\Entity\Nacion;
use AppBundle\Entity\Provincia;
use AppBundle\Entity\Localidad;
use AppBundle\Entity\Barrio;
use AppBundle\Entity\EstadoCivil;
use AppBundle\Form\ExpedienteType;

class VictimaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('expediente',  ExpedienteType::class)
        ->add('nombre')->add('apellido')
        ->add('fechaNac', BirthdayType::class)
        // ->add('nacion', EntityType::class, array(
        //     'label'    => 'Nacionalidad:',
        //     'required' => false,
        //     'class' => 'AppBundle:Nacion',
        //     'choice_label' => function ($nacion){
        //         return $nacion->getNombre();},           
        //     ))
        ->add('nacion', CountryType::class)
        ->add('tipoDocumento', EntityType::class, array(
            'label'    => 'Tipo de documento:',
            'required' => false,
            'class' => 'AppBundle:TipoDocumento',
            'choice_label' => function ($tipoDocumento){
                return $tipoDocumento->getDescripcion();},           
            ))
        ->add('nroDocumento')->add('calle')->add('numero')->add('piso')->add('depto')->add('otros')
        ->add('provincia', EntityType::class, array(
            'label'    => 'Provincia:',
            'required' => false,
            'class' => 'AppBundle:Provincia',
            'choice_label' => function ($provincia){
                return $provincia->getNombre();},           
            ))
        ->add('localidad', EntityType::class, array(
            'label'    => 'Localidad:',
            'required' => false,
            'class' => 'AppBundle:Localidad',
            'choice_label' => function ($localidad){
                return $localidad->getNombre();},          
            ))
        ->add('barrio', EntityType::class, array(
            'label'    => 'Barrio:',
            'required' => false,
            'class' => 'AppBundle:Barrio',
            'choice_label' => function ($barrio){
                return $barrio->getNombre();},          
            ))
        ->add('email')->add('poseeDineroPropio')->add('obserDineroPropio')->add('poseePlanSocial')->add('obserPlanSocial')->add('poseeViviendaPropia')->add('obserViviendaPropia')
        ->add('telefonos', TelType::class)
        ->add('telefonoSeguro', TelType::class)
        ->add('estadoCivil', EntityType::class, array(
            'label'    => 'Estado civil:',
            'required' => false,
            'class' => 'AppBundle:EstadoCivil',
            'choice_label' => function ($estadoCivil){
                return $estadoCivil->getDescripcion();},          
            ));

        
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Victima'
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
