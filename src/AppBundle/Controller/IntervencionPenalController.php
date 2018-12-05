<?php

namespace AppBundle\Controller;

use AppBundle\Entity\IntervencionPenal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Intervencionpenal controller.
 *
 * @Route("intervencionpenal")
 */
class IntervencionPenalController extends Controller
{
    /**
     * Lists all intervencionPenal entities.
     *
     * @Route("/", name="intervencionpenal_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $intervencionPenals = $em->getRepository('AppBundle:IntervencionPenal')->findAll();

        return $this->render('intervencionpenal/index.html.twig', array(
            'intervencionPenals' => $intervencionPenals,
        ));
    }

    /**
     * Creates a new intervencionPenal entity.
     *
     * @Route("/new", name="intervencionpenal_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $intervencionPenal = new Intervencionpenal();
        $form = $this->createForm('AppBundle\Form\IntervencionPenalType', $intervencionPenal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($intervencionPenal);
            $em->flush();

            return $this->redirectToRoute('intervencionpenal_show', array('id' => $intervencionPenal->getId()));
        }

        return $this->render('intervencionpenal/new.html.twig', array(
            'intervencionPenal' => $intervencionPenal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a intervencionPenal entity.
     *
     * @Route("/{id}", name="intervencionpenal_show")
     * @Method("GET")
     */
    public function showAction(IntervencionPenal $intervencionPenal)
    {
        $deleteForm = $this->createDeleteForm($intervencionPenal);

        return $this->render('intervencionpenal/show.html.twig', array(
            'intervencionPenal' => $intervencionPenal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing intervencionPenal entity.
     *
     * @Route("/{id}/edit", name="intervencionpenal_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, IntervencionPenal $intervencionPenal)
    {
        $deleteForm = $this->createDeleteForm($intervencionPenal);
        $editForm = $this->createForm('AppBundle\Form\IntervencionPenalType', $intervencionPenal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('intervencionpenal_edit', array('id' => $intervencionPenal->getId()));
        }

        return $this->render('intervencionpenal/edit.html.twig', array(
            'intervencionPenal' => $intervencionPenal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a intervencionPenal entity.
     *
     * @Route("/{id}", name="intervencionpenal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, IntervencionPenal $intervencionPenal)
    {
        $form = $this->createDeleteForm($intervencionPenal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($intervencionPenal);
            $em->flush();
        }

        return $this->redirectToRoute('intervencionpenal_index');
    }

    /**
     * Creates a form to delete a intervencionPenal entity.
     *
     * @param IntervencionPenal $intervencionPenal The intervencionPenal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(IntervencionPenal $intervencionPenal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('intervencionpenal_delete', array('id' => $intervencionPenal->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
