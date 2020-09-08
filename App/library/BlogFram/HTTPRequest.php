<?php
namespace App\library\BlogFram;

class HTTPRequest
{
    private $GET = [];
    private $POST = [];

    public function __construct()
    {
        $this->setGET();
        $this->setPOST();
    }

    //GETTERS

    public function getGET()
    {
        return $this->GET;
    }

    public function getPOST()
    {
        return $this->POST;
    }

    //SETTERS

    public function setGET()
    {
        $this->GET = isset($_GET['url'])? explode("/", filter_var($_GET['url'], FILTER_SANITIZE_URL)) : null;
    }

    public function setPOST()
    {
        $this->POST = isset($_POST)? $_POST : null;
    }
    

}
