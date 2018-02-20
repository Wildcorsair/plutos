<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 2/13/18
 * Time: 9:22 AM
 */

namespace AppBundle\Controller;


use AppBundle\AppBundle;
use AppBundle\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        // If we don't use repository, then we use entity class as a repository
        // $users = $this->getDoctrine()->getRepository('AppBundle\Entity\User')->findAll();

        // Otherwise
        $users = $this->getDoctrine()->getRepository('AppBundle\Entity\User')->allUsers();

        return $this->render('dashboard/index.html.twig', [
            'users' => $users
        ]);
    }
}