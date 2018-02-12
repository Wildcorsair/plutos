<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 2/9/18
 * Time: 3:08 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\LoginType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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

    /**
     * @Route("/register", name="register")
     */
    public function registerShowAction(Request $request)
    {
        $user = new User();

        $register = $this->createFormBuilder($user)
            ->add('first_name', TextType::class, [
                'attr' => [
                    'id' => 'first-name',
                    'class' => 'form-control',
                ]
            ])
            ->add('last_name', TextType::class, [
                'attr' => [
                    'id' => 'last-name',
                    'class' => 'form-control',
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'id' => 'email',
                    'class' => 'form-control',
                ]
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'id' => 'password',
                    'class' => 'form-control',
                ]
            ])
            ->add('register', SubmitType::class, ['label' => 'Register', 'attr' => ['class' => 'btn btn-success']])
            ->getForm();

        $register->handleRequest($request);

        if ($register->isSubmitted() && $register->isValid()) {
            $user = $register->getData();
            $user->setPassword(password_hash($user->getPassword(), PASSWORD_BCRYPT));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('users/register.html.twig', [
            'register' => $register->createView()
        ]);
    }

    /**
     * @Route("/login", name="login")
     * @Method("GET")
     */
    public function loginShowAction()
    {
        $login = $this->createForm(LoginType::class);
        return $this->render('users/login.html.twig', [
            'login' => $login->createView()
        ]);
    }
}