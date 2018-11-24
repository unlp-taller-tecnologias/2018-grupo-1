<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Anexo;
use AppBundle\Entity\Expediente;
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
     * @Route("/index/{expediente}", name="anexo_index")
     * @Method("GET")
     */
    public function indexAction($expediente)
    {
        $repository = $this->getDoctrine()->getRepository(Anexo::class);
        $anexos = $repository->findBy(array('expediente'=>$expediente));

        //$em = $this->getDoctrine()->getManager();
        //$anexos = $em->getRepository('AppBundle:Anexo')->findAll();

        return $this->render('anexo/index.html.twig', array(
            'anexos' => $anexos,
        ));
    }

    /**
     * Creates a new anexo entity.
     *
     * @Route("/new/{id}", name="anexo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository(Expediente::class);
        $expediente = $repository->find($id);
        $anexo = new Anexo();
        $anexo->setExpediente($expediente);
        $anexo->setFecha(new \DateTime());

        $form = $this->createForm('AppBundle\Form\AnexoType', $anexo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // $file stores the uploaded PDF file
            $file = $anexo->getPath();

            $fileName = date("d-m-Y").md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $file->move(
                    $this->getParameter('files_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                $fileName = date("d-m-Y").md5(uniqid()).'.'.$file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('files_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                    $fileName = date("d-m-Y").md5(uniqid()).'.'.$file->guessExtension();
                    $file->move(
                        $this->getParameter('files_directory'),
                        $fileName
                    );
                }
            }

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $anexo->setPath($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($anexo);
            $em->flush();

            return $this->redirectToRoute('expediente_show', array('id' => $expediente->getId()));
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
