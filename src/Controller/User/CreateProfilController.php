<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class CreateProfilController extends AbstractController
{


     #[Route('/user/profil/create', name: 'user.profil.create', methods: ['GET', 'POST'])]
     public function create (Request $request, EntityManagerInterface $entity, UserPasswordHasherInterface $hasher)
     {
          $user = new User();
          $form = $this->createForm(UserType::class, $user, [
               'attr' => [
                    'class' => 'container d-flex align-items-center justify-content-center flex-column forme'
               ]
          ]);
          $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {
               $user->setImage($this->checkImage($form->get('imageFile')->getData(), $user))
                    ->setPassword($hasher->hashPassword($user, $form->get('passwords')->getData()));
               $entity->persist($user);
               $entity->flush();
               return $this->redirectToRoute('app.login');
          }
          return $this->render('user/profils/create.html.twig', [
               'form' => $form,
          ]);
     }

     private function checkImage (?UploadedFile $image, User $user)
     {
          if ($user->getImage() == null && $image == null && !$image instanceof UploadedFile) return null;
          if ($user->getImage() !== null && $image == null && !$image instanceof  UploadedFile) return $user->getImage();
          else {
               $this->deleteImage($user);
               $image->move($this->getParameter('kernel.project_dir').'/public/image/users/', $image->getClientOriginalName());
               return $image->getClientOriginalName();
          }
     }

     private function deleteImage(User $user)
     {
          if ($user->getImage()) {
               $path = $this->getParameter('kernel.project_dir'). '/public/image/users/'.$user->getImage();
               if (file_exists($path)) {
                    unlink($path);
               }
          }
     }


}