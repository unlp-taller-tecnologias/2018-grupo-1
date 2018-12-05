<?php

namespace AppBundle\Repository;

/**
 * MedidaJudicialRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MedidaJudicialRepository extends \Doctrine\ORM\EntityRepository
{
	public function findAllActive(){
		$query =$this->getEntityManager()
        ->createQuery('SELECT mj FROM AppBundle:MedidaJudicial mj WHERE mj.activo = 1 ORDER BY mj.orden')
        ->getResult();
      return $query;
	}
}
