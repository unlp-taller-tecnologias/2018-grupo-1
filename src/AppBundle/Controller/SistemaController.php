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
use AppBundle\Entity\Perimetral;
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
  // public function login(){
  //   return $this->render('templates/login.html.twig', array());
  // }

  /**
   * @Route("/index")
   */
  public function index(){
    $em = $this->getDoctrine()->getManager();
    $diasPerimetral = $em->getRepository('AppBundle:Configuracion')->findOneBy(array('nombre' => 'diasPerimetral'));
    $repository = $this->getDoctrine()->getRepository(Perimetral::class);
    $medidasVencidas= count($repository->getVencidas());
    $medidasVencer=count($repository->getVencer($diasPerimetral->getValor()));
    return $this->render('templates/index.html.twig', array('medidasVencidas'=> $medidasVencidas, 'medidasVencer' => $medidasVencer ));
  }

  // /**
  //  * Matches /alta/*
  //  *
  //  * @Route("/alta/{table}")
  //  */
  // public function alta($table){
  //   $title=str_replace('_', ' ', $table);
  //   return $this->render('templates/alta.html.twig', array('table' => $table, 'title'=> $title));
  // }


/**
 * Matches /sesion
 *
 * @Route("/sesion", name="blog_show1")
 */
public function iniciarsesion(Request $request){
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

  //$id=$session->getId();
  //var_dump($session);
  //var_dump($_POST);
  //$request = Request::createFromGlobals();
  //var_dump($request->query->all()); //GET
  //$session->set('id', $id);
  }

  /**
   * Matches /cerrarsesion
   *
   * @Route("/cerrarsesion")
   */
  public function cerrarsesion()
  {
    $session = new Session();
    if(!$session->has('id')) {
      $session = new Session();
      $session->remove('id');
      $session->invalidate();
    }
    return ($this->login());
  }

  /**
   * Matches /guardar/*
   *
   * @Route("/guardar/{table}")
   */
  public function create($table)
  {
    //var_dump($_POST['descripcion']);
    //$request = Request::createFromGlobals();
    //var_dump($request->query->all());

    //var_dump($table);
    $entidad= 'AppBundle\\Entity\\'.$table;
    $entityManager = $this->getDoctrine()->getManager();
    $object = new $entidad;
    $object->setNombre($_POST['descripcion']);
    //var_dump($object);
    $entityManager->persist($object);
    $entityManager->flush();


    return ($this->list($table));

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
    //var_dump($clase);
    //$entityManager = $this->getDoctrine()->getManager();
    //$repository = $this->getDoctrine()->getRepository($table::class);
    $repository = $this->getDoctrine()->getRepository($clase);
    $elements = $repository->findAll();
    $parametro=ucwords(str_replace('_', ' ', $table));
    //var_dump($elements);
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
    //var_dump($object);
    if($object){
      $entityManager->remove($repository->find($object));
      $entityManager->flush();
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
    /*
    $table='aaa';
    $title='aaa';
    $repository = $this->getDoctrine()->getRepository(EstadoCivil::class);
    $entityManager = $this->getDoctrine()->getManager();
    $object= $repository->find($element);

    return $this->render('templates/alta_viejo.html.twig', array('table' => $table, 'title'=> $title, 'object'=>$object));
    */

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
   * Matches /altaConOrden/*
   *
   * @Route("/altaConOrden/{table}")
   */
  public function altaConOrden(Request $request, $table){
    $entidad= 'AppBundle\\Entity\\'.$table;
    $object = new $entidad;

    $form = $this->createForm(FormAltaOrden::class, $object);
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

        return $this->redirectToRoute('/index');
    }

    return $this->render('templates/alta_con_orden.html.twig', array('form' => $form->createView(),
    ));
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
