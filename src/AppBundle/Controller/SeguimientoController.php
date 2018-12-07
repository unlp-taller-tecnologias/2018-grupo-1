<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Seguimiento;
use AppBundle\Entity\Expediente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Seguimiento controller.
 *
 * @Route("seguimiento")
 */
class SeguimientoController extends Controller
{
    /**
     * Lists all seguimiento entities.
     *
     * @Route("/index/{expediente}", name="seguimiento_index")
     * @Method("GET")
     */
    public function indexAction($expediente){
        $repository = $this->getDoctrine()->getRepository(Seguimiento::class);
        $seguimientos = $repository->findBy(array('expediente'=>$expediente));
        return $this->render('seguimiento/index.html.twig', array(
            'seguimientos' => $seguimientos,
            'expediente' => $expediente,
        ));
    }

    /**
     * Creates a new seguimiento entity.
     *
     * @Route("/new/{id}", name="seguimiento_new")
     * @Method({"GET"})
     */
    public function newAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository(Expediente::class);
        $expediente = $repository->find($id);
        $seguimiento = new Seguimiento();
        $seguimiento->setExpediente($expediente);
        $seguimiento->setFecha(new \DateTime());
        $form = $this->createForm('AppBundle\Form\SeguimientoType', $seguimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $expediente->addSeguimiento($seguimiento);
            $em = $this->getDoctrine()->getManager();
            $em->persist($seguimiento);
            $em->flush();

            return $this->redirectToRoute('seguimiento_show', array('id' => $seguimiento->getId()));
        }

        return $this->render('seguimiento/new.html.twig', array(
            'expediente' => $expediente,
            'seguimiento' => $seguimiento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a seguimiento entity.
     *
     * @Route("/{id}", name="seguimiento_show")
     * @Method("GET")
     */
    public function showAction(Seguimiento $seguimiento)
    {
        return $this->render('seguimiento/show.html.twig', array(
            'seguimiento' => $seguimiento,
        ));
    }

    /**
     * Displays a form to edit an existing seguimiento entity.
     *
     * @Route("/{id}/edit", name="seguimiento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Seguimiento $seguimiento){
        $editForm = $this->createForm('AppBundle\Form\SeguimientoType', $seguimiento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seguimiento_index', array('expediente' => $seguimiento->getExpediente()->getId()));
        }
        return $this->render('seguimiento/edit.html.twig', array(
            'seguimiento' => $seguimiento,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a seguimiento entity.
     *
     * @Route("/delete/{id}", name="seguimiento_delete")
     * @Method("DELETE")
     */
    public function deleteAction($id){
      $em = $this->getDoctrine()->getManager();
      $seguimiento = $em->getRepository('AppBundle:Seguimiento')->findOneBy(array('id'=> $id));
      $expedienteId = $seguimiento->getExpediente()->getId();
      $em->remove($seguimiento);
      $em->flush();
      return $this->indexAction($expedienteId);
    }
}
