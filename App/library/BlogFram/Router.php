<?php
namespace App\library\BlogFram;

use App\library\BlogFram\HTTPRequest;
use App\library\BlogFram\HTTPResponse;

class Router
{

    private $HTTPRequest;
    private $HTTPResponse;
    private $controller;

    public function __construct()
    {
        $this->HTTPRequest = new HTTPRequest();
        $this->HTTPResponse = new HTTPResponse($this->HTTPRequest->getGet(),$this->HTTPRequest->getPost());
        $this->controller = $this->HTTPResponse->getController();
    }

    public function run()
    {
    }

}
