<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Hogar;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Hogar controller.
 *
 * @Route("hogar")
 */
class HogarController extends Controller
{
    /**
     * Lists all hogar entities.
     *
     * @Route("/", name="hogar_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $hogars = $em->getRepository('AppBundle:Hogar')->findAll();

        return $this->render('hogar/index.html.twig', array(
            'hogars' => $hogars,
        ));
    }

    /**
     * Creates a new hogar entity.
     *
     * @Route("/new", name="hogar_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $hogar = new Hogar();
        $form = $this->createForm('AppBundle\Form\HogarType', $hogar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hogar);
            $em->flush();

            return $this->redirectToRoute('hogar_show', array('id' => $hogar->getId()));
        }

        return $this->render('hogar/new.html.twig', array(
            'hogar' => $hogar,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a hogar entity.
     *
     * @Route("/{id}", name="hogar_show")
     * @Method("GET")
     */
    public function showAction(Hogar $hogar)
    {
        $deleteForm = $this->createDeleteForm($hogar);

        return $this->render('hogar/show.html.twig', array(
            'hogar' => $hogar,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing hogar entity.
     *
     * @Route("/{id}/edit", name="hogar_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Hogar $hogar)
    {
        $deleteForm = $this->createDeleteForm($hogar);
        $editForm = $this->createForm('AppBundle\Form\HogarType', $hogar);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hogar_edit', array('id' => $hogar->getId()));
        }

        return $this->render('hogar/edit.html.twig', array(
            'hogar' => $hogar,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a hogar entity.
     *
     * @Route("/{id}", name="hogar_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Hogar $hogar)
    {
        $form = $this->createDeleteForm($hogar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hogar);
            $em->flush();
        }

        return $this->redirectToRoute('hogar_index');
    }

    /**
     * Creates a form to delete a hogar entity.
     *
     * @param Hogar $hogar The hogar entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Hogar $hogar)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('hogar_delete', array('id' => $hogar->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
