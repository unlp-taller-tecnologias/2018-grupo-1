<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Configuracion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Configuracion controller.
 *
 * @Route("configuracion")
 */
class ConfiguracionController extends Controller {

    /**
     * @Route("/")
     */
    public function configuracion(){
      return $this->render('configuracion/configuracion.html.twig', array());
    }

    /**
     * @Route("/diasPerimetral")
     */
    public function indexAction(Request $request){
      $em = $this->getDoctrine()->getManager();
      $diasPerimetral = $em->getRepository('AppBundle:VencimientoPerimetral')->findOneBy([]);
      $diasPerimetral->setDiasNotificacion($diasPerimetral->getDiasNotificacion());
      $form = $this->createFormBuilder($diasPerimetral)
        ->add('diasNotificacion',NumberType::class, array('label' => 'Cantidad de días','attr' => array('class' => 'form-control','min'=>'1', 'max'=>'90', 'required')))
        ->add('guardar',SubmitType::class, array('label' => 'Aceptar','attr'  => array('class' => 'btn btn-violet pull-right')))
        ->getForm();
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $dias = $form['diasNotificacion']->getData();
        $diasPerimetral->setDiasNotificacion($dias);
        $em->flush();
        $this->addFlash(
          'notice','Modificación exitosa'
        );
        return $this->configuracion();
      }
      return $this->render('configuracion/configuracionPerimetral.html.twig', array('form' => $form->createView(),
          'dias' => $diasPerimetral->getDiasNotificacion()
      ));
    }

}
