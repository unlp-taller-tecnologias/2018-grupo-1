<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Perimetral;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Perimetral controller.
 *
 * @Route("perimetral")
 */
class PerimetralController extends Controller
{
    /**
     * Lists all perimetral vencidas.
     *
     * @Route("/vencidas", name="perimetralVencidas")
     * @Method("GET")
     */
    public function listVencidas()
    {
      $repository = $this->getDoctrine()->getRepository(Perimetral::class);
      $perimetralesVencidas=$repository->expedientesPerimetralesVencidas();
      return $this->render('perimetral/index.html.twig', array(
          'perimetrales' => $perimetralesVencidas, 'titulo'=>'perimetrales vencidas'
      ));
    }

    /**
     * Lists all perimetral a vencer.
     *
     * @Route("/aVencer", name="perimetralAvencer")
     * @Method("GET")
     */
    public function listAvencer()
    {
      $em = $this->getDoctrine()->getManager();
      $diasPerimetral = $em->getRepository('AppBundle:VencimientoPerimetral')->findOneBy([]);
      $repository = $this->getDoctrine()->getRepository(Perimetral::class);
      $perimetralesVencidas=$repository->expedientesPerimetralesPorVencer($diasPerimetral->getDiasNotificacion());
      return $this->render('perimetral/index.html.twig', array(
          'perimetrales' => $perimetralesVencidas, 'titulo'=>'perimetrales por vencer'
      ));
    }
}
