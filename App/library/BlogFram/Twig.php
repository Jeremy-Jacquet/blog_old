<?php
namespace App\library\BlogFram;

use Twig\Extra\String\StringExtension;

class Twig
{
    private $twig;
    private $loader;
    
    
    private function setTwig()
    {
        $this->loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../templates');
        $this->twig = new \Twig\Environment($this->loader, [
            'cache' => false, //__DIR__ . '../../../public/tmp'
        ]);
        $this->twig->addExtension(new StringExtension);
        $this->twig->addExtension(new TwigMyExtension);
    }

    public function getTwig()
    {
        if($this->twig === null) {
            $this->setTwig();
        }
        return $this->twig;
    }

}
