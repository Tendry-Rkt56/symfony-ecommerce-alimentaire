<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Form\UsersType;
use App\Form\UserType;
use App\Trait\UploadedImage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

#[Route('/user/profil', name: 'user.profil.')]
class ProfilController extends AbstractController
{

     use UploadedImage;

     public function __construct (private EntityManagerInterface $entity)
     {
          
     }

     #[Route('/image/{id}', name: 'imageStore', methods: ['POST'])]
     public function storeImage (CsrfTokenManagerInterface $csrfToken, Request $request, User $user)
     {
          $token = $request->request->get('_token');
          if (!$csrfToken->isTokenValid(new CsrfToken('form_token', $token))) {
               throw new InvalidCsrfTokenException('Invalid csrf token');
          }
          $user->setImage($this->checkImage($request->files->get('imageFile'), $user));
          $this->entity->flush();
          return $this->redirectToRoute('user.profil.main');
     }

     #[Route('/main', name: 'main', methods: ['GET'])]
     public function profil (CsrfTokenManagerInterface $csrfToken)
     {
          $token = $csrfToken->getToken('form_token')->getValue();
          return $this->render('user/profils/profil.html.twig', [
               'user' => $this->getUser(),
               'isUser' => $this->isUser($this->getUser()),
               'token' => $token,
          ]);
     }
     
     #[Route('/{id}', name: 'index', methods: ['GET'])]
     public function other (User $user)
     {
          return $this->render('user/profils/profil.html.twig', [
               'user' => $user,
               'isUser' => $this->isUser($user),
          ]);
     }


     #[Route('/manambotra')]
     public function manambotra ()
     {
          echo("Bonjour le monde");
     }

     #[Route('/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
     public function edit (UserPasswordHasherInterface $hasher, Request $request, EntityManagerInterface $entity, User $user)
     {
          $form = $this->createForm(UsersType::class, $user, [
               'attr' => [
                    'class' => 'container d-flex align-items-center justify-content-center flex-column forme'
               ]
          ]);
          $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {
               $password = $form->get('passwords')->getData();

               if ($hasher->isPasswordValid($user, $password)) {
                    $user->setImage($this->checkImage($form->get('imageFile')->getData(), $user))
                         ->setPassword($hasher->hashPassword($user, $form->get('newPassword')->getData()));
                    $entity->flush();
                    $this->addFlash('success', 'Vos informations ont été modifiées');
                    return $this->redirectToRoute('user.profil.index', ['id' => $user->getId()]);
               }
               else {
                    $this->addFlash('danger', 'Votre mot de passe ne correspond pas');
                    $form->addError(new FormError(''));
               }
          }
          return $this->render('user/profils/edit.html.twig',[
               'form' => $form,
               'user' => $user,
          ]);
     }

     private function isUser (User $user)
     {
          /** @var User $userConnected */
          $userConnected = $this->getUser();
          return $userConnected->getId() == $user->getId();
     }


}

