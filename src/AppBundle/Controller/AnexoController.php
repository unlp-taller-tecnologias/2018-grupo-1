<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Anexo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Anexo controller.
 *
 * @Route("anexo")
 */
class AnexoController extends Controller
{
    /**
     * Lists all anexo entities.
     *
     * @Route("/", name="anexo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $anexos = $em->getRepository('AppBundle:Anexo')->findAll();

        return $this->render('anexo/index.html.twig', array(
            'anexos' => $anexos,
        ));
    }

    /**
     * Creates a new anexo entity.
     *
     * @Route("/new", name="anexo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $anexo = new Anexo();
        $form = $this->createForm('AppBundle\Form\AnexoType', $anexo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($anexo);
            $em->flush();

            return $this->redirectToRoute('anexo_show', array('id' => $anexo->getId()));
        }

        return $this->render('anexo/new.html.twig', array(
            'anexo' => $anexo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a anexo entity.
     *
     * @Route("/{id}", name="anexo_show")
     * @Method("GET")
     */
    public function showAction(Anexo $anexo)
    {
        $deleteForm = $this->createDeleteForm($anexo);

        return $this->render('anexo/show.html.twig', array(
            'anexo' => $anexo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing anexo entity.
     *
     * @Route("/{id}/edit", name="anexo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Anexo $anexo)
    {
        $deleteForm = $this->createDeleteForm($anexo);
        $editForm = $this->createForm('AppBundle\Form\AnexoType', $anexo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('anexo_edit', array('id' => $anexo->getId()));
        }

        return $this->render('anexo/edit.html.twig', array(
            'anexo' => $anexo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a anexo entity.
     *
     * @Route("/{id}", name="anexo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Anexo $anexo)
    {
        $form = $this->createDeleteForm($anexo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($anexo);
            $em->flush();
        }

        return $this->redirectToRoute('anexo_index');
    }

    /**
     * Creates a form to delete a anexo entity.
     *
     * @param Anexo $anexo The anexo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Anexo $anexo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('anexo_delete', array('id' => $anexo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
