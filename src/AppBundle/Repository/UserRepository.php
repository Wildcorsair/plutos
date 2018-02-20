<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 2/19/18
 * Time: 11:20 AM
 */

namespace AppBundle\Repository;

class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function allUsers()
    {
        $users = $this->getEntityManager()->getRepository('AppBundle\Entity\User')->findAll();
        return $users;
    }
}