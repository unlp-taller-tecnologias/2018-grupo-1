<?php
namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\FormAlta;
use AppBundle\Form\FormAltaOrden;
use AppBundle\Form\NivelCorruptibilidadType;

class SistemaController extends Controller
{

  /**
   * Matches /guardar/*
   *
   * @Route("/guardar/{table}")
   */
  public function create($table)
  {
    $entidad= 'AppBundle\\Entity\\'.$table;
    $entityManager = $this->getDoctrine()->getManager();
    $object = new $entidad;
    $object->setNombre($_POST['descripcion']);
    $entityManager->persist($object);
    $entityManager->flush();
    return ($this->list($table));
  }

  /**
   * Matches /listar/*
   *
   * @Route("/listar/{table}")
   */
  public function list($table){
    $entidad= str_replace(' ', '',(ucwords(str_replace('_', ' ', $table))));
    $clase='AppBundle\Entity\\'.$entidad;
    $repository = $this->getDoctrine()->getRepository($clase);
    try {
      $elements = $repository->findBy(array(),array('orden' => 'ASC'));
    } catch (\Exception $e) {
      $elements = $repository->findAll();
    }
    $parametro=ucwords(str_replace('_', ' ', $table));
    $titulo='';
    $words=explode('_', $table);
    $array=array('tipo', 'nivel', 'indicador', 'cobertura');
    for ($i = 0; $i < count($words); $i++) {

      $titulo=$titulo . strtolower($words[$i]);
      if ($i < (count($words)-1 )){
        if(in_array($words[$i], $array)){
          $titulo=$titulo . ' de ';
        } elseif ($words[$i]=='razon') {
          $titulo='por qué ';
        }else{
          $titulo=$titulo . ' ';
        }
      }
    }
    return $this->render('templates/listado.html.twig', array('parametro' => $parametro, 'elementos'=>$elements, 'entidad'=>$entidad, 'titulo'=>$titulo));
  }

  /**
   * Matches /delete/*
   *
   * @Route("/delete/{table}/{element}")
   */
  public function delete($table,$element)
  {
    $em = $this->getDoctrine()->getManager();
    $entidad= 'AppBundle\\Entity\\'.$table;
    $repository = $this->getDoctrine()->getRepository($entidad);
    $object= $repository->find($element);
    if($object){
      $object->setActivo(false);
      $em->persist($object);
      $em->flush();
    }
    return $this->list($table);
  }

    /**
     * Matches /undelete/*
     *
     * @Route("/undelete/{table}/{element}")
     */
    public function undelete($table,$element)
    {
      $em = $this->getDoctrine()->getManager();
      $entidad= 'AppBundle\\Entity\\'.$table;
      $repository = $this->getDoctrine()->getRepository($entidad);
      $object= $repository->find($element);
      if($object){
        $object->setActivo(true);
        $em->persist($object);
        $em->flush();
      }
      return $this->list($table);
    }

    /**
     * Matches /deleteForever/*
     *
     * @Route("/deleteForever/{table}/{element}")
     */
    public function deleteForever($table,$element)
    {
      $em = $this->getDoctrine()->getManager();
      $entidad= 'AppBundle\\Entity\\'.$table;
      $repository = $this->getDoctrine()->getRepository($entidad);
      $object= $repository->find($element);
      if($object){
        try {
          $em->remove($object);
          $em->flush();
        } catch (\Exception $e) {
          $this->addFlash('error','El elemento que se intenta eliminar está siendo utilizado acualmente, se sugiere desactivarlo');
        }
      }
      return $this->list($table);
    }


