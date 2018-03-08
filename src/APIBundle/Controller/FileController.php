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
use Symfony\Component\HttpFoundation\Request;

class FileController extends Controller
{
    /**
     * @Route("/api/v1/files")
     * @Method("POST")
     */
    public function indexAction(Request $request)
    {
        $path = $request->get('path');
        $dir = $request->get('dir');

        if ($dir == '..') {
            $dir = '';
        }

        if ($path != '/' && !empty($path)) {
            $fullPath = $path . '/' . $dir;
        } else {
            $fullPath = $path . $dir;
        }

        $fileSystem = new FoldersTreeService();
        $list = $fileSystem->getFoldersTree($fullPath);
        ksort($list);
        asort($list);
        fwrite(fopen('/tmp/dump', 'w'), print_r($list, 1) . "\n");
        return $this->json($list);
    }
}