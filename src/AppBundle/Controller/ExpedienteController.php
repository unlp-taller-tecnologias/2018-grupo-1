<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Expediente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Expediente controller.
 *
 * @Route("expediente")
 */
class ExpedienteController extends Controller
{
    /**
     * Lists all expediente entities.
     *
     * @Route("/{currentPage}/index", name="expediente_index")
     * @Method("GET")
     */
    public function indexAction($currentPage = 1){

      $em = $this->getDoctrine()->getManager();


      $limit = 2;
      // $expedientes=$em->getRepository('AppBundle:Expediente')->findAll();
      $expedientes = $em->getRepository('AppBundle:Expediente')->getAllExpedientes($currentPage, $limit);
      $expedientesResultado = $expedientes['paginator'];
      $expedientesQueryCompleta =  $expedientes['query'];

      $maxPages = ceil($expedientes['paginator']->count() / $limit);

      return $this->render('expediente/index.html.twig', array(
            'expedientes' => $expedientesResultado,
            'maxPages'=>$maxPages,
            'thisPage' => $currentPage,
            'all_items' => $expedientesQueryCompleta
        ) );
      }


    /**
     * Creates a new expediente entity.
     *
     * @Route("/new", name="expediente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $expediente = new Expediente();
        $form = $this->createForm('AppBundle\Form\ExpedienteType', $expediente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $expediente->setFecha(new \DateTime());
            $em->persist($expediente);
            $em->flush();

            return $this->redirectToRoute('expediente_show', array('id' => $expediente->getId()));
        }

        return $this->render('expediente/new.html.twig', array(
            'expediente' => $expediente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a expediente entity.
     *
     * @Route("/{id}", name="expediente_show")
     * @Method("GET")
     */
    public function showAction(Expediente $expediente)
    {
        $deleteForm = $this->createDeleteForm($expediente);

        return $this->render('expediente/show.html.twig', array(
            'expediente' => $expediente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing expediente entity.
     *
     * @Route("/{id}/edit", name="expediente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Expediente $expediente)
    {
        $deleteForm = $this->createDeleteForm($expediente);
        $editForm = $this->createForm('AppBundle\Form\ExpedienteType', $expediente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('expediente_edit', array('id' => $expediente->getId()));
        }

        return $this->render('expediente/edit.html.twig', array(
            'expediente' => $expediente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a expediente entity.
     *
     * @Route("/{id}", name="expediente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Expediente $expediente)
    {
        $form = $this->createDeleteForm($expediente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($expediente);
            $em->flush();
        }

        return $this->redirectToRoute('expediente_index');
    }

    /**
     * Creates a form to delete a expediente entity.
     *
     * @param Expediente $expediente The expediente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Expediente $expediente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('expediente_delete', array('id' => $expediente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
