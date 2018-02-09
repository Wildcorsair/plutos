<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 2/9/18
 * Time: 2:53 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AboutController extends Controller
{
    /**
     * @Route("/about", name="about")
     */
    public function indexAction()
    {
        return $this->render('about/index.html.twig');
    }
}