<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BotonAntipanico;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Botonantipanico controller.
 *
 * @Route("botonantipanico")
 */
class BotonAntipanicoController extends Controller
{
    /**
     * Lists all botonAntipanico entities.
     *
     * @Route("/", name="botonantipanico_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $botonAntipanicos = $em->getRepository('AppBundle:BotonAntipanico')->findAll();

        return $this->render('botonantipanico/index.html.twig', array(
            'botonAntipanicos' => $botonAntipanicos,
        ));
    }

    /**
     * Creates a new botonAntipanico entity.
     *
     * @Route("/new", name="botonantipanico_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $botonAntipanico = new Botonantipanico();
        $form = $this->createForm('AppBundle\Form\BotonAntipanicoType', $botonAntipanico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($botonAntipanico);
            $em->flush();

            return $this->redirectToRoute('botonantipanico_show', array('id' => $botonAntipanico->getId()));
        }

        return $this->render('botonantipanico/new.html.twig', array(
            'botonAntipanico' => $botonAntipanico,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a botonAntipanico entity.
     *
     * @Route("/{id}", name="botonantipanico_show")
     * @Method("GET")
     */
    public function showAction(BotonAntipanico $botonAntipanico)
    {
        $deleteForm = $this->createDeleteForm($botonAntipanico);

        return $this->render('botonantipanico/show.html.twig', array(
            'botonAntipanico' => $botonAntipanico,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing botonAntipanico entity.
     *
     * @Route("/{id}/edit", name="botonantipanico_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BotonAntipanico $botonAntipanico)
    {
        $deleteForm = $this->createDeleteForm($botonAntipanico);
        $editForm = $this->createForm('AppBundle\Form\BotonAntipanicoType', $botonAntipanico);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('botonantipanico_edit', array('id' => $botonAntipanico->getId()));
        }

        return $this->render('botonantipanico/edit.html.twig', array(
            'botonAntipanico' => $botonAntipanico,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a botonAntipanico entity.
     *
     * @Route("/{id}", name="botonantipanico_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BotonAntipanico $botonAntipanico)
    {
        $form = $this->createDeleteForm($botonAntipanico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($botonAntipanico);
            $em->flush();
        }

        return $this->redirectToRoute('botonantipanico_index');
    }

    /**
     * Creates a form to delete a botonAntipanico entity.
     *
     * @param BotonAntipanico $botonAntipanico The botonAntipanico entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BotonAntipanico $botonAntipanico)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('botonantipanico_delete', array('id' => $botonAntipanico->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
