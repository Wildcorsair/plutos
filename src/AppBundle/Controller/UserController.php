<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 2/9/18
 * Time: 3:08 PM
 */

namespace AppBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/users", name="users")
     *
     * @return object Response
     */
    public function indexAction()
    {
        return $this->render('users/index.html.twig');
    }

    /**
     * @Route("/users/{id}")
     *
     * @return object Response
     */
    public function showAction($id)
    {
        return $this->render('users/show.html.twig', [
            'id' => $id
        ]);
    }
}