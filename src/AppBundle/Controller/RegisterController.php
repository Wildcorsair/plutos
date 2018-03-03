<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Form\LoginType;
use Swift_Mailer;
use Swift_Message;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function registerShowAction(Swift_Mailer $mailer, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $register = $this->createFormBuilder($user, ['attr' => ['id' => 'register-user']])
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

            $message = new Swift_Message('Registration Success');
            $message->setFrom('no-reply@plutos.com')
                ->setTo('admin@plutos.com')
                ->setBody(
                    '<h3>Congratulation!!!</h3><p>You was successfully registered</p>',
                    'text/html'
                );

            $mailer->send($message);
            return $this->redirectToRoute('success');
        }

        return $this->render('register/register.html.twig', [
            'register' => $register->createView()
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        $message = '';
        $login = $this->createForm(LoginType::class);

        $error = $authUtils->getLastAuthenticationError();
        if (isset($error) && !empty($error)) {
            $message = $error->getMessage();
        }

        $lastUsername = $authUtils->getLastUsername();

        return $this->render('register/login.html.twig', [
            'login' => $login->createView(),
            '_username' => $lastUsername,
            'error' => $message
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {

    }

    /**
     * @Route("/success", name="success")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registrationSuccess()
    {
        return $this->render('register/success.html.twig');
    }
}
