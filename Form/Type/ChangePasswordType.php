<?php

namespace KRG\UserBundle\Form\Type;

use KRG\UserBundle\Entity\UserInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('current_password', PasswordType::class, [
            'mapped'      => false,
            'constraints' => new UserPassword(),
        ])
        ->add('plainPassword', RepeatedType::class, [
            'type'            => PasswordType::class,
            'first_options'   => ['label' => 'form.password'],
            'second_options'  => ['label' => 'form.password_confirmation'],
            'invalid_message' => 'Mismatch', // TODO: translate
            'required'        => true
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => UserInterface::class,
            'translation_domain' => 'KRGUserBundle',
            'label_format'       => 'form.%name%'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'krg_user_change_password';
    }
}
