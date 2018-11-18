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
    public function indexAction(Request $request)
    {
      $repository = $this->getDoctrine()->getRepository(Perimetral::class);
      $medidasVencidas= count($repository->getVencidas());
      $medidasVencer=count($repository->getVencer(5));
     return $this->render('default/index.html.twig', array('medidasVencidas'=> $medidasVencidas, 'medidasVencer' => $medidasVencer ));
    }


}
