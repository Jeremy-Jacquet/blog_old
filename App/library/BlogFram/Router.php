<?php
namespace App\library\BlogFram;

use App\library\BlogFram\HTTPRequest;
use App\library\BlogFram\HTTPResponse;
use App\backend\controllers\BackendController;
use App\frontend\controllers\FrontendController;
use App\library\BlogFram\Route;

class Router
{
    use Route;

    private $HTTPRequest;
    private $HTTPResponse;
    private $controllerName;
    private $controller;

    public function __construct()
    {
        $this->HTTPRequest = new HTTPRequest();
        $this->HTTPResponse = new HTTPResponse($this->HTTPRequest->getGet(),$this->HTTPRequest->getPost());
        $this->controllerName = $this->HTTPResponse->getControllerName();
        $this->getController();
    }

    public function run()
    {
        if($this->verifyRoute(  $this->HTTPResponse->getAccess(),
                                $this->HTTPResponse->getModule(),
                                $this->HTTPResponse->getAction(),
                                $this->HTTPResponse->getId())) {
            $routeMethod = $this->getRouteByController($this->controllerName, $this->HTTPResponse->getModule());
            $this->controller->$routeMethod($this->HTTPResponse->getModule(), 
                                            $this->HTTPResponse->getAction(), 
                                            $this->HTTPResponse->getId()
                                            );
        } else {
            $controller = new FrontendController;
            $controller->redirect(HOME); 
        }
        
    }

    public function getController() {
        if($this->controllerName === 'backend') {
            $this->controller = new BackendController;
        } elseif($this->controllerName === 'frontend') {
            $this->controller = new FrontendController;
        }
    }

}