  /**
   * Matches /update/*
   *
   * @Route("/update/{table}/{element}")
   */
  public function update(Request $request,$table,$element)
  {
    $entidad= 'AppBundle\\Entity\\'.$table;
    $repository = $this->getDoctrine()->getRepository($entidad);
    $object= $repository->find($element);
    if (property_exists($object,'orden')){
      if ($table=='NivelCorruptibilidad') {
        $form = $this->createForm(NivelCorruptibilidadType::class, $object);
      } else {
        $form = $this->createForm(FormAltaOrden::class, $object);
      }
    } else {
      $form = $this->createForm(FormAlta::class, $object);
    }
    $form->add('submit', SubmitType::class, array(
            'label' => 'Aceptar',
            'attr'  => array('class' => 'btn btn-violet pull-right'),
        ));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $object = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($object);
        $entityManager->flush();
        return $this->redirectToRoute('app_sistema_list', array('table'=>$table));
    }
    $re = '/(?#! splitCamelCase Rev:20140412)
    # Split camelCase "words". Two global alternatives. Either g1of2:
      (?<=[a-z])      # Position is after a lowercase,
      (?=[A-Z])       # and before an uppercase letter.
    | (?<=[A-Z])      # Or g2of2; Position is after uppercase,
      (?=[A-Z][a-z])  # and before upper-then-lower case.
    /x';
    $titulo='';
    $tabla='';
    $words=preg_split($re, $table);
    $array=array('Tipo', 'Nivel', 'Indicador', 'Cobertura');
    for ($i = 0; $i < count($words); $i++) {
      $tabla=$tabla . strtolower($words[$i]);
      $titulo=$titulo . strtolower($words[$i]);
      if ($i < (count($words)-1 )){
        $tabla.='_';
        if(in_array($words[$i], $array)){
          $titulo=$titulo . ' de ';
        } elseif ($words[$i]=='Razon') {
          $titulo='por qué ';
        }else{
          $titulo=$titulo . ' ';
        }
      }
    }

      return $this->render('templates/alta.html.twig', array('form' => $form->createView(),'entidad'=>$table, 'alta'=>'0', 'titulo'=>$titulo, 'tabla'=>$tabla));
    }


  /**
   * Matches /alta/*
   *
   * @Route("/alta/{table}")
   */
  public function alta(Request $request, $table){
    $entidad= 'AppBundle\\Entity\\'.$table;
    $object = new $entidad;
    if (property_exists($object,'orden')){
      if ($table=='NivelCorruptibilidad') {
        $form = $this->createForm(NivelCorruptibilidadType::class, $object);
      } else {
        $form = $this->createForm(FormAltaOrden::class, $object);
      }
    } else {
      $form = $this->createForm(FormAlta::class, $object);
    }
    $form->add('submit', SubmitType::class, array(
            'label' => 'Aceptar',
            'attr'  => array('class' => 'btn btn-violet pull-right'),
        ));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $object = $form->getData();
        $object->setActivo(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($object);
        $entityManager->flush();
        return $this->redirectToRoute('app_sistema_list', array('table'=>$table));
    }

    $re = '/(?#! splitCamelCase Rev:20140412)
    # Split camelCase "words". Two global alternatives. Either g1of2:
      (?<=[a-z])      # Position is after a lowercase,
      (?=[A-Z])       # and before an uppercase letter.
    | (?<=[A-Z])      # Or g2of2; Position is after uppercase,
      (?=[A-Z][a-z])  # and before upper-then-lower case.
    /x';
    $titulo='';
    $tabla='';
    $words=preg_split($re, $table);
    $array=array('Tipo', 'Nivel', 'Indicador', 'Cobertura');
    for ($i = 0; $i < count($words); $i++) {
      $tabla=$tabla . strtolower($words[$i]);
      $titulo=$titulo . strtolower($words[$i]);
      if ($i < (count($words)-1 )){
        $tabla=$tabla.'_';
        if(in_array($words[$i], $array)){
          $titulo=$titulo . ' de ';
        } elseif ($words[$i]=='Razon') {
          $titulo='por qué ';
        }else{
          $titulo=$titulo . ' ';
        }
      }
    }
    return $this->render('templates/alta.html.twig', array('form' => $form->createView(),'entidad'=>$table, 'alta'=>'1', 'titulo'=>$titulo, 'tabla'=>$tabla));
  }
}

?>
