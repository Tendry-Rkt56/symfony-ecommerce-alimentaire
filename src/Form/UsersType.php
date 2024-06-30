<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom:',
                'label_attr' => [
                    'class' => 'fw-bolder'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nom...',
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom:',
                'label_attr' => [
                    'class' => 'fw-bolder'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Prénom...',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email du nouvel admin:',
                'label_attr' => [
                    'class' => 'fw-bolder',
                ],
                'attr' => [
                    'class' => 'form-control',
                    'autocomplete' => false,
                    'placeholder' => 'email...',
                ],
            ])
            ->add('newPassword', PasswordType::class, [
                'required' => true,
                'label' => 'Mot de passe du nouvel admin:',
                'mapped' => false,
                'label_attr' => [
                    'class' => 'fw-bolder'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Password...',
                ],
            ])
            ->add('passwords', PasswordType::class, [
                'label' => 'Votre mot de passe:',
                'mapped' => false,
                'label_attr' => [
                    'class' => 'fw-bolder',
                ],
                'attr' => [
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'placeholder' => 'Password...',
                ],
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image:',
                'required' => false,
                'mapped' => false,
                'label_attr' => [
                    'class' => 'fw-bolder'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nom...',
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer', 
                'attr' => [
                    'class' => 'btn btn-primary'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
