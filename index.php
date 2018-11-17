<?php
/*
require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Controller\SistemaController;

$request = Request::createFromGlobals();
$response = new Response();

$map = array(
    '/' => __DIR__.'/index',
    '/bye'   => __DIR__.'/src/pages/bye.php',
);

$path = $request->getPathInfo();
var_dump($path);
if (isset($map[$path])) {
    ob_start();
    //include $map[$path];
    //include './src/AppBundle/Controller/SistemaController.php';
    $a = new SistemaController();
    $a->login();
    $response->setContent(ob_get_clean());
} else {
    $response->setStatusCode(404);
    $response->setContent('Not Found');
}

$response->send();
*/
/*
$kernel = new AppKernel('dev', true);
if (PHP_VERSION_ID < 70000) {
    $kernel->loadClassCache();
}
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);*/