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
     * @Route("/", name="perimetralVencidas")
     * @Method("GET")
     */
    public function listVencidas()
    {
      $repository = $this->getDoctrine()->getRepository(Perimetral::class);
      $medidasVencidas=$repository->getVencidas();

      return $this->render('perimetral/index.html.twig', array(
          'medidasVencidas' => $tipoAbogados,
      ));
    }

}
