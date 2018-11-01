<?php 

namespace AppBundle\Form;

use AppBundle\Entity\EstadoCivil;
use AppBundle\Entity\Profesion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class FormAltaOrden extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', TextType::class)
            ->add('orden', IntegerType::class)
        ;
    }

/*    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Profesion::class,
        ));
    }*/

}

?>