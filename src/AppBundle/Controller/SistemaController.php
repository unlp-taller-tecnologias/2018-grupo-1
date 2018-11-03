<?php
// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

//use App\Entity\EstadoCivil;
use AppBundle\Entity\EstadoCivil;
use AppBundle\Entity\Profesion;
use AppBundle\Entity\Usuario;
//use AppBundle\Form\FormLogin;
/*
use AppBundle\Entity\CoberturaSalud;
use AppBundle\Entity\Hogar;
use AppBundle\Entity\RazonConsulta;
use AppBundle\Entity\Redes;
use AppBundle\Entity\VinculoSignificativo;
*/
use AppBundle\Form\FormAlta;
use AppBundle\Form\FormAltaOrden;
//include '/opt/lampp/htdocs/www/2018-grupo-1/src/AppBundle/Entity/EstadoCivil.php';

class SistemaController extends Controller
{

  /**
   * @Route("/login")
   */
  public function login(){
    return $this->render('templates/login.html.twig', array());
  }

  /**
   * @Route("/index")
   */
  public function index(){
    return $this->render('templates/index.html.twig', array());
  }

/**
 * Matches /sesion
 *
 * @Route("/sesion", name="blog_show1")
 */
public function iniciarsesion(Request $request){
  //crear objeto
    /*$form = $this->createForm(FormLogin::class, $object);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $object = $form->getData();
        $repository = $this->getDoctrine()->getRepository(Usuario::class);
        $object = $repository->findBy(array('dni' => $object->getDNI(, 'password' => $object->getPass())));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($object);
        $entityManager->flush();
        return $this->redirectToRoute('app_sistema_index', array());
    }*/

  $dni=$_POST['dni'];
  $pass=$_POST['password'];
  //var_dump($dni);
  //var_dump($pass);

  $repository = $this->getDoctrine()->getRepository(Usuario::class);
  $object = $repository->findBy(array('dni' => $dni, 'password' => $pass));
  if($object){
    echo "sesion iniciada";
    $session = new Session();
    if(!$session->has('id')) {
      $session->start();
      $id=$session->getId();
      $session->set('id', $id);
/*      $session->set('nombre', $object[0]->getNombre());
      $session->set('nombre', $object[0]->getApellido());
      $session->set('nombre', $object[0]->getDni());
      var_dump($session);*/
      //crea la sesion
      //return $this->render('lucky/number/prueba.html.twig', array('number' => $session->getId()));
      return $this->index();
    } else {
      //reestablece la sesion
      return $this->index();
    }
  } else {
    return $this->login();  
  }
}

  /**
   * Matches /cerrarsesion
   *
   * @Route("/cerrarsesion")
   */
  public function cerrarsesion()
  {
    $session = new Session();
    $session->remove('id');
    $session->invalidate();
    return ($this->login());
  }

  /**
   * Matches /listar/*
   *
   * @Route("/listar/{table}")
   */
  public function list($table)
  {
    //echo EstadoCivil::class;
    $entidad= str_replace(' ', '',(ucwords(str_replace('_', ' ', $table))));
    //var_dump($entidad);
    $clase='AppBundle\Entity\\'.$entidad;
    $repository = $this->getDoctrine()->getRepository($clase);
    //$elements = $repository->findAll();
    $elements = $repository->findBy(array('activo' => true));
    $parametro=ucwords(str_replace('_', ' ', $table));
    return $this->render('templates/listado.html.twig', array('parametro' => $parametro, 'elementos'=>$elements, 'entidad'=>$entidad));

  }

/**
   * Matches /delete/*
   *
   * @Route("/delete/{table}/{element}")
   */
  public function delete($table,$element)
  {
    $entidad= 'AppBundle\\Entity\\'.$table;
    $repository = $this->getDoctrine()->getRepository($entidad);
    $entityManager = $this->getDoctrine()->getManager();
    $object= $repository->find($element);
    if($object){
      $object->setActivo(false);
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($object);
      $entityManager->flush();
      //$entityManager->remove($repository->find($object));
      //$entityManager->flush();
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
      $form = $this->createForm(FormAltaOrden::class, $object);
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

    return $this->render('templates/alta.html.twig', array('form' => $form->createView(),'entidad'=>$table, 'alta'=>'0'));
  }

  /**
   * @Route("/configuracion")
   */
  public function configuracion(){
    return $this->render('templates/configuracion.html.twig', array());
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
      $form = $this->createForm(FormAltaOrden::class, $object);
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

    return $this->render('templates/alta.html.twig', array('form' => $form->createView(),'entidad'=>$table, 'alta'=>'1'));
  }


}

?>
