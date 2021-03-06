<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Expediente;
use AppBundle\Entity\Agresor;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Victima;
use AppBundle\Entity\ExpedienteRedes;
use AppBundle\Entity\ExpedienteSalud;
use AppBundle\Entity\ExpedienteCobertura;
use AppBundle\Entity\EvaluacionRiesgo;
use AppBundle\Entity\EvaluacionIndicador;
use AppBundle\Entity\AgresorCorruptibilidad;
use AppBundle\Entity\IntervencionTipoPenal;
use AppBundle\Entity\IntervencionPenal;
use AppBundle\Entity\IntervencionFamilia;
use AppBundle\Entity\IntervencionJudicial;
use AppBundle\Entity\IntervencionTipoFamilia;
use AppBundle\Entity\AntecedenteJudicial;
use AppBundle\Entity\EvaluacionMedida;
use AppBundle\Entity\Perimetral;
use AppBundle\Entity\ExpedienteIntervencion;
use AppBundle\Entity\Juzgado;
use Symfony\Component\Intl\Intl;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
          ->add('nombreApellido', TextType::class, array('label' => 'Nombre y/o Apellido víctima', 'required' => false,'attr' => array('class' => 'form-control')))
          ->add('nombreApellidoAgresor', TextType::class, array('label' => 'Nombre y/o Apellido agresor', 'required' => false,'attr' => array('class' => 'form-control')))
          ->add('nroExp', NumberType::class, array('label' => 'N° expediente','required' => false ,'attr' => array('class' => 'form-control')))
          ->add('buscar',SubmitType::class, array('label' => 'Buscar','attr' => array('class' => 'form-control btn btn-secondary')))
          ->getForm();
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();
        if (!empty($data['nombreApellido']) OR !empty($data['nombreApellidoAgresor']) OR !empty($data['nroExp'])) {
          if (!empty($data['nombreApellido'])){
            $thetextstring = preg_replace("#[\s]+#", " ", $data['nombreApellido']);
            $palabras = explode(" ", $thetextstring);
            $resultados = $em->getRepository('AppBundle:Expediente')->getExpedientesByNameAndApe($palabras, 1, 1000);
            foreach ($resultados as $key => $resultado) {
              array_push($expedientesResultado, $resultado);
            }
            $maxPages = 0;
          }
          if (!empty($data['nombreApellidoAgresor'])){
            $thetextstring = preg_replace("#[\s]+#", " ", $data['nombreApellidoAgresor']);
            $palabras = explode(" ", $thetextstring);
            $resultados = $em->getRepository('AppBundle:Expediente')->getExpedientesByNameAndApeAgresor($palabras, 1, 1000);
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
    public function newAction(Request $request){
        $evaluacion = new EvaluacionRiesgo();

        $penal = new IntervencionPenal();
        $familia = new IntervencionFamilia();
        $penal->setNombre('PENAL');
        $familia->setNombre('FAMILIA');
        $evaluacion->setPenal($penal);
        $evaluacion->setFamilia($familia);
        $expediente = new Expediente();
        $agresor = new Agresor();
        $victima = new Victima();
        $antecedente=new AntecedenteJudicial();
        $em = $this->getDoctrine()->getManager();
        $evaluacion->setAgresor($agresor);
        $evaluacion->addAntecedentesJudiciale($antecedente);
        $victima->addEvaluacionesDeRiesgo($evaluacion);
        $expediente->setVictima($victima);
        $form = $this->createForm('AppBundle\Form\ExpedienteType', $expediente,['nextNroExp' => $this->getNextNroExp()]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->persistirNivelDeCorruptibilidad($request,$agresor);
            $this->persistirUsuarios($request,$expediente);
            $this->persistirCobertura($request,$expediente);
            $this->persistirIndicadoresRiesgo($request,$evaluacion);
            $this->persistirIntervenciones($request,$penal);
            $this->persistirIntervenciones($request,$familia);
            $this->persistirElementosDinamicos($request,$expediente,'redes');
            $this->persistirElementosDinamicos($request,$expediente,'salud');
            $this->persistirElementosMedidaJudicial($request,$evaluacion);

            $data = $request->request->get('appbundle_expediente');
            if(isset($request->request->get('agresor-provincia')[0])){
                $evaluacion->getAgresor()->setProvincia($request->request->get('agresor-provincia')[0]);
                if(isset($request->request->get('agresor-partido')[0])){
                    $evaluacion->getAgresor()->setPartido($request->request->get('agresor-partido')[0]);
                   if(isset($request->request->get('agresor-localidad')[0])){
                        $evaluacion->getAgresor()->setLocalidad($request->request->get('agresor-localidad')[0]);
                    }
                }
            }
            if(isset($request->request->get('victima-provincia')[0])){
                $expediente->getVictima()->setProvincia($request->request->get('victima-provincia')[0]);
                if(isset($request->request->get('victima-partido')[0])){
                    $expediente->getVictima()->setPartido($request->request->get('victima-partido')[0]);
                    if(isset($request->request->get('victima-localidad')[0])){
                        $expediente->getVictima()->setLocalidad($request->request->get('victima-localidad')[0]);
                    }
                }
            }
            $this->persistirIntervencionesRealizadas($request, $expediente);

            if((!isset($data['fecha'])) OR ($data['fecha'] = 0)){
                $expediente->setFecha(new \DateTime());
            }
            $em->persist($expediente);

            if(isset($data['victima']['evaluacionesDeRiesgo'][0]['perimetral']['fecha']) AND (strlen($data['victima']['evaluacionesDeRiesgo'][0]['perimetral']['fecha']) > 0)){
                $evaluacion->getPerimetral()->setResuelta(0);
            }

            $em->flush();

            return $this->redirectToRoute('expediente_show', array('id' => $expediente->getId()));
        } else {
            $redes = $em->getRepository('AppBundle:Redes')->findAllActive();
            $estadoSalud = $em->getRepository('AppBundle:EstadoDeSalud')->findAllActive();
            $coberturaSalud = $em->getRepository('AppBundle:CoberturaSalud')->findAllActive();
            $usuarios = $em->getRepository('AppBundle:Usuario')->findAllActive();
            $indicadoresRiesgo = $em->getRepository('AppBundle:IndicadorRiesgo')->findAllActive();
            $corruptibilidad=$em->getRepository('AppBundle:NivelCorruptibilidad')->findAllActive();
            $intervenciones = $em->getRepository('AppBundle:IntervencionJudicial')->findAllActive();
            $subCorr=$em->getRepository('AppBundle:NivelCorruptibilidad')->findAllSub();
            $medidasOrdenadas=$em->getRepository('AppBundle:MedidaJudicial')->findAllActive();
            $intRealizadas=$em->getRepository('AppBundle:IntervencionRealizada')->findAllActive();
        }

        return $this->render('expediente/new.html.twig', array(
            'expediente' => $expediente,
            'form' => $form->createView(),
            'redes'=>$redes,
            'estadoSalud' => $estadoSalud,
            'coberturaSalud' => $coberturaSalud,
            'usuarios'=>$usuarios,
            'indicadoresRiesgo' => $indicadoresRiesgo,
            'intervenciones' => $intervenciones,
            'corruptibilidad'=> $corruptibilidad,
            'subCorr'=> $subCorr,
            'medidasOrdenadas'=>$medidasOrdenadas,
            'usuariosSeleccionados' => $request->request->get('appbundle_expediente')['usuarios'],
            'intRealizadas'=>$intRealizadas,
        ));
    }

    private function persistirIntervencionesRealizadas($request, Expediente $expediente){
        $intervenciones = $request->request->get('intervencion');
        $observaciones = $request->request->get('observacionesIntervenciones');
        $em = $this->getDoctrine()->getManager();
        if (is_array($intervenciones) AND (count($intervenciones)>0)){
            foreach ($intervenciones as $clave=>$item) {
                if ($item=='on') {

                    $expedienteIntervencion = new ExpedienteIntervencion();
                    $intervencion = $em->getRepository('AppBundle:IntervencionRealizada')->find($clave);
                    $expedienteIntervencion->setExpedienteId($expediente);
                    $expedienteIntervencion->setObservacion($observaciones[$clave]);
                    $expedienteIntervencion->setIntervencionId($intervencion);
                    $em->persist($expedienteIntervencion);
                }
            }
        }
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
        $conjuntoIds=array_unique($conjuntoIds);
        $em = $this->getDoctrine()->getManager();
        if (is_array($conjuntoIds) && (count($conjuntoIds))>0){
            for ($i=0; $i < (count($conjuntoIds)); $i++) {
                  $usuario = $em->getRepository('AppBundle:Usuario')->find($conjuntoIds[$i]);
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
                $setIntervencion = 'set'.$intervencionUF;;
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

    /**
     * Finds and displays a expediente entity.
     *
     * @Route("/{id}", name="expediente_show")
     * @Method("GET")
     */
    public function showAction(Expediente $expediente)
    {
        $deleteForm = $this->createDeleteForm($expediente);
        $countries = Intl::getRegionBundle()->getCountryNames();
        return $this->render('expediente/show.html.twig', array(
            'expediente' => $expediente,
            'delete_form' => $deleteForm->createView(),
            'countries'=>$countries,
        ));
    }

    /**
     * Finds and displays a expediente entity.
     *
     * @Route("/{id}/pdf", name="expediente_pdf")
     * @Method("GET")
     */
    public function pdfAction(Expediente $expediente)
    {
      $pdf=$this->get('knp_snappy.pdf');
      $pdf->setOption('encoding', 'UTF-8');
      $countries = Intl::getRegionBundle()->getCountryNames();
      $html=$this->renderView('expediente/pdf.html.twig', array(
          'expediente' => $expediente,
          'countries'=>$countries,
      ));
      $pdfContents=$pdf->getOutputFromHtml($html);
      // Send it to the browser
      $response=new Response($pdfContents);
      $response->headers->set('Content-type', 'application/octect-stream');
      $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', "Expediente.pdf"));
      $response->headers->set('Content-Transfer-Encoding', 'binary');
        return $response;
    }

    private function persistirUsuariosEdit($request, $expediente,$usuariosViejos,$usuarios){
        $nuevos=array();
        $nuevos[0]=($request->request->get('appbundle_expediente'))['usuarios'][0];
        $nuevos[1]=($request->request->get('appbundle_expediente'))['usuarios'][1];
        $usuariosNuevos=array();
        foreach ($nuevos as $item => $id) {
            $usuariosNuevos[]=intval($id);
        }
        $em = $this->getDoctrine()->getManager();
        $repositorio = $this->getDoctrine()->getRepository('AppBundle:Usuario');
        foreach ($usuarios as $key => $value) {
            if (!(in_array($value->getId(), $usuariosNuevos))) {
                $expediente->removeUsuario($value);
            }
        }
        $this->getDoctrine()->getManager()->flush();
        foreach ($nuevos as $item => $id) {
            if (!(in_array($id, $usuariosViejos))) {
                $nuevos = $repositorio->findOneById($id);
                $expediente->addUsuario($nuevos);
            }
        }
        $em->persist($expediente);
        $em->flush();
    }

    public function persistirUbicacion($request, $victima){
        $provincia=$request->request->get('victima-provincia');
        $partido=$request->request->get('victima-partido');
        $localidad=$request->request->get('victima-localidad');
        $victima->setProvincia($provincia);
        $victima->setPartido($partido);
        $victima->setLocalidad($localidad);
    }

    /**
     * Displays a form to edit an existing expediente entity.
     *
     * @Route("/{id}/edit", name="expediente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Expediente $expediente)
    {
        $expediente->voidExpedienteRedes();
        $expediente->voidExpedienteCobertura();
        $expediente->voidExpedienteEstadoSalud();
        $clavesViejas=array();
        $interv=array();
        foreach ($expediente->getIntervencionesRealizadas() as $key => $value) {
            $clavesViejas[]=$value->getId();
            $interv[]=$value;
        }

        $usuariosViejos=array();
        $usuarios=array();
        foreach ($expediente->getUsuarios() as $key => $value) {
            $usuariosViejos[]=$value->getId();
            $usuarios[]=$value;
        }
        $deleteForm = $this->createDeleteForm($expediente);
        $editForm = $this->createForm('AppBundle\Form\ExpedienteType', $expediente);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->persistirRedes($request,$expediente);
            $this->persistirIntervencionesEdit($request,$expediente);
            $this->persistirCoberturaEdit($request,$expediente);
            $this->persistirEstadoSalud($request,$expediente);
            $this->persistirUsuariosEdit($request,$expediente,$usuariosViejos,$usuarios);
            $data = $request->request->get('appbundle_expediente');
            if(isset($data['intervencionesRealizadas'])){
                $this->persistirIntervecionesEdit($data['intervencionesRealizadas'], $expediente, $clavesViejas, $interv);
            }
            $this->persistirUbicacion($request,$expediente->getVictima());
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('expediente_show', array('id' => $expediente->getId()));
        } else {
            $em = $this->getDoctrine()->getManager();
            $redes = $em->getRepository('AppBundle:Redes')->findAllActive();
            $estadoSalud = $em->getRepository('AppBundle:EstadoDeSalud')->findAllActive();
            $coberturaSalud = $em->getRepository('AppBundle:CoberturaSalud')->findAllActive();
            $usuarios = $em->getRepository('AppBundle:Usuario')->findAllActive();
            $intervenciones = $em->getRepository('AppBundle:IntervencionJudicial')->findAllActive();
            $users=array();
            foreach ($expediente->getUsuarios() as $key => $value) {
                $users[]=$value->getId();
            }
            $expRed=$em->getRepository('AppBundle:ExpedienteRedes')->findBy(array('expedienteId'=>$expediente->getId()));
            $array=array();
            $expRed1=array();
            for ($i=0; $i < count($expRed) ; $i++) {
                $array[]=$expRed[$i]->getRedesId()->getId();
                $expRed1[$expRed[$i]->getRedesId()->getId()]=$expRed[$i]->getObservacion();
            }
            $expSalud=$em->getRepository('AppBundle:ExpedienteSalud')->findBy(array('expedienteId'=>$expediente->getId()));
            $mySalud=array();
            $expSalud1=array();
            for ($i=0; $i < count($expSalud) ; $i++) {
                $mySalud[]=$expSalud[$i]->getEstadoSaludId()->getId();
                $expSalud1[$expSalud[$i]->getEstadoSaludId()->getId()]=$expSalud[$i]->getObservacion();
            }
            $expCobS=$em->getRepository('AppBundle:ExpedienteCobertura')->findBy(array('expedienteId'=>$expediente->getId()));
            $myCobSalud=array();
            $expCobSalud=array();
            for ($i=0; $i < count($expCobS) ; $i++) {
                $myCobSalud[]=$expCobS[$i]->getCoberturaId()->getId();
                $expCobSalud[$expCobS[$i]->getCoberturaId()->getId()]=$expCobS[$i]->getObservacion();
            }

            $intRealizadas=$em->getRepository('AppBundle:IntervencionRealizada')->findAllActive();
            $expIntervencion=$em->getRepository('AppBundle:ExpedienteIntervencion')->findBy(array('expedienteId'=>$expediente->getId()));
            $myIntervenciones=array();
            $expIntv=array();
            for ($i=0; $i < count($expIntervencion) ; $i++) {
                $myIntervenciones[]=$expIntervencion[$i]->getIntervencionId()->getId();
                $expIntv[$expIntervencion[$i]->getIntervencionId()->getId()]=$expIntervencion[$i]->getObservacion();
            }
        }

        return $this->render('expediente/edit.html.twig', array(
            'expediente' => $expediente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'redes'=>$redes,
            'estadoSalud' => $estadoSalud,
            'coberturaSalud' => $coberturaSalud,
            'usuarios'=>$usuarios,
            'intervenciones' => $intervenciones,
            'expRed'=>$expRed1,
            'myred'=>$array,
            'myCobSalud'=>$myCobSalud,
            'mySalud'=>$mySalud,
            'expSalud1'=>$expSalud1,
            'users'=>$users,
            'intRealizadas'=>$intRealizadas,
            'expIntv'=>$expIntv,
            'myIntervenciones'=>$myIntervenciones,
            'expCobSalud'=>$expCobSalud,
        ));
    }

    private function persistirRedes($request, $expediente){
        $em = $this->getDoctrine()->getManager();
        $conjuntoRedes = $request->request->get('redes');
        $conjuntoObservaciones = $request->request->get('observacionesRedes');
        $expRed=$em->getRepository('AppBundle:ExpedienteRedes')->findBy(array('expedienteId'=>$expediente->getId()));
        foreach ($expRed as $key => $value) {
            $em->remove($value);
        }
        if (is_array($conjuntoRedes) AND (count($conjuntoRedes)>0)){
            foreach ($conjuntoRedes as $clave=>$item) {
                $expedienteRedes = new ExpedienteRedes();
                $redes = $em->getRepository('AppBundle:Redes')->find($clave);
                $expedienteRedes->setRedesId($redes);
                $expedienteRedes->setObservacion($conjuntoObservaciones[$clave]);
                $em->persist($expedienteRedes);
                $expediente->addExpedienteRede($expedienteRedes);
            }
        }
    }

    private function persistirIntervencionesEdit($request, $expediente){

        $intervenciones = $request->request->get('intervencion');
        $observaciones = $request->request->get('observacionesIntervenciones');
        $em = $this->getDoctrine()->getManager();
        $expInt=$em->getRepository('AppBundle:ExpedienteIntervencion')->findBy(array('expedienteId'=>$expediente->getId()));
        foreach ($expInt as $key => $value) {
            $em->remove($value);
        }
        if (is_array($intervenciones) AND (count($intervenciones)>0)){
            foreach ($intervenciones as $clave=>$item) {
                if ($item=='on') {
                    $expedienteIntervencion = new ExpedienteIntervencion();
                    $intervencion = $em->getRepository('AppBundle:IntervencionRealizada')->find($clave);
                    $expedienteIntervencion->setExpedienteId($expediente);
                    $expedienteIntervencion->setObservacion($observaciones[$clave]);
                    $expedienteIntervencion->setIntervencionId($intervencion);
                    $em->persist($expedienteIntervencion);
                }
            }
        }

    }

    private function persistirEstadoSalud($request, $expediente){
        $em = $this->getDoctrine()->getManager();
        $conjuntoESalud = $request->request->get('salud');
        $conjuntoObservaciones = $request->request->get('observacionesSalud');
        $expRed=$em->getRepository('AppBundle:ExpedienteSalud')->findBy(array('expedienteId'=>$expediente->getId()));
        foreach ($expRed as $key => $value) {
            $em->remove($value);
        }
        if (is_array($conjuntoESalud) AND (count($conjuntoESalud)>0)){
            foreach ($conjuntoESalud as $clave=>$item) {
                $expedienteSalud = new ExpedienteSalud();
                $estadoSalud = $em->getRepository('AppBundle:EstadoDeSalud')->find($clave);
                $expedienteSalud->setEstadoSaludId($estadoSalud);
                $expedienteSalud->setObservacion($conjuntoObservaciones[$clave]);
                $em->persist($expedienteSalud);
                $expediente->addExpedienteSalud($expedienteSalud);
            }
        }
    }

    private function persistirIntervecionesEdit(array $intervenciones, Expediente $expediente, $clavesViejas, $interv){
        //$clavesViejas=array();
        $clavesNuevas=array();
        foreach ($intervenciones as $item => $id) {
            $clavesNuevas[]=intval($id);
        }
        $em = $this->getDoctrine()->getManager();
        $repositorio = $this->getDoctrine()->getRepository('AppBundle:IntervencionRealizada');
        foreach ($interv as $key => $value) {
            if (!(in_array($value->getId(), $clavesNuevas))) {
                $expediente->removeIntervencionesRealizada($value);
                $em->persist($expediente);
            }
        }
        foreach ($intervenciones as $item => $id) {
            if (!(in_array($id, $clavesViejas))) {
                $intervencion = $repositorio->findOneById($id);
                $expediente->addIntervencionesRealizada($intervencion);
            }
        }
    }

    private function persistirCoberturaEdit($request, $expediente){
        $em = $this->getDoctrine()->getManager();
        $conjuntoCoberturas = $request->request->get('cobertura');
        $conjuntoObservaciones = $request->request->get('observacionesCobertura');
        $expRed=$em->getRepository('AppBundle:ExpedienteCobertura')->findBy(array('expedienteId'=>$expediente->getId()));
        foreach ($expRed as $key => $value) {
            $em->remove($value);
        }
        if (is_array($conjuntoCoberturas) AND (count($conjuntoCoberturas)>0)){
            foreach ($conjuntoCoberturas as $clave=>$item) {
                $expedienteCobertura = new ExpedienteCobertura();
                $cobertura = $em->getRepository('AppBundle:CoberturaSalud')->find($clave);
                $expedienteCobertura->setCoberturaId($cobertura);
                $expedienteCobertura->setObservacion($conjuntoObservaciones[$clave]);
                $em->persist($expedienteCobertura);
                $expediente->addExpedienteCobertura($expedienteCobertura);
            }
        }
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

    private function getNextNroExp(){
      $repository = $this->getDoctrine()->getRepository(Expediente::class);
      $exp = $repository->findOneBy(array(), array('nroExp' => 'DESC'));
      if ($exp != NULL) {
        $nroExp = ($exp->getNroExp())+1;
      } else {
        $nroExp = '1';
      }
      return $nroExp;
    }

    /**
     * Creates a new perimetral entity.
     *
     * @Route("/perimetral_new/{id}", name="perimetral_new")
     * @Method({"GET", "POST"})
     */
    public function perimetralNew(Request $request, Expediente $expediente)
    {
        $perimetral = new Perimetral();

        $form = $this->createForm('AppBundle\Form\PerimetralType', $perimetral);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $request->request->get('expediente_evaluacion');
            $em = $this->getDoctrine()->getManager();
            $evaluacion = $em->getRepository('AppBundle:EvaluacionRiesgo')->find($data);
            if ($evaluacion->getPerimetral()){
                $evaluacion->getPerimetral()->setResuelta(1);
            }
            $perimetral->setResuelta(0);
            $evaluacion->setPerimetral($perimetral);
            $em->persist($evaluacion);
            $em->flush();

            return $this->redirectToRoute('expediente_show', array('id' => $expediente->getId()));
        }else{
            $evaluaciones = $expediente->getVictima()->getEvaluacionesDeRiesgo();
        }

        return $this->render('perimetral/new.html.twig', array(
            'perimetral' => $perimetral,
            'evaluaciones' => $evaluaciones,
            'form' => $form->createView(),
        ));
    }
}
