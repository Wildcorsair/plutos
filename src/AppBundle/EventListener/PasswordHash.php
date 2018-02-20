<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 2/12/18
 * Time: 5:40 PM
 */

namespace AppBundle\EventListener;


use AppBundle\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;

class PasswordHash
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof User) {
            return false;
        }

        $entity->setPassword(password_hash($entity->getPassword(), PASSWORD_BCRYPT));
    }
}