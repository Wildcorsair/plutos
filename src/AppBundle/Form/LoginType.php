<?php
/**
 * LoginType class implements "Login Form" creation.
 * User: Vladimir Zakharchenko
 * Date: 2/12/18
 * Time: 3:46 PM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('password', PasswordType::class, ['attr' => ['class' => 'form-control']])
            ->add('login', SubmitType::class, ['label' => 'Sign In', 'attr' => ['class' => 'btn btn-success']]);
    }
}