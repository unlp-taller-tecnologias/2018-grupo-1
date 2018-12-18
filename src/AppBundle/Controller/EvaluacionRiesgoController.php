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
use AppBundle\Entity\AntecedenteJudicial;
use AppBundle\Entity\MedidaJudicial;
use AppBundle\Entity\EvaluacionMedida;


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
     * @Route("/index/{expediente}", name="evaluacionriesgo_index")
     * @Method("GET")
     */
    public function indexAction(Expediente $expediente){
      $repository = $this->getDoctrine()->getRepository(EvaluacionRiesgo::class);
      $evaluacionesRiesgo = $repository->findBy(array('victima'=>$expediente->getVictima()));
        return $this->render('evaluacionriesgo/index.html.twig', array(
            'evaluacionRiesgos' => $evaluacionesRiesgo,
            'expediente' => $expediente->getId(),
            'nroExp' => $expediente->getNroExp(),
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
        $agresor = new Agresor();
        $expediente = $em->getRepository('AppBundle:Expediente')->find($expediente_id);
        $victima = $expediente->getVictima();
        $antecedente=new AntecedenteJudicial();
        $evaluacionRiesgo->setAgresor($agresor);
        $evaluacionRiesgo->addAntecedentesJudiciale($antecedente);
        $victima->addEvaluacionesDeRiesgo($evaluacionRiesgo);
        $form = $this->createForm('AppBundle\Form\EvaluacionRiesgoType', $evaluacionRiesgo);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->persistirNivelDeCorruptibilidad($request,$agresor);
            $this->persistirIndicadoresRiesgo($request,$evaluacionRiesgo);
            $this->persistirIntervenciones($request,$penal, $evaluacionRiesgo);
            $this->persistirIntervenciones($request,$familia, $evaluacionRiesgo);
            $this->persistirElementosMedidaJudicial($request,$evaluacionRiesgo);

            if(isset($request->request->get('agresor-provincia')[0])){
                $evaluacionRiesgo->getAgresor()->setProvincia($request->request->get('agresor-provincia')[0]);
            }
            if(isset($request->request->get('agresor-partido')[0])){
                $evaluacionRiesgo->getAgresor()->setPartido($request->request->get('agresor-partido')[0]);     
            }
            if(isset($request->request->get('agresor-localidad')[0])){
                $evaluacionRiesgo->getAgresor()->setLocalidad($request->request->get('agresor-localidad')[0]);
            }
            $em->persist($evaluacionRiesgo);
            if(isset($request->request->get('appbundle_evaluacionriesgo')['perimetral']['fecha']) AND (strlen($request->request->get('appbundle_evaluacionriesgo')['perimetral']['fecha']) > 0)){
                $evaluacionRiesgo->getPerimetral()->setResuelta(0);
            }
            $em->flush();

            return $this->redirectToRoute('expediente_show', array('id' => $evaluacionRiesgo->getVictima()->getExpediente()->getId()));
        }else {
            $indicadoresRiesgo = $em->getRepository('AppBundle:IndicadorRiesgo')->findAllActive();
            $corruptibilidad=$em->getRepository('AppBundle:NivelCorruptibilidad')->findAllActive();
            $subCorr=$em->getRepository('AppBundle:NivelCorruptibilidad')->findAllSub();
            $intervenciones = $em->getRepository('AppBundle:IntervencionJudicial')->findAllActive();
            $medidasJudiciales = $em->getRepository('AppBundle:MedidaJudicial')->findAllActive();
        }

        return $this->render('evaluacionriesgo/new.html.twig', array(
            'expediente' => $expediente_id,
            'evaluacionRiesgo' => $evaluacionRiesgo,
            'form' => $form->createView(),
            'indicadoresRiesgo' => $indicadoresRiesgo,
            'corruptibilidad'=> $corruptibilidad,
            'subCorr'=> $subCorr,
            'intervenciones' => $intervenciones,
            'medidasJudiciales' => $medidasJudiciales,
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

    public function persistirUbicacion($request, $agresor){
        $provincia=$request->request->get('agresor-provincia');
        $partido=$request->request->get('agresor-partido');
        $localidad=$request->request->get('agresor-localidad');
        $agresor->setProvincia($provincia);
        $agresor->setPartido($partido);
        $agresor->setLocalidad($localidad);
    }

    /**
     * Displays a form to edit an existing evaluacionRiesgo entity.
     *
     * @Route("/{id}/edit", name="evaluacionriesgo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EvaluacionRiesgo $evaluacionRiesgo){

        $editForm = $this->createForm('AppBundle\Form\EvaluacionRiesgoType', $evaluacionRiesgo);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->persistirNivelDeCorruptibilidad($request,$evaluacionRiesgo->getAgresor());
            $this->persistirIndicadoresRiesgo($request,$evaluacionRiesgo);
            $this->persistirIntervenciones($request,$evaluacionRiesgo->getPenal(), $evaluacionRiesgo);
            $this->persistirIntervenciones($request,$evaluacionRiesgo->getFamilia(), $evaluacionRiesgo);
            $this->persistirElementosMedidaJudicial($request,$evaluacionRiesgo);
            if(isset($request->request->get('agresor-provincia')[0])){
                $evaluacionRiesgo->getAgresor()->setProvincia($request->request->get('agresor-provincia')[0]);
            }
            if(isset($request->request->get('agresor-partido')[0])){
                $evaluacionRiesgo->getAgresor()->setPartido($request->request->get('agresor-partido')[0]);
                   
            }
            if(isset($request->request->get('agresor-localidad')[0])){
                $evaluacionRiesgo->getAgresor()->setLocalidad($request->request->get('agresor-localidad')[0]);
            }
            $this->persistirUbicacion($request, $evaluacionRiesgo->getAgresor());
            $em->persist($evaluacionRiesgo);
            $em->flush();
            return $this->redirectToRoute('evaluacionriesgo_index', array('expediente' => $evaluacionRiesgo->getVictima()->getExpediente()->getId()));
        } else {
            $indicadoresRiesgo = $em->getRepository('AppBundle:IndicadorRiesgo')->findAllActive();
            $corruptibilidad=$em->getRepository('AppBundle:NivelCorruptibilidad')->findAllActive();
            $subCorr=$em->getRepository('AppBundle:NivelCorruptibilidad')->findAllSub();
            $intervenciones = $em->getRepository('AppBundle:IntervencionJudicial')->findAllActive();
            $medidasJudiciales = $em->getRepository('AppBundle:MedidaJudicial')->findAllActive();

            $auxCorruptibilidad=$em->getRepository('AppBundle:AgresorCorruptibilidad')->findBy(array('agresorId'=>$evaluacionRiesgo->getAgresor()->getId()));
            $myCorruptibilidad=array();
            $expCorruptibilidad=array();
            for ($i=0; $i < count($auxCorruptibilidad) ; $i++) {
                $myCorruptibilidad[]=$auxCorruptibilidad[$i]->getCorruptibilidadId()->getId();
                $expCorruptibilidad[$auxCorruptibilidad[$i]->getCorruptibilidadId()->getId()]=$auxCorruptibilidad[$i]->getObservacion();
            }

            $auxSubCorruptibilidad=$em->getRepository('AppBundle:Agresor')->findAllSub($evaluacionRiesgo->getAgresor()->getId());
            $mySubCorruptibilidad=array();
            $expSubCorruptibilidad=array();
            for ($i=0; $i < count($auxSubCorruptibilidad) ; $i++) {
                $mySubCorruptibilidad[]=$auxSubCorruptibilidad[$i]->getCorruptibilidadId()->getId();
                $expSubCorruptibilidad[$auxSubCorruptibilidad[$i]->getCorruptibilidadId()->getId()]=$auxSubCorruptibilidad[$i]->getObservacion();
            }

            $auxIndicador=$em->getRepository('AppBundle:EvaluacionIndicador')->findBy(array('evaluacionRiesgoId'=>$evaluacionRiesgo->getId()));
            $myIndicador=array();
            $expIndicador=array();
            for ($i=0; $i < count($auxIndicador) ; $i++) {
                $myIndicador[]=$auxIndicador[$i]->getIndicadorId()->getId();
                $expIndicador[$auxIndicador[$i]->getIndicadorId()->getId()]=$auxIndicador[$i]->getObservacion();
            }

            $auxMedidasJudiciales = $em->getRepository('AppBundle:EvaluacionMedida')->findBy(array('evaluacionId' => $evaluacionRiesgo->getId()));
            $myMedidas = array();
            $denunciaMedidas = array();
            $cantidadVecesMedidas = array();
            $incumplimientoMedidas = array();
            for ($i=0; $i < count($auxMedidasJudiciales) ; $i++) { 
                $myMedidas[] = $auxMedidasJudiciales[$i]->getMedidaId();
                $denunciaMedidas[$auxMedidasJudiciales[$i]->getMedidaId()->getId()] = $auxMedidasJudiciales[$i]->getDenuncia();
                $cantidadVecesMedidas[$auxMedidasJudiciales[$i]->getMedidaId()->getId()] = $auxMedidasJudiciales[$i]->getCantidadVeces();
                $incumplimientoMedidas[$auxMedidasJudiciales[$i]->getMedidaId()->getId()] = $auxMedidasJudiciales[$i]->getIncumplimiento();

            }

            $auxIntervencionFamilia=$em->getRepository('AppBundle:IntervencionTipoFamilia')->findBy(array('familia'=>$evaluacionRiesgo->getFamilia()));
            $myIntervencionFamilia=array();
            $expIntervencionFamilia=array();
            for ($i=0; $i < count($auxIntervencionFamilia) ; $i++) {
                $myIntervencionFamilia[]=$auxIntervencionFamilia[$i]->getIntervencionJudicial()->getId();
                $expIntervencionFamilia[$auxIntervencionFamilia[$i]->getIntervencionJudicial()->getId()]=$auxIntervencionFamilia[$i]->getObservacion();
            }

            $auxIntervencionPenal=$em->getRepository('AppBundle:IntervencionTipoPenal')->findBy(array('penal'=>$evaluacionRiesgo->getPenal()));
            $myIntervencionPenal=array();
            $expIntervencionPenal=array();
            for ($i=0; $i < count($auxIntervencionPenal) ; $i++) {
                $myIntervencionPenal[]=$auxIntervencionPenal[$i]->getIntervencionJudicial()->getId();
                $expIntervencionPenal[$auxIntervencionPenal[$i]->getIntervencionJudicial()->getId()]=$auxIntervencionPenal[$i]->getObservacion();
            }
        }
        return $this->render('evaluacionriesgo/edit.html.twig', array(
            'evaluacionRiesgo' => $evaluacionRiesgo,
            'form' => $editForm->createView(),
            'indicadoresRiesgo' => $indicadoresRiesgo,
            'myIndicador' => $myIndicador,
            'expIndicador' => $expIndicador,
            'corruptibilidad'=> $corruptibilidad,
            'myCorruptibilidad' => $myCorruptibilidad,
            'expCorruptibilidad' => $expCorruptibilidad,
            'subCorr'=> $subCorr,
            'mySubCorruptibilidad' => $mySubCorruptibilidad,
            'expSubCorruptibilidad' => $expSubCorruptibilidad,
            'intervenciones' => $intervenciones,
            'myIntervencionFamilia' => $myIntervencionFamilia,
            'expIntervancionFamilia' => $expIntervencionFamilia,
            'myIntervencionPenal' => $myIntervencionPenal,
            'expIntervancionPenal' => $expIntervencionPenal,
            'medidasJudiciales' => $medidasJudiciales,
            'denunciaMedidas' => $denunciaMedidas,
            'cantidadVecesMedidas' => $cantidadVecesMedidas,
            'incumplimientoMedidas' => $incumplimientoMedidas,
            'myMedidas' => $myMedidas,
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
        $removerCorruptibilidad=$em->getRepository('AppBundle:AgresorCorruptibilidad')->findBy(array('agresorId'=>$agresor->getId()));
        foreach ($removerCorruptibilidad as $key => $value) {
            $em->remove($value);
        }
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
        $conjuntoObservaciones = $request->request->get('observaciones'.$aux);
        if ( is_array($conjuntoElementos) AND (count($conjuntoElementos)>0)){
            foreach ($conjuntoElementos as $clave=>$item) {
                if ($item=='on') {
//DEBERIA AGREGAR SI INGRESAN NO... PUEDE SER MEJOR PARA EL EDITAR!
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
        $removerIndicador=$em->getRepository('AppBundle:EvaluacionIndicador')->findBy(array('evaluacionRiesgoId'=>$evaluacion->getId()));
        foreach ($removerIndicador as $key => $value) {
            $em->remove($value);
        }
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

    private function persistirIntervenciones($request, $intervencion, $evaluacionRiesgo){
        $intervencionLW = strtolower($intervencion->getNombre());
        $intervencionUF = ucfirst($intervencionLW);

        $em = $this->getDoctrine()->getManager();

        $conjuntoIntervenciones = $request->request->get('intervenciones' . $intervencionUF);
        $conjuntoObservaciones = $request->request->get('observaciones' . $intervencionUF);
        // foreach ($removerIntervencionesFamilia as $key => $value) {
        //     $em->remove($value);
        // }
        $metodo = 'get'.$intervencionUF;
        $removerIntervenciones=$em->getRepository('AppBundle:IntervencionTipo'.$intervencionUF)->findBy(array($intervencionLW =>$evaluacionRiesgo->$metodo()));
        foreach ($removerIntervenciones as $key => $value) {
            $em->remove($value);
        }

        if ( is_array($conjuntoIntervenciones) AND (count($conjuntoIntervenciones)>0)){
            foreach ($conjuntoIntervenciones as $clave=>$item) {
                $clase = 'AppBundle\Entity\IntervencionTipo'.$intervencionUF;
                $intervencionTipo = new $clase;
                $intervencionJudicial = $em->getRepository('AppBundle:IntervencionJudicial')->find($clave);
                $intervencionTipo->setIntervencionJudicial($intervencionJudicial);
                $intervencionTipo->setObservacion($conjuntoObservaciones[$clave]);
                $juzgado_id = $request->request->get('appbundle_evaluacionriesgo')[$intervencionLW]['juzgado'];
                $juzgado = $em->getRepository('AppBundle:Juzgado')->find($juzgado_id);
                $intervencion->setJuzgado($juzgado);
                $setIntervencion = 'set'.$intervencionUF;
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
