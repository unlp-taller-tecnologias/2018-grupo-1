<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Seguimiento;
use AppBundle\Entity\Expediente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Seguimiento controller.
 *
 * @Route("seguimiento")
 */
class SeguimientoController extends Controller
{
    /**
     * Lists all seguimiento entities.
     *
     * @Route("/", name="seguimiento_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $seguimientos = $em->getRepository('AppBundle:Seguimiento')->findAll();

        return $this->render('seguimiento/index.html.twig', array(
            'seguimientos' => $seguimientos,
        ));
    }

    /**
     * Creates a new seguimiento entity.
     *
     * @Route("/new/{id}", name="seguimiento_new")
     * @Method({"GET"})
     */
    public function newAction(Request $request, $id)
    {
        //var_dump($id);
        $repository = $this->getDoctrine()->getRepository(Expediente::class);
        $expediente = $repository->find($id);
        $seguimiento = new Seguimiento();
        $seguimiento->setExpediente($expediente);
        //var_dump(new \DateTime());
        $seguimiento->setFecha(new \DateTime());   //date("d-m-Y")
        $form = $this->createForm('AppBundle\Form\SeguimientoType', $seguimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $expediente->addSeguimiento($seguimiento);
            $em = $this->getDoctrine()->getManager();
            $em->persist($seguimiento);
            $em->flush();

            return $this->redirectToRoute('seguimiento_show', array('id' => $seguimiento->getId()));
        }

        return $this->render('seguimiento/new.html.twig', array(
            'seguimiento' => $seguimiento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a seguimiento entity.
     *
     * @Route("/{id}", name="seguimiento_show")
     * @Method("GET")
     */
    public function showAction(Seguimiento $seguimiento)
    {
        $deleteForm = $this->createDeleteForm($seguimiento);

        return $this->render('seguimiento/show.html.twig', array(
            'seguimiento' => $seguimiento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing seguimiento entity.
     *
     * @Route("/{id}/edit", name="seguimiento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Seguimiento $seguimiento)
    {
        $deleteForm = $this->createDeleteForm($seguimiento);
        $editForm = $this->createForm('AppBundle\Form\SeguimientoType', $seguimiento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seguimiento_edit', array('id' => $seguimiento->getId()));
        }

        return $this->render('seguimiento/edit.html.twig', array(
            'seguimiento' => $seguimiento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a seguimiento entity.
     *
     * @Route("/{id}", name="seguimiento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Seguimiento $seguimiento)
    {
        $form = $this->createDeleteForm($seguimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seguimiento);
            $em->flush();
        }

        return $this->redirectToRoute('seguimiento_index');
    }

    /**
     * Creates a form to delete a seguimiento entity.
     *
     * @param Seguimiento $seguimiento The seguimiento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Seguimiento $seguimiento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seguimiento_delete', array('id' => $seguimiento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
