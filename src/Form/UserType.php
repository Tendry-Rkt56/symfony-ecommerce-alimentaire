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

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Votre nom',
                'label_attr' => [
                    'class' => 'fw-bolder'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nom...',
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Votre prénom',
                'label_attr' => [
                    'class' => 'fw-bolder'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Prénom...',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email',
                'label_attr' => [
                    'class' => 'fw-bolder'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'email...',
                ],
            ])
            ->add('passwords', PasswordType::class, [
                'label' => 'Votre password',
                'mapped' => false,
                'label_attr' => [
                    'class' => 'fw-bolder'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Password...',
                ],
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image',
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
                'label' => 'Modifier', 
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
