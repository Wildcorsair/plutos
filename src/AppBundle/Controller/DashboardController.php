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
use AppBundle\Service\FoldersTreeService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(FoldersTreeService $fileSystem)
    {
        // If we don't use repository, then we use entity class as a repository
        // $users = $this->getDoctrine()->getRepository('AppBundle\Entity\User')->findAll();

        // Otherwise
//        $users = $this->getDoctrine()->getRepository('AppBundle\Entity\User')->allUsers();
        $list = $fileSystem->getFoldersTree();
        ksort($list);
        asort($list);
        return $this->render('dashboard/index.html.twig', [
            'list' => $list
        ]);
    }

    /**
     * @Route("/dashboard/{slug}", name="dashboard_path")
     */
    public function showAction($path, FoldersTreeService $fileSystem)
    {
        if (empty($path)) {
            $path = '/';
        }
        $list = $fileSystem->getFoldersTree($path);
        ksort($list);
        asort($list);
        return $this->render('dashboard/index.html.twig', [
            'list' => $list
        ]);
    }
}