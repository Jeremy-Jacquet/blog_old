<?php

namespace App\library\BlogFram;

trait Image
{

    public function uploadAvatar($file, $directory, $name, $pseudo)
    {   
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $imagePath = $directory . $name . "_" . $pseudo . "_" . $file['name'];

        $this->checkDirectory($directory);
        $this->checkImageTrue($file);
        $this->checkExtension($extension);
        if(!$this->checkExistsImage($imagePath)) {
            $imagePath = $directory . $name . "_" . $pseudo . "_" . RANDOM_PATH . "_" . $file['name'];
        }
        $this->checkImageSize($file);
        $this->checkImageUpload($file, $imagePath);

        return $imagePath;
    }

    public function uploadImage($file, $directory, $name)
    {   
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $imagePath = $directory . $name . "_" . RANDOM_PATH . "_" . $file['name'];

        $this->checkDirectory($directory);
        $this->checkImageTrue($file);
        $this->checkExtension($extension);
        if($this->checkExistsImage($imagePath)) {
            $imagePath = $directory . $name . "_" . $file['name'];
        }   
        $this->checkImageSize($file);
        $this->checkImageUpload($file, $imagePath);

        return $imagePath;
    }

    public function checkDirectory($directory)
    {
        // Si le fichier n'existe pas on le crée avec l'accès à tous avec tous les droits
        if(!file_exists($directory)) {
            mkdir($directory, 0777);
        }
    }

    public function checkImageTrue($file)
    {
        // Si getimagesize() === false => ce n'est pas une image
        // $file['tmp_name'] => fichier temporaire de l'image qui a été uploadé
        if(!getimagesize($file['tmp_name'])) {
            throw new \Exception("Le fichier n'est pas une image");
        }
    }

    public function checkExtension($extension)
    {
        // On vérifie l'extension (des fois la vérification précédente peut passer même si ce n'est pas une image)
        if($extension !== "jpg" AND $extension !== "jpeg" AND $extension !== "png" AND $extension !== "gif") {
            throw new \Exception("L'extension du fichier n'est pas reconnu, sont autorisés: jpg, jpeg, png, gif.");
        }
    }

    public function checkExistsImage($imagePath)
    {
        // On vérifie que le fichier n'existe pas déjà
        if(file_exists($imagePath)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkImageSize($file)
    {
        // On vérifie la taille de l'image
        if($file['size'] > 500000) {
            throw new \Exception("Le fichier est trop volumineux.");
        }
    }

    public function checkImageUpload($file, $imagePath)
    {
        // On teste l'upload de l'image
        if(!move_uploaded_file($file['tmp_name'], $imagePath)) {
            throw new \Exception("L'ajout de l'image n'a pas fonctionné.");
        }
    }

}

