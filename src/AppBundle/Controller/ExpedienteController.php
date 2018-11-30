<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Expediente;
use AppBundle\Entity\Agresor;
use AppBundle\Entity\Victima;
use AppBundle\Entity\ExpedienteRedes;
use AppBundle\Entity\EvaluacionRiesgo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
    public function indexAction($currentPage = 1, Request $request){
      $limit = 10;
      $defaultData = array();
      $expedientesResultado = array();
      $em = $this->getDoctrine()->getManager();
      $form = $this->createFormBuilder($defaultData)
          ->add('nombreApellido', TextType::class, array('label' => 'Nombre y/o Apellido', 'required' => false,'attr' => array('class' => 'form-control')))
          ->add('nroExp', NumberType::class, array('label' => 'N° expediente','required' => false ,'attr' => array('class' => 'form-control')))
          ->add('buscar',SubmitType::class, array('label' => 'Buscar','attr' => array('class' => 'form-control btn btn-secondary')))
          ->getForm();
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();
        if (!empty($data['nombreApellido']) OR !empty($data['nroExp'])) {
          if (!empty($data['nombreApellido'])){
            $thetextstring = preg_replace("#[\s]+#", " ", $data['nombreApellido']);
            $palabras = explode(" ", $thetextstring);
            $resultados = $em->getRepository('AppBundle:Expediente')->getExpedientesByNameAndApe($palabras, 1, 1000);
            foreach ($resultados as $key => $resultado) {
              array_push($expedientesResultado, $resultado);
            }
            $maxPages = 0;
          }
          if (!empty($data['nroExp'])) {
            $resultados = $em->getRepository('AppBundle:Expediente')->getExpedientesById($data['nroExp'], 1, 1000);
            foreach ($resultados as $key => $resultado) {
              if (!in_array($resultado,$expedientesResultado)) {
                array_push($expedientesResultado, $resultado);
              }
            }
            $maxPages = 0;
          }
        } else {
          $expedientesResultado = $em->getRepository('AppBundle:Expediente')->getAllExpedientes($currentPage, $limit);
          $maxPages = ceil(count($expedientesResultado) / $limit);
        }
      } else {
        $expedientesResultado = $em->getRepository('AppBundle:Expediente')->getAllExpedientes($currentPage, $limit);
        $maxPages = ceil(count($expedientesResultado) / $limit);
      }

      return $this->render('expediente/index.html.twig', array(
            'expedientes' => $expedientesResultado,
            'maxPages' => $maxPages,
            'thisPage' => $currentPage,
            'form' => $form->createView()
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
        $agresor = new Agresor();
        $victima = new Victima();
        $evaluacion = new EvaluacionRiesgo();

        //consultar todas las redes y agregarlas a ExpedienteRedes
        $em = $this->getDoctrine()->getManager();
        $redes = $em->getRepository('AppBundle:Redes')->findAllActive();

        foreach ($redes as $item) {
            $expedienteRed = new ExpedienteRedes();
            $expedienteRed->setRedesId($item);
            $expediente->addExpedienteRede($expedienteRed);
        }
        $evaluacion->setAgresor($agresor);
        $victima->addEvaluacionesDeRiesgo($evaluacion);
        $expediente->setVictima($victima);
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
        // return $this->render('expediente/new.html.twig', array(
        //     'expediente' => $expediente,
        //     'form' => $editForm->createView(),
        //     'delete_form' => $deleteForm->createView(),
        // ));
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
