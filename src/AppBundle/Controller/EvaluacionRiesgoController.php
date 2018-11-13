<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EvaluacionRiesgo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Evaluacionriesgo controller.
 *
 * @Route("evaluacionriesgo")
 */
class EvaluacionRiesgoController extends Controller
{
    /**
     * Lists all evaluacionRiesgo entities.
     *
     * @Route("/", name="evaluacionriesgo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $evaluacionRiesgos = $em->getRepository('AppBundle:EvaluacionRiesgo')->findAll();

        return $this->render('evaluacionriesgo/index.html.twig', array(
            'evaluacionRiesgos' => $evaluacionRiesgos,
        ));
    }

    /**
     * Creates a new evaluacionRiesgo entity.
     *
     * @Route("/new", name="evaluacionriesgo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $evaluacionRiesgo = new Evaluacionriesgo();
        $form = $this->createForm('AppBundle\Form\EvaluacionRiesgoType', $evaluacionRiesgo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evaluacionRiesgo);
            $em->flush();

            return $this->redirectToRoute('evaluacionriesgo_show', array('id' => $evaluacionRiesgo->getId()));
        }

        return $this->render('evaluacionriesgo/new.html.twig', array(
            'evaluacionRiesgo' => $evaluacionRiesgo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a evaluacionRiesgo entity.
     *
     * @Route("/{id}", name="evaluacionriesgo_show")
     * @Method("GET")
     */
    public function showAction(EvaluacionRiesgo $evaluacionRiesgo)
    {
        $deleteForm = $this->createDeleteForm($evaluacionRiesgo);

        return $this->render('evaluacionriesgo/show.html.twig', array(
            'evaluacionRiesgo' => $evaluacionRiesgo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing evaluacionRiesgo entity.
     *
     * @Route("/{id}/edit", name="evaluacionriesgo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EvaluacionRiesgo $evaluacionRiesgo)
    {
        $deleteForm = $this->createDeleteForm($evaluacionRiesgo);
        $editForm = $this->createForm('AppBundle\Form\EvaluacionRiesgoType', $evaluacionRiesgo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evaluacionriesgo_edit', array('id' => $evaluacionRiesgo->getId()));
        }

        return $this->render('evaluacionriesgo/edit.html.twig', array(
            'evaluacionRiesgo' => $evaluacionRiesgo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a evaluacionRiesgo entity.
     *
     * @Route("/{id}", name="evaluacionriesgo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EvaluacionRiesgo $evaluacionRiesgo)
    {
        $form = $this->createDeleteForm($evaluacionRiesgo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evaluacionRiesgo);
            $em->flush();
        }

        return $this->redirectToRoute('evaluacionriesgo_index');
    }

    /**
     * Creates a form to delete a evaluacionRiesgo entity.
     *
     * @param EvaluacionRiesgo $evaluacionRiesgo The evaluacionRiesgo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EvaluacionRiesgo $evaluacionRiesgo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evaluacionriesgo_delete', array('id' => $evaluacionRiesgo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
