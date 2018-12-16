<?php

namespace AppBundle\Repository;

/**
 * ExpedienteIntervencionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ExpedienteIntervencionRepository extends \Doctrine\ORM\EntityRepository
{
	public function findAllActive(){
		$query =$this->getEntityManager()
        ->createQuery('SELECT r FROM AppBundle:ExpedienteIntervencion r WHERE r.activo = 1 ORDER BY r.orden')
        ->getResult();
      return $query;
	}
}