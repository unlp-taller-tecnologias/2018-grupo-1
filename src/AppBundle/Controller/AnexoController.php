<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Anexo;
use AppBundle\Entity\Expediente;
use AppBundle\Entity\Categoria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

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
    public function indexAction(Expediente $expediente)
    {
        $repository = $this->getDoctrine()->getRepository(Anexo::class);
        $anexos = $repository->findBy(array('expediente'=>$expediente));
        return $this->render('anexo/index.html.twig', array(
            'anexos' => $anexos,
            'expediente' => $expediente,
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
            $anexo->setPath($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($anexo);
            $em->flush();
            return $this->redirectToRoute('expediente_show', array('id' => $expediente->getId()));
        }

        return $this->render('anexo/new.html.twig', array(
            'expediente' => $expediente->getId(),
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
        $repository = $this->getDoctrine()->getRepository(Categoria::class);
        $categoria = $repository->find($anexo->getCategoria());
        return $this->render('anexo/show.html.twig', array(
            'anexo' => $anexo,
            'categoria'=>$categoria,
            'file'=>$anexo->getPath(),
            'format'=>pathinfo($anexo->getPath(), PATHINFO_EXTENSION)
        ));
    }



    /**
     * Deletes a anexo entity.
     *
     * @Route("/delete/{id}", name="anexo_delete")
     * @Method("DELETE")
     */
    public function deleteAction($id){
      $em = $this->getDoctrine()->getManager();
      $anexo = $em->getRepository('AppBundle:Anexo')->findOneBy(array('id'=> $id));
      $expedienteId = $anexo->getExpediente()->getId();
      $em->remove($anexo);
      $em->flush();
      return $this->indexAction($expedienteId);
    }
}
