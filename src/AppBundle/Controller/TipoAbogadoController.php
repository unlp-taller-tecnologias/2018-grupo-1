<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TipoAbogado;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tipoabogado controller.
 *
 * @Route("tipoabogado")
 */
class TipoAbogadoController extends Controller
{
    /**
     * Lists all tipoAbogado entities.
     *
     * @Route("/", name="tipoabogado_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipoAbogados = $em->getRepository('AppBundle:TipoAbogado')->findAll();

        return $this->render('tipoabogado/index.html.twig', array(
            'tipoAbogados' => $tipoAbogados,
        ));
    }

    /**
     * Creates a new tipoAbogado entity.
     *
     * @Route("/new", name="tipoabogado_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tipoAbogado = new Tipoabogado();
        $form = $this->createForm('AppBundle\Form\TipoAbogadoType', $tipoAbogado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoAbogado);
            $em->flush();

            return $this->redirectToRoute('tipoabogado_show', array('id' => $tipoAbogado->getId()));
        }

        return $this->render('tipoabogado/new.html.twig', array(
            'tipoAbogado' => $tipoAbogado,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tipoAbogado entity.
     *
     * @Route("/{id}", name="tipoabogado_show")
     * @Method("GET")
     */
    public function showAction(TipoAbogado $tipoAbogado)
    {
        $deleteForm = $this->createDeleteForm($tipoAbogado);

        return $this->render('tipoabogado/show.html.twig', array(
            'tipoAbogado' => $tipoAbogado,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tipoAbogado entity.
     *
     * @Route("/{id}/edit", name="tipoabogado_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TipoAbogado $tipoAbogado)
    {
        $deleteForm = $this->createDeleteForm($tipoAbogado);
        $editForm = $this->createForm('AppBundle\Form\TipoAbogadoType', $tipoAbogado);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipoabogado_edit', array('id' => $tipoAbogado->getId()));
        }

        return $this->render('tipoabogado/edit.html.twig', array(
            'tipoAbogado' => $tipoAbogado,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tipoAbogado entity.
     *
     * @Route("/{id}", name="tipoabogado_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TipoAbogado $tipoAbogado)
    {
        $form = $this->createDeleteForm($tipoAbogado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipoAbogado);
            $em->flush();
        }

        return $this->redirectToRoute('tipoabogado_index');
    }

    /**
     * Creates a form to delete a tipoAbogado entity.
     *
     * @param TipoAbogado $tipoAbogado The tipoAbogado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TipoAbogado $tipoAbogado)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipoabogado_delete', array('id' => $tipoAbogado->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
