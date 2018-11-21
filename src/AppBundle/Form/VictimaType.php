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
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        ->add('nombre', TextType::class, array('attr' => array('class' => 'col-md-2',),))
        ->add('apellido', TextType::class, array('attr' => array('class' => 'col-md-2',),))
        ->add('fechaNac', BirthdayType::class)
        ->add('tipoDocumento', EntityType::class, array(
            'label'    => 'Tipo de documento:',
            'required' => false,
            'class' => 'AppBundle:TipoDocumento',
            'choice_label' => function ($tipoDocumento){
                return $tipoDocumento->getDescripcion();},
            ))
        ->add('nroDocumento')
        ->add('calle')
        ->add('numero')
        ->add('piso')
        ->add('depto')
        ->add('otros')
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
        ->add('email')
        ->add('poseeDineroPropio')
        ->add('obserDineroPropio')
        ->add('poseePlanSocial')
        ->add('obserPlanSocial')
        ->add('poseeViviendaPropia')
        ->add('obserViviendaPropia')
        ->add('nacion', CountryType::class)
        ->add('estadoCivil', EntityType::class, array(
            'label'    => 'Estado civil:',
            'required' => false,
            'class' => 'AppBundle:EstadoCivil',
            'choice_label' => function ($estadoCivil){
                return $estadoCivil->getDescripcion();},          
            ))
        ->add('telefonoSeguro', TelefonoType::class);
        $builder->add('telefonos', CollectionType::class, array(
            'entry_type' => TelefonoType::class,
            'entry_options' => array('label' => false),
            'allow_add' => true,
            'by_reference' => false,
            //'prototype' => true,
            //'prototype_data' => 'Ingrese un telefono',
        ))
        ->add('vinculosSignificativos', CollectionType::class, array(
            'entry_type' => VinculoSignificativoType::class,
            'entry_options' => array('label' => true),
            'allow_add' => true ,
            'by_reference' => false,
            //'prototype' => true,
            //'prototype_data' => 'New Tag Placeholder',
        ));

    }
    /**
     * {@inheritdoc}
     */
    // public function buildForm(FormBuilderInterface $builder, array $options)
    // {
    //     $builder
    //     // ->add('evaluacionesDeRiesgo', CollectionType::class, array(
    //     //     'entry_type' => EvaluacionRiesgoType::class,
    //     //     'entry_options' => array('label' => false),
    //     // ))

    // }
    /**
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
