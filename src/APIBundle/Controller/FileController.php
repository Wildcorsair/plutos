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
use APIBundle\Service\FoldersTreeService;

class FileController extends Controller
{
    /**
     * @Route("/api/v1/files/{path}/")
     * @Method("GET")
     */
    public function indexAction($path)
    {
        $fileSystem = new FoldersTreeService();
        $list = $fileSystem->getFoldersTree($path);
        ksort($list);
        asort($list);
        return $this->json($list);
    }
}