<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EvaluacionRiesgo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Expediente;
use AppBundle\Entity\Agresor;
use AppBundle\Entity\Victima;

use AppBundle\Entity\ExpedienteRedes;
use AppBundle\Entity\ExpedienteSalud;
use AppBundle\Entity\ExpedienteCobertura;

use AppBundle\Entity\EvaluacionIndicador;
use AppBundle\Entity\AgresorCorruptibilidad;

use AppBundle\Entity\IntervencionTipoPenal;
use AppBundle\Entity\IntervencionPenal;
use AppBundle\Entity\IntervencionFamilia;
// use AppBundle\Entity\IntervencionJudicial;
// use AppBundle\Entity\IntervencionTipoFamilia;
use AppBundle\Entity\AntecedenteJudicial;
// use AppBundle\Entity\EvaluacionMedida;
// use AppBundle\Entity\Juzgado;


/**
 * Evaluacionriesgo controller.
 *
 * @Route("evaluacionriesgo")
 */
class EvaluacionRiesgoController extends Controller
{
    /**
     * Lists all evaluacionRiesgo entities.
     *
     * @Route("/", name="evaluacionriesgo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $evaluacionRiesgos = $em->getRepository('AppBundle:EvaluacionRiesgo')->findAll();

        return $this->render('evaluacionriesgo/index.html.twig', array(
            'evaluacionRiesgos' => $evaluacionRiesgos,
        ));
    }

    /**
     * Creates a new evaluacionRiesgo entity.
     *
     * @Route("/new/{expediente_id}", name="evaluacionriesgo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $expediente_id)
    {
        $evaluacionRiesgo = new Evaluacionriesgo();
$em = $this->getDoctrine()->getManager();
        $penal = new IntervencionPenal();
        $familia = new IntervencionFamilia();
        $penal->setNombre('PENAL');
        $familia->setNombre('FAMILIA');
        $evaluacionRiesgo->setPenal($penal);
        $evaluacionRiesgo->setFamilia($familia);
        //$expediente = new Expediente();
        $agresor = new Agresor();

        
$expediente = $em->getRepository('AppBundle:Expediente')->find($expediente_id);
$victima = $expediente->getVictima();
        
        //$victima =$usuarios = $em->getRepository('AppBundle:Victima')->find($expediente);
        //$victima = new Victima();
        $antecedente=new AntecedenteJudicial();
        $evaluacionRiesgo->setAgresor($agresor);
        $evaluacionRiesgo->addAntecedentesJudiciale($antecedente);
        
        $victima->addEvaluacionesDeRiesgo($evaluacionRiesgo);
        $form = $this->createForm('AppBundle\Form\EvaluacionRiesgoType', $evaluacionRiesgo);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {

            $this->persistirNivelDeCorruptibilidad($request,$agresor);
            //$this->persistirUsuarios($request,$expediente);
            //$this->persistirCobertura($request,$expediente);
            $this->persistirIndicadoresRiesgo($request,$evaluacionRiesgo);
            $this->persistirIntervenciones($request,$penal);
            $this->persistirIntervenciones($request,$familia);
            //$this->persistirElementosDinamicos($request,$expediente,'redes');
            $this->persistirElementosDinamicos($request,$expediente,'salud');
            $this->persistirElementosMedidaJudicial($request,$evaluacionRiesgo);

            //$em = $this->getDoctrine()->getManager();
            $em->persist($evaluacionRiesgo);
            $em->flush();

            return $this->redirectToRoute('evaluacionriesgo_show', array('id' => $evaluacionRiesgo->getId()));
        }else {
            //$redes = $em->getRepository('AppBundle:Redes')->findAllActive();
            $estadoSalud = $em->getRepository('AppBundle:EstadoDeSalud')->findAllActive();
            $coberturaSalud = $em->getRepository('AppBundle:CoberturaSalud')->findAllActive();
            $indicadoresRiesgo = $em->getRepository('AppBundle:IndicadorRiesgo')->findAllActive();
            $corruptibilidad=$em->getRepository('AppBundle:NivelCorruptibilidad')->findAllActive();
            $subCorr=$em->getRepository('AppBundle:NivelCorruptibilidad')->findAllSub();
        }

        return $this->render('evaluacionriesgo/new.html.twig', array(
            'evaluacionRiesgo' => $evaluacionRiesgo,
            'form' => $form->createView(),
            //'redes'=>$redes,
            'estadoSalud' => $estadoSalud,
            'coberturaSalud' => $coberturaSalud,
            'indicadoresRiesgo' => $indicadoresRiesgo,
            'corruptibilidad'=> $corruptibilidad,
            'subCorr'=> $subCorr,
        ));
    }

    /**
     * Finds and displays a evaluacionRiesgo entity.
     *
     * @Route("/{id}", name="evaluacionriesgo_show")
     * @Method("GET")
     */
    public function showAction(EvaluacionRiesgo $evaluacionRiesgo)
    {
        $deleteForm = $this->createDeleteForm($evaluacionRiesgo);

        return $this->render('evaluacionriesgo/show.html.twig', array(
            'evaluacionRiesgo' => $evaluacionRiesgo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing evaluacionRiesgo entity.
     *
     * @Route("/{id}/edit", name="evaluacionriesgo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EvaluacionRiesgo $evaluacionRiesgo)
    {
        $deleteForm = $this->createDeleteForm($evaluacionRiesgo);
        $editForm = $this->createForm('AppBundle\Form\EvaluacionRiesgoType', $evaluacionRiesgo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evaluacionriesgo_edit', array('id' => $evaluacionRiesgo->getId()));
        }

        return $this->render('evaluacionriesgo/edit.html.twig', array(
            'evaluacionRiesgo' => $evaluacionRiesgo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a evaluacionRiesgo entity.
     *
     * @Route("/{id}", name="evaluacionriesgo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EvaluacionRiesgo $evaluacionRiesgo)
    {
        $form = $this->createDeleteForm($evaluacionRiesgo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evaluacionRiesgo);
            $em->flush();
        }

        return $this->redirectToRoute('evaluacionriesgo_index');
    }

    /**
     * Creates a form to delete a evaluacionRiesgo entity.
     *
     * @param EvaluacionRiesgo $evaluacionRiesgo The evaluacionRiesgo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EvaluacionRiesgo $evaluacionRiesgo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evaluacionriesgo_delete', array('id' => $evaluacionRiesgo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    private function persistirElementosMedidaJudicial($request, $evaluacion){
        $em = $this->getDoctrine()->getManager();
        $conjuntoMedidas = $request->request->get('medida');
        $denuncias = $request->request->get('denuncias');
        $incumplimiento = $request->request->get('incumplimiento');
        $cantidad = $request->request->get('cantidad');

        if ( is_array($conjuntoMedidas) AND (count($conjuntoMedidas)>0)){
            foreach ($conjuntoMedidas as $clave=>$item) {
                $evaluacionMedida = new EvaluacionMedida();
                $medida = $em->getRepository('AppBundle:MedidaJudicial')->find($clave);

                $evaluacionMedida->setEvaluacionId($evaluacion);
                if(isset($denuncias[$clave])){
                    $evaluacionMedida->setDenuncia(true);
                }else{
                    $evaluacionMedida->setDenuncia(false);
                }
                $evaluacionMedida->setMedidaId($medida);
                if(isset($denuncias[$clave])){
                    $evaluacionMedida->setCantidadVeces($cantidad[$clave]);
                }
                if(isset($denuncias[$clave])){
                    $evaluacionMedida->setIncumplimiento(true);
                }else{
                    $evaluacionMedida->setIncumplimiento(false);
                }

                $em->persist($evaluacionMedida);

            }
        }
    }

    private function persistirNivelDeCorruptibilidad($request, $agresor){
        $em = $this->getDoctrine()->getManager();
        $conjuntoNivelCorr = $request->request->get('corruptibilidad');
        $conjuntoObservaciones = $request->request->get('observacionesCorruptibilidad');
        if ( is_array($conjuntoNivelCorr) AND (count($conjuntoNivelCorr)>0)){
            foreach ($conjuntoNivelCorr as $clave=>$item) {
                if ($item=='on') {
                    $agresorCorr = new AgresorCorruptibilidad();
                    $corruptibilidad = $em->getRepository('AppBundle:NivelCorruptibilidad')->find($clave);
                    $agresorCorr->setCorruptibilidadId($corruptibilidad);
                    $agresorCorr->setObservacion($conjuntoObservaciones[$clave]);
                    $agresorCorr->setAgresorId($agresor);
                    $em->persist($agresorCorr);
                }
            }
        }
    }

    private function persistirUsuarios($request, $expediente){
        $conjuntoIds=$request->request->get('appbundle_expediente')['usuarios'];
        $em = $this->getDoctrine()->getManager();
        if (is_array($conjuntoIds) && (count($conjuntoIds))>0){
            foreach ($conjuntoIds as $clave=>$item) {
                $usuario = $em->getRepository('AppBundle:Usuario')->find($item);
                $expediente->addUsuario($usuario);

            }
        }
    }

    private function persistirElementosDinamicos($request, $expediente, $elementos){
        $aux=ucfirst($elementos);
        $em = $this->getDoctrine()->getManager();
        $conjuntoElementos = $request->request->get($elementos);
        var_dump($conjuntoElementos);
        $conjuntoObservaciones = $request->request->get('observaciones'.$aux);
        var_dump($conjuntoObservaciones);
        if ( is_array($conjuntoElementos) AND (count($conjuntoElementos)>0)){
            foreach ($conjuntoElementos as $clave=>$item) {
                if ($item=='on') {
//DEBERIA AGREGAR SI INGRESAN NO... PUEDE SER MEJOR PARA EL EDITAR!
echo "string";
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

    private function persistirIndicadoresRiesgo($request, $evaluacion){
        $em = $this->getDoctrine()->getManager();
        $conjuntoRiesgos = $request->request->get('riesgo');
        $conjuntoObservaciones = $request->request->get('observacionesRiesgo');
        if ( is_array($conjuntoRiesgos) AND (count($conjuntoRiesgos)>0)){
            foreach ($conjuntoRiesgos as $clave=>$item) {
                $evaluacionRiesgo = new EvaluacionIndicador();
                $indicador = $em->getRepository('AppBundle:IndicadorRiesgo')->find($clave);
                $evaluacionRiesgo->setIndicadorId($indicador);
                $evaluacionRiesgo->setObservacion($conjuntoObservaciones[$clave]);
                $evaluacionRiesgo->setEvaluacionRiesgoId($evaluacion);
                $em->persist($evaluacionRiesgo);
            }
        }
    }

    private function persistirIntervenciones($request, $intervencion){
        $intervencionLW = strtolower($intervencion->getNombre());
        $intervencionUF = ucfirst($intervencionLW);

        $em = $this->getDoctrine()->getManager();

        $conjuntoIntervenciones = $request->request->get('intervenciones' . $intervencionUF);
        $conjuntoObservaciones = $request->request->get('observaciones' . $intervencionUF);
        
        if ( is_array($conjuntoIntervenciones) AND (count($conjuntoIntervenciones)>0)){
            foreach ($conjuntoIntervenciones as $clave=>$item) {
                $clase = 'AppBundle\Entity\IntervencionTipo'.$intervencionUF;
                $intervencionTipo = new $clase;
                $intervencionJudicial = $em->getRepository('AppBundle:IntervencionJudicial')->find($clave);
                $intervencionTipo->setIntervencionJudicial($intervencionJudicial);
                $intervencionTipo->setObservacion($conjuntoObservaciones[$clave]);
                $juzgado_id = $request->request->get('appbundle_expediente')['victima']['evaluacionesDeRiesgo'][0][$intervencionLW]['juzgado'];
                $juzgado = $em->getRepository('AppBundle:Juzgado')->find($juzgado_id);
                $intervencion->setJuzgado($juzgado);
                $setIntervencion = 'set'.$intervencionUF;
                var_dump($setIntervencion);
                var_dump($intervencionTipo);
                $intervencionTipo->$setIntervencion($intervencion);
                $em->persist($intervencionTipo);
            }
        }
    }

    private function persistirCobertura($request, $expediente){
        $em = $this->getDoctrine()->getManager();
        $conjuntoCoberturas = $request->request->get('cobertura');
        $conjuntoObservaciones = $request->request->get('observacionesCobertura');
        if ( is_array($conjuntoCoberturas) AND (count($conjuntoCoberturas)>0)){
            foreach ($conjuntoCoberturas as $clave=>$item) {
                $expedienteCobertura = new ExpedienteCobertura();
                $cobertura = $em->getRepository('AppBundle:CoberturaSalud')->find($item);
                $expedienteCobertura->setCoberturaId($cobertura);
                $expedienteCobertura->setObservacion($conjuntoObservaciones[$clave]);
                $em->persist($expedienteCobertura);
                $expediente->addExpedienteCobertura($expedienteCobertura);
            }
        }
    }
}