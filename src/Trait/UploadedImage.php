<?php

namespace App\Trait;

use App\Entity\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait UploadedImage 
{

     /**
     * Responsable du téléchargement de l'image venant du formulaire
     * @param UploadedFile $image
     * @param User $user
     * @return string|null
     */
     private function checkImage (?UploadedFile $image, mixed $user)
     {
          if ($user->getImage() == null && $image == null && !$image instanceof UploadedFile) return null;
          if ($user->getImage() !== null && $image == null && !$image instanceof  UploadedFile) return $user->getImage();
          else {
               $this->deleteImage($user);
               $image->move($this->getParameter('kernel.project_dir').'/public/image/users/', $image->getClientOriginalName());
               return $image->getClientOriginalName();
          }
     }

     private function deleteImage(mixed $object)
     {
          if ($object->getImage()) {
               $path = $this->getParameter('kernel.project_dir'). '/public/image/users/'.$object->getImage();
               if (file_exists($path)) {
                    unlink($path);
               }
          }
     }

}