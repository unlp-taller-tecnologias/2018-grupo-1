<?php
// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Component\HttpFoundation\Request;

//use App\Entity\EstadoCivil;
use AppBundle\Entity\EstadoCivil;
use AppBundle\Entity\Profesion;
use AppBundle\Entity\Usuario;
//use AppBundle\Form\formLogin;

//include '/opt/lampp/htdocs/www/2018-grupo-1/src/AppBundle/Entity/EstadoCivil.php';

class SistemaController extends Controller
{
  /**
   * @Route("/lucky/number")
   */
  public function numberAction()
  {
      $number = random_int(0, 100);

      return $this->render('lucky/number.html.twig', array(
          'number' => $number,
      ));
  }

///////////////////

  /**
   * @Route("/lucky/pablo1")
   */
  public function numberAction3(){
    $number = 'random_int(200, 300)';
    return $this->render('lucky/number/prueba.html.twig', array('number' => $number,));
  }

  /**
   * @Route("/prueba")
   */
  public function numberAction4()
  {
      $number = 'random_int(200, 300)';

      return $this->render('templates/layout.html.twig', array(
          'number' => $number,
      ));
  }

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
   * Matches /alta/*
   *
   * @Route("/alta/{table}")
   */
  public function alta($table){
    $title=str_replace('_', ' ', $table);
    return $this->render('templates/alta.html.twig', array('table' => $table, 'title'=> $title));
  }


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
      return $this->render('lucky/number/prueba.html.twig', array('number' => $session->getId()));
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
    $entityManager = $this->getDoctrine()->getManager();
    $estadoC = new EstadoCivil();
    $estadoC->setNombre($_POST['descripcion']);
    //var_dump($estadoC);
    $entityManager->persist($estadoC);
    $entityManager->flush();


    return ($this->list('estado civil'));

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
    //var_dump($elements);
    return $this->render('templates/listado.html.twig', array('parametro' => 'estado civil', 'elementos'=>$elements));

  }

/**
   * Matches /delete/*
   *
   * @Route("/delete/{element}")
   */
  public function delete($element)
  {
    $repository = $this->getDoctrine()->getRepository(EstadoCivil::class);
    $entityManager = $this->getDoctrine()->getManager();
    $object= $repository->find($element);
    //var_dump($object);
    if($object){
      var_dump($object);
      $entityManager->remove($repository->find($object));
      $entityManager->flush();
    }
    return $this->list('aaa');

  }

  /**
   * Matches /update/*
   *
   * @Route("/update/{element}")
   */
  public function update($element)
  {
    $table='aaa';
    $title='aaa';
    $repository = $this->getDoctrine()->getRepository(EstadoCivil::class);
    $entityManager = $this->getDoctrine()->getManager();
    $object= $repository->find($element);
    
    return $this->render('templates/alta.html.twig', array('table' => $table, 'title'=> $title, 'object'=>$object));

  }

  /**
   * @Route("/configuracion")
   */
  public function configuracion(){
    return $this->render('templates/configuracion.html.twig', array());
  }

}

/*
base de datos port
consegui alta
no es del todo polimorfico
consegui listado
capaz podemos acomodar el polimorfismo manejando strings
*/
?>
