<?php

namespace AppBundle\Controller;

use AppBundle\Entity\IntervencionFamilia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Intervencionfamilium controller.
 *
 * @Route("intervencionfamilia")
 */
class IntervencionFamiliaController extends Controller
{
    /**
     * Lists all intervencionFamilium entities.
     *
     * @Route("/", name="intervencionfamilia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $intervencionFamilias = $em->getRepository('AppBundle:IntervencionFamilia')->findAll();

        return $this->render('intervencionfamilia/index.html.twig', array(
            'intervencionFamilias' => $intervencionFamilias,
        ));
    }

    /**
     * Creates a new intervencionFamilium entity.
     *
     * @Route("/new", name="intervencionfamilia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $intervencionFamilium = new Intervencionfamilium();
        $form = $this->createForm('AppBundle\Form\IntervencionFamiliaType', $intervencionFamilium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($intervencionFamilium);
            $em->flush();

            return $this->redirectToRoute('intervencionfamilia_show', array('id' => $intervencionFamilium->getId()));
        }

        return $this->render('intervencionfamilia/new.html.twig', array(
            'intervencionFamilium' => $intervencionFamilium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a intervencionFamilium entity.
     *
     * @Route("/{id}", name="intervencionfamilia_show")
     * @Method("GET")
     */
    public function showAction(IntervencionFamilia $intervencionFamilium)
    {
        $deleteForm = $this->createDeleteForm($intervencionFamilium);

        return $this->render('intervencionfamilia/show.html.twig', array(
            'intervencionFamilium' => $intervencionFamilium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing intervencionFamilium entity.
     *
     * @Route("/{id}/edit", name="intervencionfamilia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, IntervencionFamilia $intervencionFamilium)
    {
        $deleteForm = $this->createDeleteForm($intervencionFamilium);
        $editForm = $this->createForm('AppBundle\Form\IntervencionFamiliaType', $intervencionFamilium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('intervencionfamilia_edit', array('id' => $intervencionFamilium->getId()));
        }

        return $this->render('intervencionfamilia/edit.html.twig', array(
            'intervencionFamilium' => $intervencionFamilium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a intervencionFamilium entity.
     *
     * @Route("/{id}", name="intervencionfamilia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, IntervencionFamilia $intervencionFamilium)
    {
        $form = $this->createDeleteForm($intervencionFamilium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($intervencionFamilium);
            $em->flush();
        }

        return $this->redirectToRoute('intervencionfamilia_index');
    }

    /**
     * Creates a form to delete a intervencionFamilium entity.
     *
     * @param IntervencionFamilia $intervencionFamilium The intervencionFamilium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(IntervencionFamilia $intervencionFamilium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('intervencionfamilia_delete', array('id' => $intervencionFamilium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
