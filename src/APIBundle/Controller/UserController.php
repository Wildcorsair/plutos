<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 2/9/18
 * Time: 6:03 PM
 */

namespace APIBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Route("/api/v1/users")
     * @Method("GET")
     */
    public function indexAction()
    {
        $users = [
            ['id' => 1, 'first_name' => 'John', 'last_name' => 'Doe', 'birthday' => '1980-01-18'],
            ['id' => 2, 'first_name' => 'Sarah', 'last_name' => 'Smith', 'birthday' => '1985-05-28'],
            ['id' => 3, 'first_name' => 'Ben', 'last_name' => 'Gun', 'birthday' => '1978-11-07'],
            ['id' => 4, 'first_name' => 'Selena', 'last_name' => 'Gomez', 'birthday' => '1980-03-21'],
            ['id' => 5, 'first_name' => 'Paul', 'last_name' => 'Collins', 'birthday' => '1980-04-28'],
        ];

        return $this->json($users);
    }
}