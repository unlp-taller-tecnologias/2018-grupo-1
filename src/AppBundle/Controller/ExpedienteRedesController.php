<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ExpedienteRedes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Expedienterede controller.
 *
 * @Route("expedienteredes")
 */
class ExpedienteRedesController extends Controller
{
    /**
     * Lists all expedienteRede entities.
     *
     * @Route("/", name="expedienteredes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $expedienteRedes = $em->getRepository('AppBundle:ExpedienteRedes')->findAll();

        return $this->render('expedienteredes/index.html.twig', array(
            'expedienteRedes' => $expedienteRedes,
        ));
    }

    /**
     * Creates a new expedienteRede entity.
     *
     * @Route("/new", name="expedienteredes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $expedienteRede = new Expedienterede();
        $form = $this->createForm('AppBundle\Form\ExpedienteRedesType', $expedienteRede);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($expedienteRede);
            $em->flush();

            return $this->redirectToRoute('expedienteredes_show', array('id' => $expedienteRede->getId()));
        }

        return $this->render('expedienteredes/new.html.twig', array(
            'expedienteRede' => $expedienteRede,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a expedienteRede entity.
     *
     * @Route("/{id}", name="expedienteredes_show")
     * @Method("GET")
     */
    public function showAction(ExpedienteRedes $expedienteRede)
    {
        $deleteForm = $this->createDeleteForm($expedienteRede);

        return $this->render('expedienteredes/show.html.twig', array(
            'expedienteRede' => $expedienteRede,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing expedienteRede entity.
     *
     * @Route("/{id}/edit", name="expedienteredes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ExpedienteRedes $expedienteRede)
    {
        $deleteForm = $this->createDeleteForm($expedienteRede);
        $editForm = $this->createForm('AppBundle\Form\ExpedienteRedesType', $expedienteRede);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('expedienteredes_edit', array('id' => $expedienteRede->getId()));
        }

        return $this->render('expedienteredes/edit.html.twig', array(
            'expedienteRede' => $expedienteRede,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a expedienteRede entity.
     *
     * @Route("/{id}", name="expedienteredes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ExpedienteRedes $expedienteRede)
    {
        $form = $this->createDeleteForm($expedienteRede);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($expedienteRede);
            $em->flush();
        }

        return $this->redirectToRoute('expedienteredes_index');
    }

    /**
     * Creates a form to delete a expedienteRede entity.
     *
     * @param ExpedienteRedes $expedienteRede The expedienteRede entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ExpedienteRedes $expedienteRede)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('expedienteredes_delete', array('id' => $expedienteRede->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
