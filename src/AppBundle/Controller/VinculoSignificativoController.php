<?php

namespace AppBundle\Controller;

use AppBundle\Entity\VinculoSignificativo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Vinculosignificativo controller.
 *
 * @Route("vinculosignificativo")
 */
class VinculoSignificativoController extends Controller
{
    /**
     * Lists all vinculoSignificativo entities.
     *
     * @Route("/", name="vinculosignificativo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vinculoSignificativos = $em->getRepository('AppBundle:VinculoSignificativo')->findAll();

        return $this->render('vinculosignificativo/index.html.twig', array(
            'vinculoSignificativos' => $vinculoSignificativos,
        ));
    }

    /**
     * Creates a new vinculoSignificativo entity.
     *
     * @Route("/new", name="vinculosignificativo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $vinculoSignificativo = new Vinculosignificativo();
        $form = $this->createForm('AppBundle\Form\VinculoSignificativoType', $vinculoSignificativo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vinculoSignificativo);
            $em->flush();

            return $this->redirectToRoute('vinculosignificativo_show', array('id' => $vinculoSignificativo->getId()));
        }

        return $this->render('vinculosignificativo/new.html.twig', array(
            'vinculoSignificativo' => $vinculoSignificativo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a vinculoSignificativo entity.
     *
     * @Route("/{id}", name="vinculosignificativo_show")
     * @Method("GET")
     */
    public function showAction(VinculoSignificativo $vinculoSignificativo)
    {
        $deleteForm = $this->createDeleteForm($vinculoSignificativo);

        return $this->render('vinculosignificativo/show.html.twig', array(
            'vinculoSignificativo' => $vinculoSignificativo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing vinculoSignificativo entity.
     *
     * @Route("/{id}/edit", name="vinculosignificativo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, VinculoSignificativo $vinculoSignificativo)
    {
        $deleteForm = $this->createDeleteForm($vinculoSignificativo);
        $editForm = $this->createForm('AppBundle\Form\VinculoSignificativoType', $vinculoSignificativo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vinculosignificativo_edit', array('id' => $vinculoSignificativo->getId()));
        }

        return $this->render('vinculosignificativo/edit.html.twig', array(
            'vinculoSignificativo' => $vinculoSignificativo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a vinculoSignificativo entity.
     *
     * @Route("/{id}", name="vinculosignificativo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, VinculoSignificativo $vinculoSignificativo)
    {
        $form = $this->createDeleteForm($vinculoSignificativo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vinculoSignificativo);
            $em->flush();
        }

        return $this->redirectToRoute('vinculosignificativo_index');
    }

    /**
     * Creates a form to delete a vinculoSignificativo entity.
     *
     * @param VinculoSignificativo $vinculoSignificativo The vinculoSignificativo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VinculoSignificativo $vinculoSignificativo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vinculosignificativo_delete', array('id' => $vinculoSignificativo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
