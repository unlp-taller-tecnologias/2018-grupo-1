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

//use AppBundle\Form\formLogin;

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
   * @Route("/alta")
   */
  public function alta(){
    return $this->render('templates/alta.html.twig', array('parametro' => 'tipo de documento'));
  }

/////////////////
/**
 * Matches /blog exactly
 *
 * @Route("/blog", name="blog_list")
 */
public function listAction()
{
    $var='Entra a listAction a travez de /blog';
    return $this->render('lucky/number/prueba.html.twig', array(
        'number' => $var,
    ));
}

/**
 * Matches /blog/*
 *
 * @Route("/blog/{slug}", name="blog_show")
 */
public function showAction($slug)
{
  $var='Entra a listAction a travez de /blog';
  return $this->render('lucky/number/prueba.html.twig', array(
      'number' => $slug,
  ));

}

/**
 * Matches /sesion
 *
 * @Route("/sesion", name="blog_show1")
 */
public function showAction1(Request $request){

  $session = new Session();
  if(!$session->has('id')) {
    //echo "string";
    $session->start();
    $id=$session->getId();
    $session->set('id', $id);
  }
  //$id=$session->getId();
  //var_dump($session);
  //var_dump($_POST);
  $request = Request::createFromGlobals();
  //var_dump($request->query->all()); //GET
  var_dump($request->get('password'));  //POST
  //$session->set('id', $id);

  return $this->render('lucky/number/prueba.html.twig', array(
      'number' => $session->getId(),
  ));

  }

  /**
   * Matches /cerrarsesion
   *
   * @Route("/cerrarsesion")
   */
  public function showAction4()
  {
    $session = new Session();
    $session->remove('id');
    $session->invalidate();
    return ($this->login());

  }

  /**
   * Matches /guardar/*
   *
   * @Route("/guardar/{table}")
   */
  public function showAction5($table)
  {
    var_dump($_POST['descripcion']);
    //$request = Request::createFromGlobals();
    //var_dump($request->query->all());
    $entityManager = $this->getDoctrine()->getManager();
    $estadoC = new EstadoCivil();
    $estadoC->setNombre($_POST['descripcion']);
    var_dump($estadoC);
    $entityManager->persist($estadoC);
    $entityManager->flush();


    return ($this->showAction6('estado civil'));

  }

  /**
   * Matches /listar/*
   *
   * @Route("/listar/{table}")
   */
  public function showAction6($table)
  {
    $entityManager = $this->getDoctrine()->getManager();
    $repository = $this->getDoctrine()->getRepository(EstadoCivil::class);
    $elements = $repository->findAll();
    //var_dump($elements);
    return $this->render('templates/listado.html.twig', array('parametro' => 'estado civil', 'elementos'=>$elements));
    /*
    base de datos port
consegui alta
no es del todo polimorfico
consegui listado
capaz podemos acomodar el polimorfismo manejando strings
*/
  }

}

?>
