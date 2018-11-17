<?php 

namespace AppBundle\Form;

use AppBundle\Entity\EstadoCivil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FormLogin extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login')
            ->add('dni', TextareaType::class)
            ->add('password', PasswordType::class)
            ->add('submit', SubmitType::class, array(
            'label' => 'Aceptar',
            'attr'  => array('class' => 'btn btn-violet pull-right')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Post::class,
        ));
    }
}

?>