<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\BotonAntipanico;
use AppBundle\Entity\Expediente;
use AppBundle\Entity\Seguimiento;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


/**
 * Reporte controller.
 *
 * @Route("reporte")
 */
class ReporteController extends Controller
{
    /**
     * @Route("/", name="reporte_index")
     * @Method("GET")
     */
    public function listReportes($param = array(),Request $request){
      $param['reporte'] = '';
      $param['error'] = '';
      $defaultData = array();
      $form = $this->createFormBuilder($defaultData)
          ->add('reporte', ChoiceType::class, array(
              'choices'  => array(
                  'Botones antipanico entre fechas' => 1,
                  'Nuevos expedientes entre fechas' => 2,
                  'Nuevos seguiminetos entre fechas' => 3,
              ),'label' => 'Seleccionar reporte','attr' => array('class' => 'form-control')
          ))
          ->add('inicio', DateType::class)
          ->add('fin', DateType::class)
          ->add('guardar',SubmitType::class, array('label' => 'Buscar','attr' => array('class' => 'form-control btn btn-primary')))
          ->getForm();
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();
        if ($data['inicio'] < $data['fin']) {
          switch ($data['reporte']) {
            case 1:
            $param['reporte'] = $this->reporteBotones($data['inicio'],$data['fin']);
            break;
            case 2:
            $param['reporte'] = $this->reporteExpedientes($data['inicio'],$data['fin']);
            break;
            case 3:
            $param['reporte'] = $this->reporteSeguimientos($data['inicio'],$data['fin']);
            break;
          }
        } else {
          $param['error'] = 'La fecha inicio debe ser anterior a la fecha fin';
        }
      }
      return $this->render('reporte/reporte.html.twig', array('reporte' => $param['reporte'], 'error' => $param['error'],'form' => $form->createView()));
    }

     public function reporteBotones($inicio,$fin){
       $repository = $this->getDoctrine()->getRepository(BotonAntipanico::class);
       $botonesAntipanico=$repository->getBotonesEntreFechas($inicio,$fin);
       return 'El número de botones antipánico entregados entre '.$inicio->format('d/m/y').' y '.$fin->format('d/m/y').', fué de : '.$botonesAntipanico.' botones.';
     }

     public function reporteExpedientes($inicio,$fin){
       $repository = $this->getDoctrine()->getRepository(Expediente::class);
       $expedientes=$repository->getExpedientesEntreFechas($inicio,$fin);
       return 'El número de  nuevos expedientes creados entre '.$inicio->format('d/m/y').' y '.$fin->format('d/m/y').', fué de : '.$expedientes.' expedientes.';
     }

     public function reporteSeguimientos($inicio,$fin){
       $repository = $this->getDoctrine()->getRepository(Seguimiento::class);
       $seguimientos=$repository->getSeguimientosEntreFechas($inicio,$fin);
       return 'El número de nuevos seguimientos generados entre '.$inicio->format('d/m/y').' y '.$fin->format('d/m/y').', fué de : '.$seguimientos.' seguimientos.';
     }

}
