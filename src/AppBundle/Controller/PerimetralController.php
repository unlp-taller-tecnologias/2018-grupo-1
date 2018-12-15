<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Perimetral;
use AppBundle\Entity\Expediente;
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
     * Lists all perimetral entities.
     *
     * @Route("/index/{expediente}", name="perimetral_index")
     * @Method("GET")
     */
    public function indexAction(Expediente $expediente){
        $repository = $this->getDoctrine()->getRepository(Perimetral::class);
        $perimetrales = $repository->getPerimetralesPorExpediente($expediente);
        return $this->render('perimetral/index_por_expediente.html.twig', array(
            'perimetrales' => $perimetrales,
            'expediente' => $expediente,
        ));
    }


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
          'perimetrales' => $perimetralesVencidas, 
          'titulo'=>'perimetrales vencidas',
          'metodo' => 'listVencidas'
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
          'perimetrales' => $perimetralesVencidas, 
          'titulo'=>'perimetrales por vencer',
          'metodo' => 'listAvencer'
      ));
    }

    /**
     * Setea una perimetral como resuelta.
     *
     * @Route("/perimetral_resolver/{id}/{metodo}", name="perimetral_resolver")
     * @Method("GET")
     */
    public function resolver(Perimetral $perimetral, $metodo)
    { 
      $em = $this->getDoctrine()->getManager();
      $perimetral->setResuelta(true);
      $em->persist($perimetral);
      $em->flush();
      
      return $this->$metodo;    
    }

    /**
     * Creates a new perimetral entity.
     *
     * @Route("perimetral/new/{id}", name="perimetralNew")
     * @Method({"GET", "POST"})
     */
    public function perimetralNew(Request $request)
    {
        $perimetral = new Perimetral();
        $form = $this->createForm('AppBundle\Form\PerimetralType', $perimetral);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $evaluacion = $expediente->getEvaluacionRiesgo();
            $evaluacion->setPerimetral($perimetral);
            $em->persist($evaluacion);
            $em->flush();

            return $this->redirectToRoute('perimetral_show', array('id' => $perimetral->getId()));
        }

        return $this->render('perimetral/new.html.twig', array(
            'perimetral' => $perimetral,
            'form' => $form->createView(),
        ));
    }

    /**
     * Setea una perimetral como resuelta.
     *
     * @Route("/perimetral_resolver/{id}/{expediente}", name="perimetral_resolver")
     * @Method("GET")
     */
    public function resolverPorExpediente(Perimetral $perimetral, Expediente $expediente)
    { 
      $em = $this->getDoctrine()->getManager();
      $perimetral->setResuelta(true);
      $em->persist($perimetral);
      $em->flush();
      
      return $this->indexAction($expediente);    
    }
}
