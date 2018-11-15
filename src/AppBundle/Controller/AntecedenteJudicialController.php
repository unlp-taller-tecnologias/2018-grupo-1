<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AntecedenteJudicial;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Antecedentejudicial controller.
 *
 * @Route("antecedentejudicial")
 */
class AntecedenteJudicialController extends Controller
{
    /**
     * Lists all antecedenteJudicial entities.
     *
     * @Route("/", name="antecedentejudicial_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $antecedenteJudicials = $em->getRepository('AppBundle:AntecedenteJudicial')->findAll();

        return $this->render('antecedentejudicial/index.html.twig', array(
            'antecedenteJudicials' => $antecedenteJudicials,
        ));
    }

    /**
     * Creates a new antecedenteJudicial entity.
     *
     * @Route("/new", name="antecedentejudicial_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $antecedenteJudicial = new Antecedentejudicial();
        $form = $this->createForm('AppBundle\Form\AntecedenteJudicialType', $antecedenteJudicial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($antecedenteJudicial);
            $em->flush();

            return $this->redirectToRoute('antecedentejudicial_show', array('id' => $antecedenteJudicial->getId()));
        }

        return $this->render('antecedentejudicial/new.html.twig', array(
            'antecedenteJudicial' => $antecedenteJudicial,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a antecedenteJudicial entity.
     *
     * @Route("/{id}", name="antecedentejudicial_show")
     * @Method("GET")
     */
    public function showAction(AntecedenteJudicial $antecedenteJudicial)
    {
        $deleteForm = $this->createDeleteForm($antecedenteJudicial);

        return $this->render('antecedentejudicial/show.html.twig', array(
            'antecedenteJudicial' => $antecedenteJudicial,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing antecedenteJudicial entity.
     *
     * @Route("/{id}/edit", name="antecedentejudicial_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AntecedenteJudicial $antecedenteJudicial)
    {
        $deleteForm = $this->createDeleteForm($antecedenteJudicial);
        $editForm = $this->createForm('AppBundle\Form\AntecedenteJudicialType', $antecedenteJudicial);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('antecedentejudicial_edit', array('id' => $antecedenteJudicial->getId()));
        }

        return $this->render('antecedentejudicial/edit.html.twig', array(
            'antecedenteJudicial' => $antecedenteJudicial,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a antecedenteJudicial entity.
     *
     * @Route("/{id}", name="antecedentejudicial_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AntecedenteJudicial $antecedenteJudicial)
    {
        $form = $this->createDeleteForm($antecedenteJudicial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($antecedenteJudicial);
            $em->flush();
        }

        return $this->redirectToRoute('antecedentejudicial_index');
    }

    /**
     * Creates a form to delete a antecedenteJudicial entity.
     *
     * @param AntecedenteJudicial $antecedenteJudicial The antecedenteJudicial entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AntecedenteJudicial $antecedenteJudicial)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('antecedentejudicial_delete', array('id' => $antecedenteJudicial->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
