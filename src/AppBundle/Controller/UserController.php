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
use AppBundle\Service\RegisterUserMessageGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
    public function registerShowAction(Request $request, UserPasswordEncoderInterface $encoder, RegisterUserMessageGenerator $generator)
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
            ->add('username', TextType::class, [
                'attr' => [
                    'id' => 'username',
                    'class' => 'form-control',
                ]
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'id' => 'password',
                    'class' => 'form-control',
                ]
            ])
            ->add('password_confirm', PasswordType::class, [
                'attr' => [
                    'id' => 'password-confirm',
                    'class' => 'form-control',
                ]
            ])
            ->getForm();

        $register->handleRequest($request);

        if ($register->isSubmitted() && $register->isValid()) {
            $user = $register->getData();

            $plainPassword = $register->get('password')->getData();
            $encodedPassword = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encodedPassword);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $generator->sendMessage('New user was registered!');
            return $this->redirectToRoute('home');
        }

        return $this->render('users/register.html.twig', [
            'register' => $register->createView()
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils, RegisterUserMessageGenerator $generator)
    {
        $message = '';
        $login = $this->createForm(LoginType::class);

        $error = $authUtils->getLastAuthenticationError();
        if (isset($error) && !empty($error)) {
            $message = $error->getMessage();
        }

        $lastUsername = $authUtils->getLastUsername();

        return $this->render('users/login.html.twig', [
            'login' => $login->createView(),
            'last_username' => $lastUsername,
            'error' => $message
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {

    }

    public function isPasswordConfirm()
    {
    }

}