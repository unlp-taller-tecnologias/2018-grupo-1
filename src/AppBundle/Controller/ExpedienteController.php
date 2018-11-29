<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Expediente;
use AppBundle\Entity\Agresor;

use AppBundle\Entity\Usuario;
use AppBundle\Entity\Victima;
use AppBundle\Entity\ExpedienteRedes;
use AppBundle\Entity\ExpedienteSalud;
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
      $limit = 2;
      $defaultData = array();
      $form = $this->createFormBuilder($defaultData)
          ->add('nombreApellido', TextType::class, array('label' => 'Nombre y/o Apellido', 'required' => false,'attr' => array('class' => 'form-control')))
          ->add('nroExp', NumberType::class, array('label' => 'N° expediente','required' => false ,'attr' => array('class' => 'form-control')))
          ->add('buscar',SubmitType::class, array('label' => 'Buscar','attr' => array('class' => 'form-control btn btn-secondary')))
          ->getForm();
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();
      } else {
        $em = $this->getDoctrine()->getManager();
        $expedientes = $em->getRepository('AppBundle:Expediente')->getAllExpedientes($currentPage, $limit);
        $expedientesResultado = $expedientes['paginator'];
        $expedientesQueryCompleta =  $expedientes['query'];
        $maxPages = ceil($expedientes['paginator']->count() / $limit);
      }

      return $this->render('expediente/index.html.twig', array(
            'expedientes' => $expedientesResultado,
            'maxPages' => $maxPages,
            'thisPage' => $currentPage,
            'all_items' => $expedientesQueryCompleta,
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

        $usuario1 = new Usuario();
        $expediente->addUsuario($usuario1);
        $usuario2 = new Usuario();
        $expediente->addUsuario($usuario2);
        //consultar todas las redes y agregarlas a ExpedienteRedes 
        $em = $this->getDoctrine()->getManager();
        $redes = $em->getRepository('AppBundle:Redes')->findAllActive();
        $estadoSalud = $em->getRepository('AppBundle:EstadoDeSalud')->findAllActive();
        $coberturaSalud = $em->getRepository('AppBundle:CoberturaSalud')->findAllActive();
        // foreach ($redes as $item) {
        //     $expedienteRed = new ExpedienteRedes();
        //     $expedienteRed->setRedesId($item);
        //     //echo ($expedienteRed->getRedesId()->getDescripcion());
        //     $expediente->addExpedienteRede($expedienteRed);
        // }
        $evaluacion->setAgresor($agresor);
        $victima->addEvaluacionesDeRiesgo($evaluacion);
        $expediente->setVictima($victima);
        $form = $this->createForm('AppBundle\Form\ExpedienteType', $expediente);
        $form->handleRequest($request);

// var_dump($_POST);
// ["redes"]=> array(3) { [1]=> string(4) "true" [2]=> string(4) "true" [3]=> string(5) "false" } ["observacionesRedes"]=> array(3) { [1]=> string(0) "" [2]=> string(0) "" [3]=> string(0) "" } }
// var_dump($request->request->get('redes'));
// var_dump($request->request->get('observacionesRedes'));
        if ($form->isSubmitted() && $form->isValid()) {
            // $redes = $request->request->get('redes');
            // $observacion = $request->request->get('observacionesRedes');
            // if (count($redes)>0){
            //     foreach ($redes as $clave=>$item) {
            //         if ($item=='true') {
            //             //var_dump($item);
            //             $object = $em->getRepository('AppBundle:Redes')->find($clave);
            //             $expedienteRed = new ExpedienteRedes();
            //             $expedienteRed->setRedesId($object);
            //             $expedienteRed->setObservacion($observacion[$clave]);
            //             $em->persist($expedienteRed);
            //             $expediente->addExpedienteRede($expedienteRed);
            //         }

            //     }
            // }
            $this->persistirElementosDinamicos($request,$expediente,'redes');
            $this->persistirElementosDinamicos($request,$expediente,'salud');
//            $em = $this->getDoctrine()->getManager();
            $expediente->setFecha(new \DateTime());
            $em->persist($expediente);
            $em->flush();

            return $this->redirectToRoute('expediente_show', array('id' => $expediente->getId()));
        } 
        else {
           $redes = $em->getRepository('AppBundle:Redes')->findAllActive(); 
        }

        return $this->render('expediente/new.html.twig', array(
            'expediente' => $expediente,
            'form' => $form->createView(),
            'redes'=>$redes,
            'estadoSalud' => $estadoSalud,
            'coberturaSalud' => $coberturaSalud,
        ));
    }

    private function persistirElementosDinamicos($request, $expediente, $elementos){
        $aux=ucfirst($elementos);
        $em = $this->getDoctrine()->getManager();
        echo $elementos;
        $conjuntoElementos = $request->request->get($elementos);
        $conjuntoObservaciones = $request->request->get('observaciones'.$aux);
        if ((count($conjuntoElementos))>0){
            foreach ($conjuntoElementos as $clave=>$item) {
                if ($item=='true') {
//DEBERIA AGREGAR SI INGRESAN NO... PUEDE SER MEJOR PARA EL EDITAR!

                    //var_dump($item);
                    $clase='AppBundle\Entity\Expediente'.ucfirst($elementos);
                    $expedienteObject = new $clase();
                    if ($elementos=='salud') {
                        $tipo='AppBundle:EstadoDe'.$aux;
                        $object = $em->getRepository($tipo)->find($clave);
                        $expedienteObject->setEstadoSaludId($object); 
                    }else{
                        $funcion='set'.$aux.'Id';
                        $tipo='AppBundle:'.$aux;
                        $object = $em->getRepository($tipo)->find($clave);
                        $expedienteObject->$funcion($object);
                    }
                    
                    ///VER NOMBRE DE LOS METODOS!!!!!!!!!!!!

                    $expedienteObject->setObservacion($conjuntoObservaciones[$clave]);
                    $em->persist($expedienteObject);
                    //$expediente->addExpedienteRede($expedienteObject);
                    if ($elementos=='redes') {
                        $expediente->addExpedienteRede($expedienteObject);
                    }else{
                        $expediente->addExpedienteSalud($expedienteObject);
                    }
                }
            }
        }
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


/*
       $aux=ucfirst($elementos);
        $em = $this->getDoctrine()->getManager();
        echo $elementos;
        $conjuntoElementos = $request->request->get($elementos);
        $conjuntoObservaciones = $request->request->get('observaciones'.$aux);
        if ((count($conjuntoElementos))>0){
            foreach ($conjuntoElementos as $clave=>$item) {
                if ($item=='true') {
                    //var_dump($item);
                    if ($elementos=='salud') {
                        $tipo='AppBundle:EstadoDe'.$aux;
                    }else{
                        $tipo='AppBundle:'.$aux;
                    }
                    $object = $em->getRepository($tipo)->find($clave);
                    $clase='AppBundle\Entity\Expediente'.ucfirst($elementos);
                    $expedienteObject = new $clase();
                    
                    $funcion='set'.$aux.'Id';
                    

                    if ($elementos=='salud') {
                        $expedienteObject->setEstadoSaludId($object); 
                    }else{
                        $expedienteObject->$funcion($object); 
                    }
                    ///VER NOMBRE DE LOS METODOS!!!!!!!!!!!!

                    $expedienteObject->setObservacion($conjuntoObservaciones[$clave]);
                    $em->persist($expedienteObject);
                    //$expediente->addExpedienteRede($expedienteObject);
                    if ($elementos=='redes') {
                        $expediente->addExpedienteRede($expedienteObject);
                    }else{
                        $expediente->addExpedienteSalud($expedienteObject);
                    }
                }
            }
        }
*/
