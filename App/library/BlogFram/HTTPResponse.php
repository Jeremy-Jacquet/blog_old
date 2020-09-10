<?php
namespace App\library\BlogFram;

class HTTPResponse
{
    private $access;
    private $module;
    private $action;
    private $id;
    private $post = [];
    private $controllerName;

    public function __construct($url, $post)
    {
        $this->setAttributes($url, $post);
    }
    
    public function setAttributes($url, $post)
    {
        if(empty($url)) {
            $this->setModule(HOME);
        } else {
            if(empty($url[1])) {
                $this->setModule($url[0]);
            } elseif(empty($url[2])) {
                if($url[0] === ADMIN) {
                    $this->setAccess(ADMIN);
                    $this->setModule($url[1]);              
                } else {
                    $this->setModule($url[0]);
                    $this->setId($url[1]);
                }       
            } elseif(empty($url[3])) {
                if($url[0] === ADMIN) {
                    $this->setAccess(ADMIN);
                    $this->setModule($url[1]);
                    $this->setAction($url[2]);  
                }
            } elseif(empty($url[4])) {
                if($url[0] === ADMIN) {
                    $this->setAccess(ADMIN);
                    $this->setModule($url[1]);
                    $this->setAction($url[2]);
                    $this->setId($url[3]); 
                }
            }
        }
        $this->setPost($post);
        $this->setController();
    }

    // GETTERS

    public function getAccess()
    {
        return $this->access;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    //SETTERS

    public function setAccess($access)
    {
        $this->access = $access;
    }

    public function setModule($module)
    {
        $this->module = $module;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPost($post)
    {
        $this->post = $post;
    }

    public function setController()
    {
        if($this->getAccess() === ADMIN) {
            $this->controllerName = 'backend';
        }elseif($this->getModule() === (LOGIN OR LOGOUT OR REGISTER)) {
            $this->controllerName = 'backend';
        } else {
            $this->controllerName = 'frontend';
        }
    }

}