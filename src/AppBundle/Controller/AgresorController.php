<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Agresor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Agresor controller.
 *
 * @Route("agresor")
 */
class AgresorController extends Controller
{
    /**
     * Lists all agresor entities.
     *
     * @Route("/", name="agresor_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $agresors = $em->getRepository('AppBundle:Agresor')->findAll();

        return $this->render('agresor/index.html.twig', array(
            'agresors' => $agresors,
        ));
    }

    /**
     * Creates a new agresor entity.
     *
     * @Route("/new", name="agresor_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $agresor = new Agresor();
        $form = $this->createForm('AppBundle\Form\AgresorType', $agresor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agresor);
            $em->flush();

            return $this->redirectToRoute('agresor_show', array('id' => $agresor->getId()));
        }

        return $this->render('agresor/new.html.twig', array(
            'agresor' => $agresor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a agresor entity.
     *
     * @Route("/{id}", name="agresor_show")
     * @Method("GET")
     */
    public function showAction(Agresor $agresor)
    {
        $deleteForm = $this->createDeleteForm($agresor);

        return $this->render('agresor/show.html.twig', array(
            'agresor' => $agresor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing agresor entity.
     *
     * @Route("/{id}/edit", name="agresor_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Agresor $agresor)
    {
        $deleteForm = $this->createDeleteForm($agresor);
        $editForm = $this->createForm('AppBundle\Form\AgresorType', $agresor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agresor_edit', array('id' => $agresor->getId()));
        }

        return $this->render('agresor/edit.html.twig', array(
            'agresor' => $agresor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a agresor entity.
     *
     * @Route("/{id}", name="agresor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Agresor $agresor)
    {
        $form = $this->createDeleteForm($agresor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($agresor);
            $em->flush();
        }

        return $this->redirectToRoute('agresor_index');
    }

    /**
     * Creates a form to delete a agresor entity.
     *
     * @param Agresor $agresor The agresor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Agresor $agresor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agresor_delete', array('id' => $agresor->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
