<?php

namespace AppBundle\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;
/**
 * ExpedienteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */


class ExpedienteRepository extends \Doctrine\ORM\EntityRepository {

  public function getExpedientesByNameAndApe($palabras = '', $currentPage = 1, $limit = 10){
    $query = $this->createQueryBuilder('e')
    ->select('e')
    ->innerJoin('e.victima', 'v');
    foreach($palabras as $index => $palabra) {
      $query
      ->orwhere("v.nombre LIKE :palabra$index")
      ->orWhere("v.apellido LIKE :palabra$index")
      ->setParameter("palabra$index", '%'.$palabra.'%');
    }
    $query->getQuery();
    return $this->paginate($query, $currentPage, $limit);
  }

  public function getExpedientesById($nroExp = '', $currentPage = 1, $limit = 10){
    $query = $this->createQueryBuilder('e')
    ->select('e')
    ->where('e.nroExp LIKE :nroExp')
    ->setParameter('nroExp', '%' .intval($nroExp). '%')
    ->getQuery();
    return $this->paginate($query, $currentPage, $limit);
  }


  public function getAllExpedientes($currentPage = 1, $limit = 10){
      $query = $this->createQueryBuilder('e')->getQuery();
      return $this->paginate($query, $currentPage, $limit);
  }


  public function paginate($dql, $page = 1, $limit = 3){
    $paginator = new Paginator($dql);
    $paginator->getQuery()
        ->setFirstResult($limit * ($page - 1)) // Offset
        ->setMaxResults($limit); // Limit
    return $paginator;

  }
  public function getExpedientesEntreFechas($inicio,$fin){
    $query =$this->getEntityManager()
      ->createQuery('SELECT COUNT(e) FROM AppBundle:Expediente e WHERE e.fecha BETWEEN :inicio AND :fin')
      ->setParameter('inicio', $inicio)
      ->setParameter('fin', $fin)
      ->getSingleScalarResult();
    return $query;
  }


}
