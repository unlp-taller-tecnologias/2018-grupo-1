<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Perimetral;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(){
      $em = $this->getDoctrine()->getManager();
      $diasPerimetral = $em->getRepository('AppBundle:Configuracion')->findOneBy(array('nombre' => 'diasPerimetral'));
      $medidasVencer = 0;
      $repository = $this->getDoctrine()->getRepository(Perimetral::class);
      $medidasVencidas= count($repository->getVencidas());
      $medidasVencer=count($repository->getVencer($diasPerimetral->getValor()));
      return $this->render('templates/index.html.twig', array('medidasVencidas'=> $medidasVencidas, 'medidasVencer' => $medidasVencer ));
    }


}
